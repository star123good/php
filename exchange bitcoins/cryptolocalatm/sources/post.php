<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['id']);
$getPostInfo = $db->query("SELECT * FROM easyex_posts WHERE id='$id'");
if($getPostInfo->num_rows==0) {
	$redirect = $settings['url']."blog";
	header("Location: $redirect");
}
$get = $getPostInfo->fetch_assoc();
$update = $db->query("UPDATE easyex_posts SET views=views+1 WHERE id='$id'");
$tpl = new Template("templates/".$settings['default_template']."/blog_post.tpl",$lang);
$tpl->set("url",$settings['url']);
$tpl->set("post_id",$get['id']);
$tpl->set("post_url",CreatePostURL($get['title']));
$tpl->set("post_title",$get['title']);
$tpl->set("post_content",$get['content']);
$tpl->set("post_date",date("d/m/Y H:i",$get['created']));
$tpl->set("post_author",$get['author']);
$getMostPopular = $db->query("SELECT * FROM easyex_posts ORDER BY views DESC LIMIT 7");
if($getMostPopular->num_rows>0) {
	$popular = '';
	while($get = $getMostPopular->fetch_assoc()) {
		$rows = new Template("templates/".$settings['default_template']."/blog_popular_rows.tpl",$lang);
		$rows->set("url",$settings['url']);
		$rows->set("post_id",$get['id']);
		$rows->set("post_url",CreatePostURL($get['title']));
		$rows->set("post_title",$get['title']);
		$rows->set("post_short_content",$get['short_content']);
		$rows->set("post_date",date("d/m/Y H:i",$get['created']));
		$rows->set("post_author",$get['author']);
		$popular .= $rows->output();
	}
} else {
	$popular = '';
}
$tpl->set("most_popular",$popular);
echo $tpl->output();
?>