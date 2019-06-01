<?php
require_once 'models/ModelReminder.php';
require_once 'classes/ReminderTest.php';
require_once 'classes/Reminders/Reminder.php';
require_once 'classes/Reminders/ReminderItemNoValidated.php';
require_once 'classes/Reminders/ReminderUserNoValidated.php';
require_once 'classes/Reminders/ReminderItemNoImages.php';
require_once 'classes/Reminders/ReminderNewItem.php';
require_once 'classes/Reminders/ReminderItemMakePremium.php';
require_once 'classes/Reminders/ReminderItemStats.php';
require_once 'classes/Reminders/ReminderAdminStats.php';
require_once 'classes/Reminders/ReminderNewUser.php';
require_once 'classes/Reminders/ReminderItemExpired.php';
require_once 'classes/ReminderFactory.php';
require_once 'classes/Notifier.php';
require_once 'classes/AdminSettings.php';
require_once 'helpers.php';

function reminder_get_all() {
    return array(
        'reminder-new-item',
        'reminder-item-no-validated',
        'reminder-item-no-image',
        'reminder-expired-item',
        'reminder-item-no-premium',
        'reminder-new-user',
        'reminder-user-no-validated',
    );
}