<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}


$tpl = new Template("templates/".$settings['default_template']."/email_verify.tpl",$lang);
$tpl->set("url",$settings['url']);
$hash = protect($_GET['hash']);
$query = $db->query("SELECT * FROM easyex_users WHERE email_hash='$hash'");
if($query->num_rows>0) {
	$row = $query->fetch_assoc();
	$update = $db->query("UPDATE easyex_users SET email_verified='1',email_hash='' WHERE id='$row[id]'");
	if(checkSession()) {
		$redirect = $settings['url']."account/verification";
		header("Location: $redirect");
	}
} else {
	header("Location: $settings[url]");
}	
echo $tpl->output();
?>