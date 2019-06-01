<?php

class AdminSettings {

    function __construct() {
        /**
         * Register js scripts
         */
        if(osc_version()<359) {
            osc_register_script('reminder-admin-js', osc_plugin_url('reminder') . 'reminder/assets/js/admin.old.js');
        } else {
            osc_register_script('reminder-admin-js', osc_plugin_url('reminder') . 'reminder/assets/js/admin.js');
        }

        /**
        * Routes
        */
        osc_add_route('reminder-frm', 'reminder-frm/?(.*)?/?(\d?)/?', 'reminder-frm/{slug}/{days}', 'reminder/admin/reminder_frm.php');
        osc_add_route('reminder-add', 'reminder-add', 'reminder-add', 'reminder/admin/reminder_add.php');
        osc_add_route('reminder-add-stats', 'reminder-add-stats', 'reminder-add-stats', 'reminder/admin/reminder_add_stats.php');
        osc_add_route('reminder-delete', 'reminder-delete/?(.*)?/?(\d?)/?', 'reminder-delete/{slug}{days}', 'reminder/admin/reminder_delete.php');
        osc_add_route('reminder-toggle-enable', 'reminder-toggle-enable/?(.*)?/?(\d?)/?', 'reminder-toggle-enable/{slug}{days}', 'reminder/admin/reminder_delete.php');
        osc_add_route('reminder-test-reminder', 'reminder-test-reminder', 'reminder-test-reminder/', 'reminder/admin/reminder_delete.php');
        osc_add_route('reminder-manage', 'reminder-manage', 'reminder-manage', 'reminder/admin/reminder_manage.php');
        osc_add_route('reminder-conf', 'reminder-conf', 'reminder-conf', 'reminder/admin/reminder_conf.php');
        osc_add_route('reminder-stats', 'reminder-stats/?', 'reminder-stats/', 'reminder/admin/reminder_stats.php');
        osc_add_route('reminder-stats-day', 'reminder-stats-day/?(.*)?', 'reminder-stats-day/{date}/', 'reminder/admin/reminder_stats_day.php');


        /**
        * Init hooks
        */
        osc_add_filter('admin_menu', array(&$this, 'reminder_admin_menu'));
        osc_add_hook('admin_header', array(&$this, 'reminder_init_pageHeader'));
        osc_add_hook('init', array(&$this, 'reminder_admin_settings_post'));
        osc_add_hook('init', array(&$this, 'reminder_admin_load_frm'));
        osc_add_hook('init', array(&$this, 'reminder_admin_enqueue'));

    }

    function reminder_init_pageHeader() {
        $_r = Params::getParam('route');
        switch ($_r) {
            case 'reminder-frm':
            case 'reminder-manage':
            case 'reminder-add':
            case 'reminder-add-stats':
                osc_remove_hook('admin_page_header', 'customPageHeader');
                osc_add_hook('admin_page_header',array(&$this, 'reminder_PageHeader'));
                break;
            default:
                break;
        }
    }

    function reminder_admin_menu() {
        echo '<h3><a href="#">Reminder plugin</a></h3>
        <ul>
            <li><a href="' . osc_route_admin_url('reminder-manage') . '">' . __('Manage reminders', 'reminder') . '</a></li>
        </ul>';
    }

    function reminder_PageHeader() {
    ?>
        <h1><?php _e('Reminder plugin', 'reminder'); ?></h1>
    <?php
    }

