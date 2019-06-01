<?php

class ReminderItemNoImages extends ReminderTest{
    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->title = __('New listing without images is published', 'reminder');
        $this->description = __('Sends an email with the edit link on it, to those listings that has not upload images on it since more than X days ago from registration date.', 'reminder');
        $this->_set_requirement(ER_ITEM_WITHOUT_IMAGES);
        $this->_set_requirement(ER_ITEM_UNBLOCKED);
        $this->legend['{USER_NAME}']     = __('User name', 'reminder');
        $this->legend['{EDIT_LINK}']        = __('Edit listing url', 'reminder');

        $this->type = ER_LISTING_REMINDER;
    }

    public function run() {
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // update end date
        $days = $this->reminder->days * (86400);
        $d_end = date('Y-m-d H:i:s', $i_now - $days);

        $aEmails = ModelReminder::newInstance()->getItemNoImagesEmails($this->reminder->last_check, $d_end);

        foreach ($aEmails as $email) {

            // populate email body
            $edit_url = osc_item_edit_url($email['s_secret'], $email['pk_i_id']);
            $words = array();
            $words[] = array(
                '{USER_NAME}',
                'EDIT_URL',
                '{EDIT_LINK}'
            );
            $words[] = array(
                $email['s_name'],
                $edit_url,
                '<a href="'.$edit_url.'">'.$edit_url.'</a>'
            );
            $title = osc_mailBeauty($this->reminder->subject, $words);
            $body = osc_mailBeauty($this->reminder->body, $words);

            $params = array(
                'to'        => $email['s_contact_email'],
                'subject' => $title,
                'body' => $body
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
