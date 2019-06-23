<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

$flag_show = false;

// redirect
if($customer_id == 0 && (strpos($type, "profile") !== false || strpos($type, "submit") !== false)) $type = "login";
if($profile_id == 0 && (strpos($type, "submit") !== false)) $type = "profile";

// route page
switch($type){
    case 'post_login':
        $type = "login";
        $flag_show = false;
        $page = "campaign_customer.php";
        break;
    case 'register':
        $flag_show = true;
        $page = "edit_customer.php";
        break;
    case 'post_register':
        $type = "register";
        $flag_show = false;
        $page = "campaign_customer.php";
        break;
    case 'profile':
        $flag_show = true;
        $page = "edit_profile.php";
        break;
    case 'edit_profile':
        $flag_show = true;
        $page = "edit_profile.php";
        break;
    case 'post_profile':
        $type = "profile";
        $flag_show = false;
        $page = "campaign_profile.php";
        break;
    case 'show_profile':
        $flag_show = true;
        $page = "show_profile.php";
        break;
    case 'delete_profile':
        $flag_show = false;
        $page = "campaign_profile.php";
        break;
    case 'logout':
        $flag_show = false;
        $page = "campaign_customer.php";
        break;
    case 'submit':
    case 'submit_login':
    case 'submit_ads':
        $flag_show = false;
        $page = "campaign_submit.php";
        break;
    case 'customers':
        $flag_show = true;
        $page = "show_customers.php";
        break;
    case 'customer':
        $flag_show = true;
        $page = "show_customer.php";
        break;
    case 'customer_edit':
        $flag_show = true;
        $page = "edit_customer.php";
        break;
    case 'post_customer_edit':
        $flag_show = false;
        $page = "campaign_customer.php";
        break;
    case 'customer_delete':
        $flag_show = false;
        $page = "campaign_customer.php";
        break;
    case 'show_sites':
        $flag_show = true;
        $page = "show_sites.php";
        break;
    case 'add_site':
    case 'edit_site':
        $flag_show = true;
        $page = "edit_site.php";
        break;
    case 'post_site':
    case 'delete_site':
        $flag_show = false;
        $page = "campaign_site.php";
        break;
    case 'login':
    default:
        $type = "login";
        $flag_show = true;
        $page = "edit_customer.php";
        break;
}

if($flag_show) $page_path = PAGES_PATH;
else $page_path = CONTROLLERS_PATH;

if($flag_show) require_once COMPONENTS_PATH . 'header.php';
require_once $page_path . $page;
if($flag_show) require_once COMPONENTS_PATH . 'footer.php';

?>