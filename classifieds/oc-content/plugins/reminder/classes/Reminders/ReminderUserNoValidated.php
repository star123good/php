<?php

class ReminderUserNoValidated extends ReminderTest {

    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->title = __('New user, validate account reminder', 'reminder');
        $this->description = __('Sends an email with the validation link on it, to those users that has been created since more than X days ago and has not been validated.', 'reminder');
        $this->_set_requirement(ER_USER_NO_VALIDATED);
        $this->_set_requirement(ER_USER_UNBLOCKED);
        $this->legend['{USER_NAME}'] = __('User name', 'reminder');
        $this->legend['{VALIDATION_LINK}'] = __('Validation user url', 'reminder');
        $this->legend['{DELETE_LINK}']       = __('Delete listing url', 'reminder');

        $this->type = ER_USER_REMINDER;
    }

    public function run() {

        /*
         *  search users -> no validated account
         *  - entre {última ejecución} y {HOY (-dias)}
         */
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // update end date
        $days = $this->reminder->days * (86400);
        $d_end = date('Y-m-d H:i:s', $i_now - $days);

        $aEmails = ModelReminder::newInstance()->getUserNoValidatedEmails($this->reminder->last_check, $d_end);

        foreach ($aEmails as $email) {

            // populate email body
            $validation_url = osc_user_activate_url($email['pk_i_id'], $email['s_secret']);
            $delete_url = osc_item_delete_url($email['s_secret'], $email['pk_i_id']);

            $words = array();
            $words[] = array(
                '{USER_NAME}',
                '{VALIDATION_LINK}',
                '{VALIDATION_URL}',
                '{DELETE_LINK}',
                '{DELETE_URL}'
            );
            $words[] = array(
                $email['s_name'],
                $validation_url,
                '<a href="' . $validation_url . '">' . $validation_url . "</a>",
                '<a href="' . $delete_url . '">' . $delete_url . '</a>',
                $delete_url
            );
            $title = osc_mailBeauty($this->reminder->subject, $words);
            $body = osc_mailBeauty($this->reminder->body, $words);

            $params = array(
                'to' => $email['s_email'],
                'subject' => $title,
                'body' => $body
            );

            $this->sendMail($params);
        }
        // update last_check
        ModelReminder::newInstance()->updateLastCheck(array(
            's_slug' => $this->reminder->slug,
            'i_days' => $this->reminder->days,
            'dt_last_check' => $d_end
        ));
        return $aEmails;
    }

}
