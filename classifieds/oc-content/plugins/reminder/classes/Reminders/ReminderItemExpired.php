<?php

class ReminderItemExpired extends ReminderTest {

    public function __construct($reminder = array()) {
        parent::__construct($reminder);
        $this->title = __('Expired listings', 'reminder');
        $this->description = __('Sends a custom email after X days to those listings that has expired.', 'reminder');
        $this->_set_requirement(ER_ITEM_VALIDATED_OR_WAITING);
        $this->_set_requirement(ER_ITEM_UNBLOCKED);
        $this->legend['{USER_NAME}']     = __('User name', 'reminder');
        $this->legend['{USER_EMAIL}']     = __('User email', 'reminder');
        $this->legend['{DELETE_LINK}']    = __('Delete listing url', 'reminder');
        $this->legend['{ITEM_TITLE}']      = __('Listing title', 'reminder');
        $this->legend['{ITEM_DESCRIPTION}'] = __('Listing descriptio', 'reminder');
        $this->legend['{ITEM_LINK}']       = __('Listing url', 'reminder');
        $this->legend['{EDIT_LINK}']        = __('Edit listing url', 'reminder');
        $this->legend['{DELETE_LINK}']    = __('Delete listing url', 'reminder');

        $this->type = ER_LISTING_REMINDER;
    }

    public function run() {
        /*
         *  buscar items expirados
         *  - entre {última ejecución} y {HOY (-dias)}
         */
        $d_now = date('Y-m-d H:i:s');
        $i_now = strtotime($d_now);

        // update end date
        $days = $this->reminder->days * (86400);
        $d_end = date('Y-m-d H:i:s', $i_now - $days);

        $aItems = ModelReminder::newInstance()->getExpiredItems($this->reminder->last_check, $d_end);

        foreach ($aItems as $_item) {
            $tmp = Item::newInstance()->extendData(array($_item));
            $email = $tmp[0];
            View::newInstance()->_exportVariableToView('item', $email);
            // populate email body
            $validation_link = '<a href="' . osc_item_activate_url($email['s_secret'], $email['pk_i_id']) . '">' . osc_item_activate_url($email['s_secret'], $email['pk_i_id']) . '</a>';
            $item_url = osc_item_url();
            $item_link = '<a href="' . $item_url . '" >' . $item_url . '</a>';
            $edit_url = osc_item_edit_url($email['s_secret'], $email['pk_i_id']);
            $delete_url = osc_item_delete_url($email['s_secret'], $email['pk_i_id']);

            $words = array();
            $words[] = array(
                '{VALIDATION_LINK}',
                '{ITEM_ID}',
                '{USER_NAME}',
                '{USER_EMAIL}',
                '{ITEM_TITLE}',
                '{ITEM_DESCRIPTION}',
                '{ITEM_URL}',
                '{ITEM_LINK}',
                '{EDIT_LINK}',
                '{EDIT_URL}',
                '{DELETE_LINK}',
                '{DELETE_URL}'
            );

            $words[] = array(
                $validation_link,
                $email['pk_i_id'],
                $email['s_contact_name'],
                $email['s_contact_email'],
                $email['s_title'],
                $email['s_description'],
                $item_url,
                $item_link,
                '<a href="' . $edit_url . '">' . $edit_url . '</a>',
                $edit_url,
                '<a href="' . $delete_url . '">' . $delete_url . '</a>',
                $delete_url
            );
            $title = osc_mailBeauty($this->reminder->subject, $words);
            $body = osc_mailBeauty($this->reminder->body, $words);

            $params = array(
                'to' => $email['s_contact_email'],
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
        return $aItems;
    }

}
