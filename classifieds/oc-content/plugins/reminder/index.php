<?php
/*
  Plugin Name: Email reminder
  Plugin URI: http://garciademarina.com/email-reminder-osclass-plugin
  Description: Manage user or item based email reminders.
  Version: 2.2.0
  Author: garciademarina
  Author URI: http://garciademarina.com/
  Short Name: Reminder
  Plugin update URI: reminder
 */

define('REMINDER_PATH', str_replace('index.php', '', osc_plugin_path(__FILE__) ) );
define('REMINDER_VERSION', '220');
// define('REMINDER_DEBUG_EMAIL', 'email@example.com');

require_once 'constants.php';
require_once 'load.php';

if(OC_ADMIN) {
    $adminSettings = new AdminSettings();
}

/* Install / Uninstall functions */
function reminder_call_after_install() {
    ModelReminder::newInstance()->import("reminder/struct.sql") ;

}
function reminder_call_after_uninstall() {
    ModelReminder::newInstance()->uninstall();
}

/*
 * Cron function
 * - Also from cli oc-content/plugins/reminder/cron_hourly.php
 */
function reminder_auto_cron() {
    $notifier = new Notifier();
    $notifier->checkReminders();
}



// enable hourly cron
osc_add_hook('cron_hourly', 'reminder_auto_cron');
// This is needed in order to be able to activate the plugin
osc_register_plugin(osc_plugin_path(__FILE__), 'reminder_call_after_install');
// This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'reminder_call_after_uninstall');

/*
 *  Used only on development.
 */
function reminder_email_to_fn($to) {
    if(defined('REMINDER_DEBUG_EMAIL')) {
        return REMINDER_DEBUG_EMAIL;
    }
    return $to;
}
osc_add_filter('reminder_email_to', 'reminder_email_to_fn');

function reminder_update() {
    $version = osc_get_preference('version', 'reminder_plugin');
    if($version=='') {
        $version = '110';
        // *t_reminder_stats
        $conn = DBConnectionClass::newInstance();
        $data = $conn->getOsclassDb();
        $dbCommand = new DBCommandClass($data);
        $dbCommand->query(sprintf('
            CREATE TABLE `%st_reminder_stats` (
            `dt_date` datetime NOT NULL,
            `i_total_emails` int(11) DEFAULT \'0\',
            PRIMARY KEY (`dt_date`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;', DB_TABLE_PREFIX));

        $dbCommand->query(sprintf('
            CREATE TABLE `%st_reminder_stats_row` (
            `dt_date` datetime NOT NULL,
            `s_reminder_slug` varchar(100) NOT NULL DEFAULT \'\',
            `i_reminder_days` tinyint(3) NOT NULL DEFAULT \'0\',
            `s_email` varchar(255) NOT NULL DEFAULT \'\',
            PRIMARY KEY (`dt_date`,`s_reminder_slug`,`i_reminder_days`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;', DB_TABLE_PREFIX));
        osc_set_preference('version', '110','reminder_plugin');
    }

    if($version<220) {
        // *t_reminder_stats
        $conn = DBConnectionClass::newInstance();
        $data = $conn->getOsclassDb();
        $dbCommand = new DBCommandClass($data);
        $dbCommand->query(sprintf("ALTER TABLE %st_reminder MODIFY i_days INT(6) NOT NULL ;", DB_TABLE_PREFIX));
        osc_set_preference('version', '220','reminder_plugin');
    }
    osc_set_preference('version', REMINDER_VERSION,'reminder_plugin');
}
osc_add_hook('init', 'reminder_update');
