<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$header = new Template("templates/".$settings['default_template']."/header.tpl",$lang);
$header->set("url",$settings['url']);
$header->set("title",GetWebTitle());
$header->set("description",$settings['description']);
$header->set("keywords",$settings['keywords']);
if(checkSession()) { 
	$userMenuTPL = new Template("templates/".$settings['default_template']."/header_menu/userLogged.tpl",$lang);
	$userMenuTPL->set("url",$settings['url']);
	$userMenuTPL->set("username",idinfo($_SESSION['eex_uid'],"email"));
	$userMenu = $userMenuTPL->output();
} else {
	$userMenuTPL = new Template("templates/".$settings['default_template']."/header_menu/userNotLogged.tpl",$lang);
	$userMenuTPL->set("url",$settings['url']);
	$userMenu = $userMenuTPL->output();
}
$header->set("userMenu",$userMenu);
echo $header->output();
?>