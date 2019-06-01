<?php

class ReminderNewItem extends ReminderTest{
    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->title = __('New listing is published', 'reminder');
        $this->description = __('Sends a custom email, to those listings that has been created since more than X days ago from publication date.', 'reminder');
        $this->_set_requirement(ER_ITEM_UNBLOCKED);
        $this->_set_requirement(ER_ITEM_VALIDATED_OR_WAITING);
        $this->legend['{USER_NAME}']     = __('User name', 'reminder');
        $this->legend['{ITEM_TITLE}']      = __('Listing title', 'reminder');
        $this->legend['{ITEM_LINK}']       = __('Listing url', 'reminder');
        $this->legend['{DELETE_LINK}']       = __('Delete listing url', 'reminder');

        $this->type = ER_LISTING_REMINDER;
    }

    public function run() {
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // update end date
        $days = $this->reminder->days * (86400);
        $d_end = date('Y-m-d H:i:s', $i_now - $days);

        $aEmails = ModelReminder::newInstance()->getNewItems($this->reminder->last_check, $d_end);

        foreach ($aEmails as $email ) {
            $aux_item = Item::newInstance()->extendData(array($email));
            View::newInstance()->_exportVariableToView('item', $aux_item[0]);

            $delete_url = osc_item_delete_url($email['s_secret'], $email['pk_i_id']);
            // populate email body
            $words = array();
            $words[] = array(
                '{USER_NAME}',
                '{ITEM_TITLE}',
                '{ITEM_LINK}',
                '{DELETE_LINK}',
                '{DELETE_URL}',
            );
            $words[] = array(
                $email['s_contact_name'],
                osc_item_title(),
                osc_item_url(),
                '<a href="' . $delete_url . '">' . $delete_url . '</a>',
                $delete_url
            );

            $title = osc_mailBeauty($this->reminder->subject, $words);
            $body = osc_mailBeauty($this->reminder->body, $words);

            $params = array(
                'to'        => $email['s_contact_email'],
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
