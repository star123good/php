<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['exchange_id']);
if(!checkExchange($id)) {
	header("Location: $settings[url]");
}

$tpl = new Template("templates/".$settings['default_template']."/payment_success.tpl",$lang);
$tpl->set("url",$settings['url']);
$tpl->set("exchange_id",$id);
echo $tpl->output();
?>