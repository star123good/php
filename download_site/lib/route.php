<?php

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    // initialize
    $js_files = array();
    $css_files = array();
    $flag_mainlayout = true;            // main layout
    $flag_redirect = false;              // redirect
    $flag_adminer = false;              // admin user
    $class_body = "";

    // get user
    if($user_id > 0){
        $users = select_rows($pdo, $table_user, "`id` = ".$user_id);
        if(count($users) > 0){
            $user = $users[0];
            $flag_adminer = $user['is_admin'];
        }
    }

    if(!$flag_adminer && in_array($page, array("admin", "save"))) $flag_redirect = true;

    // redirect
    if($flag_redirect) $page = "home";

    // page type - ajax
    if($page_type == "ajax") $flag_mainlayout = false;

    // route
    switch($page){
        case "downloaded":
            $css_files = array(
            );
            $js_files = array(
            );
            break;
        case "downloading":
            $css_files = array(
            );
            $js_files = array(
            );
            break;
        case "scan":
            $css_files = array(
            );
            $js_files = array(
            );
            break;
        case "home":
        default :
            $css_files = array();
            $js_files = array();
            break;
    }

    // signalR & conveyor & sweetalert -> css | js
    if($flag_mainlayout){
        $css_files = array_merge($css_files, array(
            CSS_PATH . "bootstrap/bootstrap.css",
            CSS_PATH . "animate.css",
            FONT_PATH . "ionicons/css/ionicons.min.css",
            CSS_PATH . "owl.carousel.min.css",
            FONT_PATH . "flaticon/font/flaticon.css",
            FONT_PATH . "fontawesome/css/font-awesome.min.css",
            CSS_PATH . "bootstrap-datepicker.css",
            CSS_PATH . "select2.css",
            CSS_PATH . "helpers.css",
            CSS_PATH . "style.css"
        ));
        $js_files = array_merge($js_files, array(
            JS_PATH . "jquery.min.js",
            JS_PATH . "popper.min.js",
            JS_PATH . "bootstrap.min.js",
            JS_PATH . "owl.carousel.min.js",
            JS_PATH . "bootstrap-datepicker.js",
            JS_PATH . "jquery.waypoints.min.js",
            JS_PATH . "jquery.easing.1.3.js",
            JS_PATH . "select2.min.js",
            JS_PATH . "main.js"
        ));
    }


    if($flag_mainlayout){
        include_once(COMPONENT_PATH . "header.php");
        include_once(PAGE_PATH . $page . ".php");
        include_once(COMPONENT_PATH . "footer.php");
    }
    else{
        include_once(PAGE_PATH . $page . ".php");
    }
?>