<?php

class ReminderTest {

    var $reminder;
    var $title;
    var $description;
    var $requirements;
    var $type;
    var $legend;

    public function __construct($reminder) {
        $this->reminder = $reminder;
        $this->type = '';
        $this->title = '';
        $this->description = '';
        $this->requirements = array();
        $this->legend = array();
    }

    public function testReminder($email) {
        $words = array();
        $words[] = array('-');
        $words[] = array('-');
        $title = osc_mailBeauty($this->reminder->subject, $words);
        $body = osc_mailBeauty($this->reminder->body, $words);

        $params = array(
            'to' => $email,
            'subject' => "/testing/ " . $title,
            'body' => $body
        );
        osc_sendMail($params);
    }

    function sendMail($params) {
        $params['to'] = osc_apply_filter('reminder_email_to', $params['to']);
        $_bcc = trim(osc_get_preference('bcc_email', 'reminder'));
        // prevent send to email with same [to] and [bcc]
        if ($_bcc != '' && $_bcc != $params['to']) {
            $_params = $params;
            $_params['subject'] = "/copy/ " . $params['subject'];
            $_params['to'] = $_bcc;
            osc_sendMail($_params);
        }
        // update db registry
        ModelReminder::newInstance()->increase_stat();
        ModelReminder::newInstance()->log_reminder($this->reminder->slug, $this->reminder->days, $params['to']);
        return osc_sendMail($params);
    }

    protected function _set_requirement($name) {
        $desc = null;
        switch ($name) {
            case ER_ITEM_NO_VALIDATED:
                $desc = __('Listing NOT validated.', 'reminder');
                break;
            case ER_ITEM_VALIDATED:
                $desc = __('Listing validated.', 'reminder');
                break;
            case ER_ITEM_NO_PREMIUM:
                $desc = __('Listing no premium.', 'reminder');
                break;
            case ER_ITEM_UNBLOCKED:
                $desc = __('Listing unblocked.', 'reminder');
                break;
            case ER_ITEM_VALIDATED_OR_WAITING:
                $desc = __('Validated or waiting validation.', 'reminder');
                break;
            case ER_ITEM_NO_SPAM:
                $desc = __('Listing not mark as spam.', 'reminder');
                break;
            case ER_ITEM_WITHOUT_IMAGES:
                $desc = __('Listing WITHOUT images', 'reminder');
                break;
            case ER_USER_NO_VALIDATED:
                $desc = __('Listing NOT validated.', 'reminder');
                break;
            case ER_USER_UNBLOCKED:
                $desc = __('Listing unblocked.', 'reminder');
                break;
            case ER_USER_VALIDATED_OR_WAITING:
                $desc = __('Validated or waiting validation.', 'reminder');
                break;
            default:
                return false;
                break;
        }
        if ($desc !== null) {
            $this->requirements[] = $desc;
        }
    }

}
