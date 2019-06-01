<?php
define('REMINDER_DEBUG', false);
class ReminderAdminStats extends ReminderTest{
    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->type = ER_STATS_REMINDER;
    }

    /**
     * Runs as a DAYLY / WEEKLY digest with osclass site stats
     * uses last_check as date of last the digest sended to admin email address.
     *
     * update last_check on send digest/reminder email
     * 1.- check if digest can be send
     * 2.- id send digest, collect data and send to admin email address.
     *
     * @return type
     */
    public function run() {
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // check if digest can be send
        if(!$this->check($i_now)) {
            return array();
        }

        $aEmails = $this->send_report($i_now);

        // force start time
        $last_check_date = $this->_extractDate($d_now);
        $last_check_time = $this->_extractTime($this->reminder->last_check);
        $last_check = $last_check_date . ' ' . $last_check_time;
        // update last_check
        ModelReminder::newInstance()->updateLastCheck( array(
            's_slug' => $this->reminder->slug,
            'i_days' => $this->reminder->days,
            'dt_last_check' => $last_check
        ));

        return $aEmails;
    }

    private function send_report( $i_now, $testEmail = null) {
        // start and end date used to populate the digest
        // period used $this->reminder->days
        $words = array();
        $words[] = array('-');
        $words[] = array('-');
        // end date, used yesterday as last day of the report
        $dt_end = date('Y-m-d', $i_now - 86400) . ' 23:59:59';

        $days = $this->reminder->days * (86400);
        $dt_start = date('Y-m-d', $i_now - $days) . ' 00:00:00';

        // new users period
        $aUserStatsPeriod = ModelReminder::newInstance()->getUserStats($dt_start, $dt_end);
        // new items period
        $aItemsStatsPeriod = ModelReminder::newInstance()->getItemStats($dt_start, $dt_end);
        if(REMINDER_DEBUG) {
            echo "   $dt_start".PHP_EOL;
            echo "   $dt_end".PHP_EOL;
            echo " >$aUserStatsPeriod< total new users in period ".$this->reminder->days.PHP_EOL;
            echo " >$aItemsStatsPeriod< total new items in period ".$this->reminder->days.PHP_EOL;
        }
        // start and end date, last period.
        $i_last_period_now = $i_now - $days;
        $dt_last_period_end = date('Y-m-d', $i_last_period_now - 86400) . ' 23:59:59';
        $dt_last_period_start = date('Y-m-d', $i_last_period_now - $days) . ' 00:00:00';

        // new users previous period
        $aUserStatsPreviousPeriod  = ModelReminder::newInstance()->getUserStats( $dt_last_period_start, $dt_last_period_end);
        // new items previous period
        $aItemsStatsPreviousPeriod = ModelReminder::newInstance()->getItemStats( $dt_last_period_start, $dt_last_period_end);
        if(REMINDER_DEBUG) {
            echo "   $dt_last_period_start".PHP_EOL;
            echo "   $dt_last_period_end".PHP_EOL;
            echo " >$aUserStatsPreviousPeriod< total new users in PREVIOUS period ".$this->reminder->days.PHP_EOL;
            echo " >$aItemsStatsPreviousPeriod< total new items in period ".$this->reminder->days.PHP_EOL;
        }

        // increment/decrement new users vs last period
        $diff_new_users = $aUserStatsPeriod - $aUserStatsPreviousPeriod;
        $_max_users = ($aUserStatsPreviousPeriod>$aUserStatsPeriod) ? $aUserStatsPreviousPeriod : $aUserStatsPeriod ;
        $avg_users_previous = 0;
        if($_max_users!=0){
            $avg_users_previous = floor( ($diff_new_users*100)/$_max_users);
        }
        if(REMINDER_DEBUG) {
            echo "$avg_users_previous % of new users versus last period".PHP_EOL;
        }

        // increment/decrement new items vs last period
        $diff_new_items = $aItemsStatsPeriod - $aItemsStatsPreviousPeriod;
        $_max_items = ($aItemsStatsPreviousPeriod>$aItemsStatsPeriod) ? $aItemsStatsPreviousPeriod : $aItemsStatsPeriod ;
        $avg_items_previous = 0;
        if($_max_items!=0) {
            $avg_items_previous = floor( ($diff_new_items*100)/$_max_items);
        }
        if(REMINDER_DEBUG) {
            echo "$avg_items_previous % of new items versus last period".PHP_EOL;
        }

        ob_start();
        $period_name = __('Yesterday', 'reminder');
        if($this->reminder->days==7) {
            $period_name = __('Last week', 'reminder');
        }
        include REMINDER_PATH . 'views/mail/admin-stats-base.php';
        $out = ob_get_clean();
        ob_end_flush();

        $title = osc_mailBeauty($this->reminder->subject, $words);

        $aEmails = array(osc_contact_email());
        if($testEmail!=null) {
            $aEmails = array($testEmail);
            $title =  "/testing/ ".$title;
        }

        View::newInstance()->_exportVariableToView('reminder_start_date', $dt_start);
        View::newInstance()->_exportVariableToView('reminder_end_date', $dt_end);
        View::newInstance()->_exportVariableToView('reminder_prev_start_date', $dt_last_period_start);
        View::newInstance()->_exportVariableToView('reminder_prev_end_date', $dt_last_period_end);

        $out = osc_apply_filter('reminder_extend_body_admin_stats', $out);

        foreach($aEmails as $email) {
            $params = array(
                'to' => $email,
                'subject' => $title,
                'body' => $out
            );
            $this->sendMail($params);
        }

        // send copy of weekly stats reminder
        if($this->reminder->days==7) {
            $_bcc_stats = trim(osc_get_preference('bcc_stats_email', 'reminder'));
            if ($_bcc_stats != '') {
                $aEmails = explode(',', $_bcc_stats);
                foreach ($aEmails as $_email) {
                    $params = array(
                        'to' => $_email,
                        'subject' => $title,
                        'body' => $out
                    );
                    osc_sendMail($params);
                }
            }
        }

        return $aEmails;
    }

    private function check($now) {
        $diff_days = $this->getDaysDiffLastCheck($now);
        if($diff_days <= 0) {
            return false;
        }
        if($diff_days >= $this->reminder->days) {
            return true;
        }
        return false;
    }

    public function testReminder($email) {
        $d_now = date('Y-m-d H:i:s');
        $i_now  = strtotime($d_now);
        $this->send_report($d_now, $i_now, $email);
    }

    private function getDaysDiffLastCheck($ts_now)
    {
        $ts_last_check = strtotime($this->reminder->last_check);

        $seconds_diff = $ts_now - $ts_last_check;

        return floor($seconds_diff/3600/24);
    }
//
//    static function createTemplate($data)
//    {
//         ob_start();
//        $period_name = __('Yesterday', 'reminder');
//        if($this->reminder->days==7) {
//            $period_name = __('Last week', 'reminder');
//        }
//        include REMINDER_PATH . 'views/mail/admin-stats-base.php';
//        $out = ob_get_clean();
//        ob_end_flush();
//    }

    private function _extractDate($datetime) {
        $_a = explode(' ', $datetime);
        return $_a[0];
    }
    private function _extractTime($datetime) {
        $_a = explode(' ', $datetime);
        return $_a[1];
    }
}
