<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function GetWebTitle() {
	global $db, $settings, $lang;
	$a = protect($_GET['a']);
	if($a == "track") {
		$id = protect($_GET['exchange_id']);
		return $lang[title_track_exchange].' #'.$id.' - '.$settings[name];	
	} elseif($a == "pay") {
		$id = protect($_GET['id']);
		return $lang[title_pay_exchange].' #'.$id.' - '.$settings[name];
	} elseif($a == "blog") {
		return $lang[title_blog].' - '.$settings[name];
	} elseif($a == "feedbacks") {
		return $lang[title_feedbacks].' - '.$settings[name];
	} elseif($a == "login") {
		return $lang[title_login].' - '.$settings[name];
	} elseif($a == "register") {
		return $lang[title_register].' - '.$settings[name];
	} elseif($a == "account") {
		return $lang[title_account].' - '.$settings[name];
	} elseif($a == "post") {	
		$id = protect($_GET['id']);
		$query = $db->query("SELECT * FROM easyex_posts WHERE id='$id'");
		if($query->num_rows>0) {
			$row = $query->fetch_assoc();
			return $row['title']." - ".$lang['title_blog']." - ".$settings['name'];
		} else {
			return $settings['title'];
		}
	} elseif($a == "leave_feedback") {
		return $lang[title_leave_feedback].' - '.$settings[name];
	} elseif($a == "page") {
		$prefix = protect($_GET['prefix']);
		if($prefix == "contacts") {
			return $lang[title_contact_us].' - '.$settings[name];
		} elseif($page == "faq") {
			return $lang[title_faq].' - '.$settings[name];
		} else {
			$query = $db->query("SELECT * FROM easyex_pages WHERE prefix='$prefix'");
			if($query->num_rows>0) {
				$row = $query->fetch_assoc();
				return $row['title']." - ".$settings['name'];
			} else {
				return $settings['title'];
			}
		}
	} else {
		return $settings['title']; 
	}
}
?>