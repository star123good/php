<?php

class ReminderNewUser extends ReminderTest{
    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->title = __('New user registration', 'reminder');
        $this->description = __('Sends a custom email, to new users that has been created since more than X days ago from registration date.', 'reminder');
        $this->_set_requirement(ER_USER_UNBLOCKED);
        $this->_set_requirement(ER_USER_VALIDATED_OR_WAITING);
        $this->legend['{USER_NAME}']     = __('User name', 'reminder');
        $this->type = ER_USER_REMINDER;
    }

    public function run() {
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // update end date
        $days = $this->reminder->days * (86400);
        $d_end = date('Y-m-d H:i:s', $i_now - $days);

        $aEmails = ModelReminder::newInstance()->getNewUsers($this->reminder->last_check, $d_end);

        foreach ($aEmails as $email) {

            // populate email body
            $edit_link = osc_item_edit_url($email['s_secret'], $email['pk_i_id']);
            $words = array();
            $words[] = array(
                '{USER_NAME}'
            );
            $words[] = array(
                $email['s_name']
            );
            $title = osc_mailBeauty($this->reminder->subject, $words);
            $body = osc_mailBeauty($this->reminder->body, $words);

            $params = array(
                'to'        => $email['s_email'],
                'subject' => $title,
                'body'    => $body
            );

            $this->sendMail($params);
        }
        // update last_check
        ModelReminder::newInstance()->updateLastCheck( array(
            's_slug' => $this->reminder->slug,
            'i_days' => $this->reminder->days,
            'dt_last_check' => $d_end
        ));
        return $aEmails;
    }

}
