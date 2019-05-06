<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['exchange_id']);
if(!checkExchange($id)) {
	header("Location: $settings[url]");
}

$visitorIP = $_SERVER['REMOTE_ADDR'];

if(einfo($id,"status") == "4") {
	$allow_feedback = false;
	if($visitorIP == einfo($id,"ip")) {
		$allow_feedback = true;
	} elseif(checkSession() && $_SESSION['eex_uid'] == einfo($id,"uid")) {
		$allow_feedback = true;
	} else {
		$allow_feedback = false;
	}
	
	if($allow_feedback == true) {
		$eid = einfo($id,"id");
		$CheckForFeedback = $db->query("SELECT * FROM easyex_feedbacks WHERE exchange_id='$eid'");
		if($CheckForFeedback->num_rows>0) {
			$tpl = new Template("templates/".$settings['default_template']."/error.tpl",$lang);
			$tpl->set("url",$settings['url']);
			$tpl->set("error_head",$lang['leave_fb_title_1']);
			$tpl->set("error_content","$lang[leave_fb_content_1] #$id.");
			echo $tpl->output();
		} else {
			$tpl = new Template("templates/".$settings['default_template']."/leave_feedback.tpl",$lang);
			$tpl->set("url",$settings['url']);
			$tpl->set("exchange_id",$id);
			if(isset($_POST['eex_leave_fb'])) {
				$first_name = protect($_POST['first_name']);
				$last_name = protect($_POST['last_name']);
				$uid = $_SESSION['eex_uid'];
				$email = protect($_POST['email']);
				$feedback = protect($_POST['feedback']);
				$time = time();
				$exchange_id = einfo($id,"id");
				$exchange_from = gatewayinfo(einfo($id,"gateway_send"),"name");
				$exchange_to = gatewayinfo(einfo($id,"gateway_receive"),"name");
				if(empty($first_name) or empty($last_name) or empty($email) or empty($feedback)) { $results = error($lang['error_1']); }
				elseif(!isValidEmail($email)) { $results = error($lang['error_23']); }
				else {
					$insert = $db->query("INSERT easyex_feedbacks (uid,first_name,last_name,email,exchange_id,exchange_from,exchange_to,status,time,content,ip) VALUES ('$uid','$first_name','$last_name','$email','$exchange_id','$exchange_from','$exchange_to','0','$time','$feedback','$visitorIP')");
					$results = success($lang['success_13']);
				}	
			} else {
				$results = '';
			}
			if(checkSession()) {
				$u_first_name = idinfo($_SESSION['eex_uid'],"firstname");
				$u_last_name = idinfo($_SESSION['eex_uid'],"lastname");
				$u_email = idinfo($_SESSION['eex_uid'],"email");
			} else {
				$u_first_name = '';
				$u_last_name = '';
				$u_email = '';
			}
			$tpl->set("u_first_name",$u_first_name);
			$tpl->set("u_last_name",$u_last_name);
			$tpl->set("u_email",$u_email);
			$tpl->set("results",$results);
			echo $tpl->output();
		}
	} else {
		$tpl = new Template("templates/".$settings['default_template']."/error.tpl",$lang);
		$tpl->set("url",$settings['url']);
		$tpl->set("error_head",$lang['leave_fb_title_2']);
		$tpl->set("error_content",$lang['leave_fb_content_2']);
		echo $tpl->output();
	}
} else {
	$tpl = new Template("templates/".$settings['default_template']."/error.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$tpl->set("error_head",$lang['leave_fb_title_3']);
	$tpl->set("error_content",$lang['leave_fb_content_3']);
	echo $tpl->output();
}

?>