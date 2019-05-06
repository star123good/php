<?php
if(file_exists("./install.php")) {
	header("Location: ./install.php");
} 
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
if(file_exists("./install.php")) {
	header("Location: ./install.php");
} 
include("configs/bootstrap.php");
include("includes/bootstrap.php");
include(getLanguage($settings['url'],null,null));
check_unpayed();
if(checkSession()) {
	check_user_verify_status();
}
$a = protect($_GET['a']);
include("sources/header.php");
switch($a) {
	case "login": include("sources/login.php"); break;
	case "register": include("sources/register.php"); break;
	case "pay": include("sources/pay.php"); break;
	case "track": include("sources/track.php"); break;
	case "cancel": include("sources/cancel.php"); break;
	case "payment_success": include("sources/payment_success.php"); break;
	case "payment_fail": include("sources/payment_fail.php"); break;
	case "account": include("sources/account.php"); break;
	case "leave_feedback": include("sources/leave_feedback.php"); break;
	case "page": include("sources/page.php"); break;
	case "feedbacks": include("sources/feedbacks.php"); break;
	case "blog": include("sources/blog.php"); break;
	case "post": include("sources/post.php"); break;
	case "password": include("sources/password.php"); break;
	case "email_verify": include("sources/email_verify.php"); break;
	case "logout": 
		unset($_SESSION['eex_uid']);
		unset($_COOKIE['eex_uid']);
		setcookie("easyexchanger_eex_uid", "", time() - (86400 * 30), '/'); // 86400 = 1 day
		session_unset();
		session_destroy();
		header("Location: $settings[url]");
	break;
	default: include("sources/homepage.php");
}
include("sources/footer.php");
mysqli_close($db);
?>