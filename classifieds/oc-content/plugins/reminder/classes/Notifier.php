<?php

class Notifier {

    var $test_mode;
    public function __construct($test_mode = false) {
        $this->test_mode = $test_mode;
    }

    public function checkReminders()
    {
        if(!isset($_SERVER['REMOTE_ADDR'])) $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        // get only enabled reminders
       $aReminder = ModelReminder::newInstance()->getReminders(true);
       foreach($aReminder as $_reminder) {
           echo "Checking ".$_reminder['s_slug'].PHP_EOL;
           $aEmails = array();
            $reminder = $this->createReminder( new Reminder($_reminder) );
            if($reminder!==false) {
                echo $_reminder['dt_last_check'].PHP_EOL;
                $aEmails = $reminder->run();
                echo  "  ---> ".count($aEmails)." <--- ".PHP_EOL ;
            } else {
                echo "error : ". $_reminder['s_slug'] . PHP_EOL ;
            }
       }
       flush();
    }

    public function createReminder($reminder)
    {
        switch ($reminder->slug) {
            case 'reminder-expired-item':
                return new ReminderItemExpired($reminder);
                break;
            case 'reminder-item-no-validated':
                return new ReminderItemNoValidated($reminder);
                break;
            case 'reminder-user-no-validated':
                return new ReminderUserNoValidated($reminder);
                break;
            case 'reminder-item-no-image':
                return new ReminderItemNoImages($reminder);
                break;
            case 'reminder-new-item':
                return new ReminderNewItem($reminder);
                break;
            case 'reminder-item-no-premium':
                return new ReminderItemMakePremium($reminder);
                break;
            case 'reminder-new-user':
                return new ReminderNewUser($reminder);
                break;
            case 'reminder-item-stats':
                return new ReminderItemStats($reminder);
                break;
            case 'reminder-admin-stats-daily':
                return new ReminderAdminStats($reminder);
                break;
            case 'reminder-admin-stats-weekly':
                return new ReminderAdminStats($reminder);
                break;
            default:
                return false;
                break;
        }
    }
}