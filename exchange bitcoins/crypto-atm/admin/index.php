<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
if(checkAdminSession()) {
	include("sources/header.php");
	$a = protect($_GET['a']);
	switch($a) {
		case "gateways": include("sources/gateways.php"); break;
		case "directions": include("sources/directions.php"); break;
		case "rates": include("sources/rates.php"); break;
		case "exchanges": include("sources/exchanges.php"); break;
		case "users": include("sources/users.php"); break;
		case "feedbacks": include("sources/feedbacks.php"); break;
		case "pages": include("sources/pages.php"); break;
		case "languages": include("sources/languages.php"); break;
		case "templates": include("sources/templates.php"); break;
		case "faq": include("sources/faq.php"); break;
		case "settings": include("sources/settings.php"); break;
		case "smtp_settings": include("sources/smtp_settings.php"); break;
		case "mobile_settings": include("sources/mobile_settings.php"); break;
		case "support": include("sources/support.php"); break;
		case "posts": include("sources/posts.php"); break;
		case "logout": 
			unset($_SESSION['eex_admin_uid']);
			unset($_COOKIE['eex_admin_uid']);
			setcookie("eex_admin_uid", "", time() - (86400 * 30), '/'); // 86400 = 1 day
			session_unset();
			session_destroy();
			header("Location: $settings[url]");
		break;
		default: include("sources/dashboard.php");
	}
	include("sources/footer.php");
} else {
	include("sources/login.php");
}
mysqli_close($db);
?>