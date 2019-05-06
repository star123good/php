<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$tpl = new Template("templates/".$settings['default_template']."/blog.tpl",$lang);
$tpl->set("url",$settings['url']);
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;
if($page == 1) {
		$i = 1;
} else {
		$i = $page * $limit;
}
$statement = "easyex_posts";
$getPosts = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
if($getPosts->num_rows>0) {
	$posts = '';
	while($get = $getPosts->fetch_assoc()) {
		$rows = new Template("templates/".$settings['default_template']."/blog_rows.tpl",$lang);
		$rows->set("url",$settings['url']);
		$rows->set("post_id",$get['id']);
		$rows->set("post_url",CreatePostURL($get['title']));
		$rows->set("post_title",$get['title']);
		$rows->set("post_short_content",$get['short_content']);
		$rows->set("post_date",date("d/m/Y H:i",$get['created']));
		$rows->set("post_author",$get['author']);
		$posts .= $rows->output();
	}
} else {
	$posts = '';
}
$tpl->set("blog_posts",$posts);
$ver = $settings['url']."blog";
if(web_pagination($statement,$ver,$limit,$page)) {
	$pages = web_pagination($statement,$ver,$limit,$page);
} else {
	$pages = '';
}
$tpl->set("pages",$pages);
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