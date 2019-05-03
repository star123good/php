<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$tpl = new Template("templates/".$settings['default_template']."/feedbacks.tpl",$lang);
$tpl->set("url",$settings['url']);
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 9;
$startpoint = ($page * $limit) - $limit;
if($page == 1) {
		$i = 1;
} else {
		$i = $page * $limit;
}
$statement = "easyex_feedbacks WHERE status='1'";
$getFeedbacks = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
if($getFeedbacks->num_rows>0) {
	$feedbacks = '';
	while($get = $getFeedbacks->fetch_assoc()) {
		$rows = new Template("templates/".$settings['default_template']."/feedback_row.tpl",$lang);
		$rows->set("id",$get['id']);
		$rows->set("fname",$get['first_name']);
		$rows->set("lname",$get['last_name']);
		$rows->set("efrom",$get['exchange_from']);
		$rows->set("eto",$get['exchange_to']);
		$rows->set("feedback",$get['content']);
		$feedbacks .= $rows->output();
	}
} else {
	$feedbacks = '';
}
$tpl->set("feedbacks_rows",$feedbacks);
$ver = $settings['url']."feedbacks";
if(web_pagination($statement,$ver,$limit,$page)) {
	$pages = web_pagination($statement,$ver,$limit,$page);
} else {
	$pages = '';
}
$tpl->set("pages",$pages);
echo $tpl->output();
?>