<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

include("sql.settings.php");
include("smtp.settings.php");

$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	exit;
}
$db->set_charset("utf8");

$settingsQuery = $db->query("SELECT * FROM easyex_settings ORDER BY id DESC LIMIT 1");
$settings = $settingsQuery->fetch_assoc();
?>