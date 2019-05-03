<?php
if(!defined("EASYEX_INSTALLED")){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$smtpconf = array();
$smtpconf["host"] = "stewie.novahost.bg"; // SMTP SERVER IP/HOST
$smtpconf["user"] = "smtp@me4onkof.info";	// SMTP AUTH USERNAME if SMTPAuth is true
$smtpconf["pass"] = "123456789";	// SMTP AUTH PASSWORD if SMTPAuth is true
$smtpconf["port"] = "587";	// SMTP SERVER PORT
$smtpconf["ssl"] = "0"; // 1 -  YES, 0 - NO
$smtpconf["SMTPAuth"] = true; // true / false
?>
