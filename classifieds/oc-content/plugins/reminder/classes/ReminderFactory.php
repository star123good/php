<?php

class ReminderFactory {

    public static function create($reminder_type) {
        switch ($reminder_type) {
            case 'reminder-item-no-validated':
                return new ReminderItemNoValidated();
                break;
            case 'reminder-expired-item':
                return new ReminderItemExpired();
                break;
            case 'reminder-user-no-validated':
                return new ReminderUserNoValidated();
                break;
            case 'reminder-item-no-image':
                return new ReminderItemNoImages();
                break;
            case 'reminder-new-item':
                return new ReminderNewItem();
                break;
            case 'reminder-item-no-premium':
                return new ReminderItemMakePremium();
                break;
            case 'reminder-new-user':
                return new ReminderNewUser();
                break;
            case 'reminder-item-stats':
                return new ReminderItemStats();
                break;
            case 'reminder-admin-stats-daily':
                return new ReminderAdminStats();
                break;
            case 'reminder-admin-stats-weekly':
                return new ReminderAdminStats();
                break;
            default:
                return false;
                break;
        }
    }
}
