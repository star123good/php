<?php
/*
Plugin Name: Butler
Plugin URI: butler
Description: Butler will clean expired and not activated listings and users
Version: 1.0.0
Author: Osclass
Author URI: http://www.osclass.org/
Short Name: butler
Plugin update URI: butler
*/

    require_once dirname(__FILE__) . '/ModelButler.php';

    function butler_install() {
        osc_set_preference('delete_expired', '0', 'butler', 'BOOLEAN');
        osc_set_preference('expired_days', '30', 'butler', 'INTEGER');

        osc_set_preference('delete_activated_listings', '0', 'butler', 'BOOLEAN');
        osc_set_preference('activated_listings_days', '30', 'butler', 'INTEGER');

        osc_set_preference('delete_spam', '0', 'butler', 'BOOLEAN');
        osc_set_preference('spam_days', '30', 'butler', 'INTEGER');

        osc_set_preference('delete_activated_users', '0', 'butler', 'BOOLEAN');
        osc_set_preference('activated_users_days', '30', 'butler', 'INTEGER');

        osc_set_preference('expired_listings', '0', 'butler', 'INTEGER');
        osc_set_preference('activated_listings', '0', 'butler', 'INTEGER');
        osc_set_preference('spam_listings', '0', 'butler', 'INTEGER');
        osc_set_preference('activated_users', '0', 'butler', 'INTEGER');

        osc_set_preference('limit', 250, 'butler');
    }

    function butler_uninstall() {
        Preference::newInstance()->delete(array('s_section' => 'butler'));
    }

    function butler_admin_menu() {
        osc_add_admin_submenu_divider('plugins', 'Butler plugin', 'butler_divider', 'administrator');
        osc_add_admin_submenu_page('plugins', __('Configure Butler plugin', 'butler'), osc_route_admin_url('butler-admin-conf'), 'butler_conf', 'administrator');
        osc_add_admin_submenu_page('plugins', __('Butler stats', 'butler'), osc_route_admin_url('butler-admin-stats'), 'butler_stats', 'administrator');
    }
    osc_add_hook('admin_menu_init', 'butler_admin_menu');

    function butler_cron() {
        $limit = (int)osc_get_preference('limit', 'butler');
        if(!is_numeric($limit) || $limit<1) {
            $limit = 1;
        }

        if(osc_get_preference('delete_expired', 'butler')==1) {
            butler_delete_expired(osc_get_preference('expired_days', 'butler'), $limit);
        }
        if(osc_get_preference('delete_activated_listings', 'butler')==1) {
            butler_delete_activated_listings(osc_get_preference('activated_listings_days', 'butler'), $limit);
        }
        if(osc_get_preference('delete_spam', 'butler')==1) {
            butler_delete_spam(osc_get_preference('spam_days', 'butler'), $limit);
        }
        if(osc_get_preference('delete_activated_users', 'butler')==1) {
            butler_delete_activated_users(osc_get_preference('activated_users_days', 'butler'), $limit);
        }
    }
    osc_add_hook('cron_hourly', 'butler_cron');

    function butler_delete_expired($days = 30, $limit = 1000) {
        $items = ModelButler::newInstance()->expired($days, $limit);
        $mItems  = new ItemActions( true );
        $numSuccess = 0;
        foreach($items as $item) {
            $success = $mItems->delete($item['s_secret'], $item['pk_i_id']);
            if($success) {
                $numSuccess++;
            }
        }
        osc_set_preference('expired_listings', (int)osc_get_preference('expired_listings', 'butler')+$numSuccess, 'butler', 'INTEGER');
    }

    function butler_delete_activated_listings($days = 30, $limit = 1000) {
        $items = ModelButler::newInstance()->inactivatedListings($days, $limit);
        $mItems  = new ItemActions( true );
        $numSuccess = 0;
        foreach($items as $item) {
            $success = $mItems->delete($item['s_secret'], $item['pk_i_id']);
            if($success) {
                $numSuccess++;
            }
        }
        osc_set_preference('activated_listings', (int)osc_get_preference('activated_listings', 'butler')+$numSuccess, 'butler', 'INTEGER');
    }

    function butler_delete_spam($days = 30, $limit = 1000) {
        $items = ModelButler::newInstance()->spam($days, $limit);
        $mItems  = new ItemActions( true );
        $numSuccess = 0;
        foreach($items as $item) {
            $success = $mItems->delete($item['s_secret'], $item['pk_i_id']);
            if($success) {
                $numSuccess++;
            }
        }
        osc_set_preference('spam_listings', (int)osc_get_preference('spam_listings', 'butler')+$numSuccess, 'butler', 'INTEGER');
    }

    function butler_delete_activated_users($days = 30, $limit = 1000) {
        $users = ModelButler::newInstance()->inactivatedUsers($days, $limit);
        $mUsers  = User::newInstance();
        $numSuccess = 0;
        foreach($users as $user) {
            $success = $mUsers->deleteUser($user['pk_i_id']);
            if($success) {
                $numSuccess++;
            }
        }
        osc_set_preference('activated_users', (int)osc_get_preference('activated_users', 'butler')+$numSuccess, 'butler', 'INTEGER');
    }

    osc_add_route('butler-admin-conf', 'butler/admin/conf', 'butler/admin/conf', osc_plugin_folder(__FILE__).'views/admin/conf.php');
    osc_add_route('butler-admin-stats', 'butler/admin/stats', 'butler/admin/stats', osc_plugin_folder(__FILE__).'views/admin/stats.php');

    osc_add_hook('admin_header', 'butler_init_pageHeader');
    function butler_init_pageHeader() {
        $_r = Params::getParam('route');
        switch ($_r) {
            case 'butler-admin-conf':
            case 'butler-admin-stats':
                osc_remove_hook('admin_page_header', 'customPageHeader');
                osc_add_hook('admin_page_header', 'butler_PageHeader');
                break;
            default:
                break;
        }
    }

    function butler_PageHeader() {
    ?>
        <h1><?php _e('Butler plugin', 'butler'); ?></h1>
    <?php
    }
    osc_register_plugin(osc_plugin_path(__FILE__), 'butler_install');
    osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'butler_uninstall');

