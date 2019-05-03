<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['exchange_id']);
if(!checkExchange($id)) {
	header("Location: $settings[url]");
}

$tpl = new Template("templates/".$settings['default_template']."/payment_fail.tpl",$lang);
$tpl->set("url",$settings['url']);
$tpl->set("exchange_id",$id);
if(einfo($exchange_id,"status") !== "7") {
	$time = time();
	$update = $db->query("UPDATE easyex_exchanges SET status='7',updated='$time' WHERE exchange_id='$id'");
	$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,time) VALUES ('$id','6','$time')");
}
echo $tpl->output();
?>