    function reminder_admin_settings_post() {
        // DELETE REMINDER
        if( osc_is_admin_user_logged_in() && Params::getParam('route')=='reminder-delete') {
            $slug  = Params::getParam('slug');
            $days  = Params::getParam('days');

            if(ModelReminder::newInstance()->deleteBySlugDay($slug, $days)==1) {
                osc_add_flash_ok_message(__('Reminder has been deleted', 'reminder'));
            } else {
                osc_add_flash_error_message(__('Some error occured, reminder cannot be deleted', 'reminder'));
            }
            osc_redirect_to(osc_route_admin_url('reminder-manage'));
        }
        // TEST REMINDER
        if( osc_is_admin_user_logged_in() && Params::getParam('route')=='reminder-test-reminder') {
            $slug   = Params::getParam('slug');
            $days  = Params::getParam('days');
            $email = Params::getParam('email');
            if($slug=='' || $days=='' || $email=='') {
                osc_add_flash_error_message(__('Reminder not found', 'reminder'));
                osc_redirect_to(osc_route_admin_url('reminder-manage'));
            }

            $n = new Notifier();
            $_r = ModelReminder::newInstance()->findBySlugDays($slug, $days);
            $reminder = $n->createReminder(new Reminder($_r));
            $reminder->testReminder($email);
            osc_add_flash_ok_message(__('Test reminder has been sent', 'reminder'));
            osc_redirect_to(osc_route_admin_url('reminder-manage'));
        }
        // TOGGLE ENABLE 0/1
        if( osc_is_admin_user_logged_in() && Params::getParam('route')=='reminder-toggle-enable') {
            $slug  = Params::getParam('slug');
            $days  = Params::getParam('days');
            if($slug=='' || $days=='') {
                osc_add_flash_error_message(__('Reminder not found', 'reminder'));
                osc_redirect_to(osc_route_admin_url('reminder-manage'));
            }

            if(ModelReminder::newInstance()->toggleEnabled($slug, $days)) {
                osc_add_flash_ok_message(__('Reminder has been updated', 'reminder'));
            } else {
                osc_add_flash_error_message(__('Some error occured, reminder cannot be updated', 'reminder'));
            }
            osc_redirect_to(osc_route_admin_url('reminder-manage'));
        }
        // CONF
        if (Params::getParam('reminder_admin') == 'reminder-admin-conf-post') {
            osc_set_preference('bcc_email', Params::getParam('bcc_email'), 'reminder');
            osc_set_preference('bcc_stats_email', Params::getParam('bcc_stats_email'), 'reminder');
            osc_add_flash_ok_message(__('Configuration has been updated', 'reminder'));
            osc_redirect_to(osc_route_admin_url('reminder-conf'));
        }
        // STATS
        if (Params::getParam('route') == 'reminder-stats') {

            // get stats today
            $aStatsLast30 = ModelReminder::newInstance()->getStatsLast30();

            // enqueue juery datepicker


            View::newInstance()->_exportVariableToView('aStatsLast30', $aStatsLast30);

        }

        if (Params::getParam('route') == 'reminder-stats-day') {
            $date = Params::getParam('date');
            error_log("route stats-day $date");
            if($date=='') {
                osc_add_flash_ok_message(__('Date cannot be empty', 'reminder'));
                osc_redirect_to(osc_route_admin_url('reminder-stats'));
            }
            // get stats today
            $aStats = ModelReminder::newInstance()->getStatsByDay($date);

            // enqueue juery datepicker


            View::newInstance()->_exportVariableToView('aStats', $aStats);
        }

        // ADD / EDIT REMINDER
        if (Params::getParam('reminder_admin') == 'reminder-admin-settings-post') {
            $aData = hReminder::_getInputFrm();
            if (Params::getParam('plugin_action') == 'add') {
                $i_now = strtotime(date('Y-m-d H:i:s'));
                $days   = $aData['i_days'] * (86400);
                $str_date = Params::getParam('start_date');
                /*
                 * dt_last_date
                 */
                if($str_date!='') {
                    $dt_last_check              = date('Y-m-d', $i_now ).' '.$str_date.':00';
                } else {
                    $dt_last_check              = date('Y-m-d H:i:s', $i_now  );
                }
                $aData['dt_last_check'] = $dt_last_check;
                $aData['dt_created']     = date('Y-m-d H:i:s', $i_now  );
                $result = ModelReminder::newInstance()->insertReminder($aData);
            } else {
                $result = ModelReminder::newInstance()->updateReminder($aData);
            }

            if ($result) {
                osc_add_flash_ok_message(__('Reminder correctly saved', 'reminder'));
            } else {
                osc_add_flash_error_message(__('Reminder already exist or there was an error.', 'reminder'));
            }
            osc_redirect_to(osc_route_admin_url('reminder-manage'));
        }
    }

