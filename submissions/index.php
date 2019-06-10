<?php
    // from index.php
    define('ABS_PATH', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']) . '/'));

    // ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
    session_start();

    require_once ABS_PATH . 'config.php';
    require_once ABS_PATH . 'lib.php';

    if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] > 0) $customer_id = $_SESSION['customer_id'];
    else $customer_id = 0;
    if(isset($_SESSION['profile_id']) && $_SESSION['profile_id'] > 0) $profile_id = $_SESSION['profile_id'];
    else $profile_id = 0;

    $flag_show = false;

    // type is customer or profile
    $type = "login";
    if(isset($_GET['type']) && $_GET['type'] != "") $type = $_GET['type'];

    if($customer_id == 0 && (strpos($type, "profile") !== false || strpos($type, "submit") !== false)) $type = "login";
    if($profile_id == 0 && (strpos($type, "submit") !== false)) $type = "profile";
    
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
        case 'post_profile':
            $type = "profile";
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
        case 'login':
        default:
            $type = "login";
            $flag_show = true;
            $page = "edit_customer.php";
            break;
    }

    if($flag_show) require_once ABS_PATH . 'header.php';
    require_once ABS_PATH . $page;
    if($flag_show) require_once ABS_PATH . 'footer.php';
?>