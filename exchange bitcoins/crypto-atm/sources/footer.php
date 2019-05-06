<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$footer = new Template("templates/".$settings['default_template']."/footer.tpl",$lang);
$footer->set("site_name",$settings['name']);
$footer->set("url",$settings['url']);
$getLastPost = $db->query("SELECT * FROM easyex_posts ORDER BY id DESC LIMIT 1");
if($getLastPost->num_rows>0) {
	$get = $getLastPost->fetch_assoc();
	$post = '<li><a href="'.$settings[url].'post/'.$get[id].'/'.CreatePostURL($get[title]).'">'.$get[title].'</a><br/><small><span class="text-muted">'.date("d/m/Y H:i",$get[created]).'</span></small></li>';
} else {
	$post = '';
}
$footer->set("languages",getLanguage($settings['url'],null,1));
$footer->set("latest_news",$post);
echo $footer->output();
?>