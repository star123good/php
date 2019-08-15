<?php
    // from index.php
    define('ABS_PATH', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']) . '/'));

    session_start();

    require_once ABS_PATH . 'config.php';
    require_once LIB_PATH . 'lib.php';

    // sessions
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) $user_id = $_SESSION['user_id'];
    else $user_id = 0;

    // GET parameters
    if(isset($_GET['page']) && $_GET['page'] != "") $page = $_GET['page'];
    else $page = "home";

    // page type
    if(isset($_POST['type']) && $_POST['type'] != '') $page_type = $_POST['type'];
    else $page_type = "";
    
    // router
    require_once LIB_PATH . 'route.php';

?>