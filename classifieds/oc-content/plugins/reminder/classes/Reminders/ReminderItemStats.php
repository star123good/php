<?php

class ReminderItemStats extends ReminderTest{
    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->legend['{LISTING_STATS}']    = __('Listing statistics cell', 'reminder');
        $this->type = ER_LISTING_REMINDER;
    }

    public function run() {
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // update end date
        $days = $this->reminder->days * (86400);
        $d_end = date('Y-m-d H:i:s', $i_now - $days);

        $aEmails = ModelReminder::newInstance()->getNewItems($this->reminder->last_check, $d_end, true);

        foreach ($aEmails as $email) {

            // populate email body
            $edit_link = osc_item_edit_url($email['s_secret'], $email['pk_i_id']);
            $words = array();
            $words[] = array(
                '{USER_NAME}',
                '{ITEM_VIEWS}'
            );
            $words[] = array(
                $email['s_name'],
                $email['i_views']
            );
            $title = osc_mailBeauty($this->reminder->subject, $words);
            $body = osc_mailBeauty($this->reminder->body, $words);

            $params = array(
                'to'          => $email['s_contact_email'],
                'subject'   => $title,
                'body'      => $body
            );

            $this->sendMail($params);
        }
        return $aEmails;
    }

}
