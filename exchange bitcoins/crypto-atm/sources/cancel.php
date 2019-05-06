<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['id']);
if(!checkExchange($id)) {
	header("Location: $settings[url]");
}

if(einfo($id,"ip") == $_SERVER['REMOTE_ADDR']) {
	$tpl = new Template("templates/".$settings['default_template']."/cancel.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$tpl->set("exchange_id",$id);
	if(einfo($id,"status") == "6") {
		$tpl->set("class","danger");
		$tpl->set("title",$lang['cancelpage_title_1']);
		$tpl->set("content",$lang['cancelpage_content_1']);
	} else {
		$tpl->set("class","success");
		$tpl->set("title",$lang['cancelpage_title_2']);
		$tpl->set("content",$lang['cancelpage_content_2']);
		$time = time();
		$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$id','8','','$time')");
		$update = $db->query("UPDATE easyex_exchanges SET status='6',updated='$time' WHERE exchange_id='$id'");
	}
	echo $tpl->output();
} else {
	header("Location: $settings[url]");
}
?>