    function reminder_admin_load_frm() {
        if (Params::getParam('route') != 'reminder-frm') {
            return false;
        }
        $custom_start_hour = false;
        if (Params::getParam('days') != '') {
            $reminder = ModelReminder::newInstance()->findBySlugDays(Params::getParam('slug'), Params::getParam('days'));

            if (!isset($reminder['s_slug'])) {
                osc_add_flash_error_message(__('Reminder not found', 'reminder'));
                osc_redirect_to(osc_route_admin_url('reminder-manage'));
            }

            $days        = $reminder['i_days'];
            $subject    = $reminder['s_subject'];
            $enabled   = $reminder['b_enabled'];
            $body_content = $reminder['s_body_content'];
            $plugin_action = 'edit';
        } else {
            $plugin_action = 'add';
            $days = 2; // default days
            $enabled = 0;
            if (Params::getParam('slug') == 'reminder-item-no-validated') {
                $subject = "Validate your listing - {WEB_TITLE}";
                $body_content = "<p>Hi {USER_NAME},</p><p>You're receiving this e-mail because you’ve published a listing at {WEB_LINK}.</p><p>Please validate this listing by clicking on the following link: {VALIDATION_LINK}.</p></p> If you didn't publish this listing, please ignore this e-mail.</p><p>Listing details:</p><p>Contact name: {USER_NAME}<br />Contact e-mail: {USER_EMAIL}</p><p>{ITEM_DESCRIPTION}</p><p>Url: {ITEM_LINK}</p><p>Even if you're not registered at {WEB_LINK}, you can still edit or delete your listing:</p><p>You can edit your listing by following this link: {EDIT_LINK}</p><p>You can delete your listing by following this link: {DELETE_LINK}</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-user-no-validated') {
                $subject = "Please validate your {WEB_TITLE} account";
                $body_content = "<p>Hi {USER_NAME},</p><p>Please validate your registration by clicking on the following link:</p></p> {VALIDATION_LINK}</p><p>Thank you!</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-item-no-image') {
                $subject = "Please upload images to your listing";
                $body_content = "<p>Hi {USER_NAME},</p><p>Please upload images to your listing , more images are more visits.</p><p>{EDIT_LINK} </p><p>Thank you!</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-new-item') {
                $subject = "Custom new listing reminder - CHANGE ME";
                $body_content = "<p>Hi {USER_NAME},</p><p>HERE YOUR CUSTOM MESSAGE</p>Thank you!</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-expired-item') {
                $subject = "Your expired listing at {WEB_TITLE}";
                $body_content = "<p>Hi {USER_NAME},</p><p>You're receiving this e-mail because your listing published at {WEB_LINK} has expired.</p><p><span>Listing details:</span></p><p>Contact name: {USER_NAME}<br />Contact e-mail: {USER_EMAIL}</p><p>{ITEM_DESCRIPTION}</p><p>Url: {ITEM_LINK}</p><p>You can delete your listing by following this link: {DELETE_LINK}</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-new-user') {
                $subject = "Custom new user reminder - CHANGE ME";
                $body_content = "<p>Hi {USER_NAME},</p><p>HERE YOUR CUSTOM MESSAGE</p>Thank you!</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-item-stats') {
                $subject = "Your listing stats {WEB_TITLE}";
                $body_content = "<p>Hi {USER_NAME},</p>{LISTING_STATS}<p>Thank you!</p><p>Regards,</p><p>{WEB_LINK}</p>";
            }
            if (Params::getParam('slug') == 'reminder-admin-stats-daily') {
                $days = 1;
                $custom_start_hour = true;
                $subject = "Daily stats {WEB_TITLE}";
                $body_content = "<b>Description is not used</b>";
                View::newInstance()->_exportVariableToView('reminder_force_days', "true");
            }
            if (Params::getParam('slug') == 'reminder-admin-stats-weekly') {
                $days = 7;
                $custom_start_hour = true;
                $subject = "Weekly stats {WEB_TITLE}";
                $body_content = "<b>Description is not used</b>";
                View::newInstance()->_exportVariableToView('reminder_force_days', "true");
            }
        }
        $legend['{WEB_URL}']    = osc_base_url();
        $legend['{WEB_TITLE}']  = osc_page_title();
        $legend['{WEB_LINK}']   = '<a href="' . osc_base_url() . '">' . osc_page_title() . '</a>';

        View::newInstance()->_exportVariableToView('plugin_action', $plugin_action);
        View::newInstance()->_exportVariableToView('slug', Params::getParam('slug'));
        View::newInstance()->_exportVariableToView('days', $days);
        View::newInstance()->_exportVariableToView('subject', $subject);
        View::newInstance()->_exportVariableToView('enabled', $enabled);
        View::newInstance()->_exportVariableToView('custom_start_hour', $custom_start_hour);
        View::newInstance()->_exportVariableToView('body_content', $body_content);

    }

    /**
     * Enqueue css / js
     */
    function reminder_admin_enqueue() {
        if (strpos(Params::getParam('file'), "reminder/admin/settings.php") !== false) {
            osc_enqueue_style('admin-css', osc_current_admin_theme_styles_url('main.css'));
            osc_enqueue_style('reminder-admin', osc_plugin_url(__FILE__) . '../assets/css/admin.css');
        }
        if (Params::getParam('route') == 'reminder-frm') {
            osc_enqueue_script('tiny_mce');
            osc_enqueue_script('reminder-admin-js', array('tiny_mce'));
            osc_enqueue_style('admin-css', osc_current_admin_theme_styles_url('main.css'));
            osc_enqueue_style('reminder-admin', osc_plugin_url(__FILE__) . '../assets/css/admin.css');
        }
    }

}
