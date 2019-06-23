<?php
    // from index.php
    define('ABS_PATH', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']) . '/'));

    // ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
    session_start();

    require_once ABS_PATH . 'config.php';
    require_once LIBRARY_PATH . 'lib.php';

    // sessions
    if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] > 0) $customer_id = $_SESSION['customer_id'];
    else $customer_id = 0;
    if(isset($_SESSION['profile_id']) && $_SESSION['profile_id'] > 0) $profile_id = $_SESSION['profile_id'];
    else $profile_id = 0;
    if(isset($_SESSION['adminer_id']) && $_SESSION['adminer_id'] > 0) $adminer_id = $_SESSION['adminer_id'];
    else $adminer_id = 0;

    

    // type is customer or profile, etc.
    $type = "login";
    if(isset($_GET['type']) && $_GET['type'] != "") $type = $_GET['type'];
    // page
    $current_page = 1;
    if(isset($_GET['page']) && $_GET['page'] > 1) $current_page = $_GET['page'];
    // customer_id
    $customer_pk_id = 0;
    if(isset($_GET['customer']) && $_GET['customer'] > 0) $customer_pk_id = $_GET['customer'];
    // profile_id
    $profile_pk_id = 0;
    if(isset($_GET['profile']) && $_GET['profile'] > 0) $profile_pk_id = $_GET['profile'];
    // site_id
    $site_id = 0;
    if(isset($_GET['site']) && $_GET['site'] > 0) $site_id = $_GET['site'];
    // submit count
    $submit_count = 0;
    if(isset($_GET['submit_count']) && $_GET['submit_count'] > 0) $submit_count = $_GET['submit_count'];
    // random submit count
    $random_submit_count = 0;
    if(isset($_GET['random_count']) && $_GET['random_count'] > 0) $random_submit_count = $_GET['random_count'];


    // router    
    require_once LIBRARY_PATH . 'routes.php';

?>