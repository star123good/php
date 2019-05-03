<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function protect($string) {
	$protection = htmlspecialchars(trim($string), ENT_QUOTES);
	return $protection;
}


function randomHash($lenght = 7) {
	$random = substr(md5(rand()),0,$lenght);
	return $random;
}

function checkAdminSession() {
	if(isset($_SESSION['eex_admin_uid'])) {
		return true;
	} else {
		return false;
	}
}

function checkOperatorSession() {
	if(isset($_SESSION['eex_operator_uid'])) {
		return true;
	} else {
		return false;
	}
}

function formatBytes($bytes, $precision = 2) { 
    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)."GB";
    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)."MB";
    else if ($bytes > 1024) return round($bytes / 1024, $precision)."KB";
    else return ($bytes)."B";
} 

function checkSession() {
	if(isset($_SESSION['eex_uid'])) {
		return true;
	} else {
		return false;
	}
}

function idinfo($uid,$value) {
	global $db;
	$query = $db->query("SELECT * FROM easyex_users WHERE id='$uid'");
	$row = $query->fetch_assoc();
	return $row[$value];
}	

function check_user_verify_status() {
	global $db,$settings;
	$email_verified = idinfo($_SESSION['eex_uid'],"email_verified");
	$mobile_verified = idinfo($_SESSION['eex_uid'],"mobile_verified");
	$document_verified = idinfo($_SESSION['eex_uid'],"document_verified");
	$ustatus = idinfo($_SESSION['eex_uid'],"status");
	if($ustatus !== "666" && $ustatus !== "777") { 
		if($settings['document_verification'] == "1" && $settings['email_verification'] == "1" && $settings['phone_verification'] == "1") {
			if($document_verified == "1" && $email_verified == "1" && $mobile_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "1" && $settings['email_verification'] == "1" && $settings['phone_verification'] == "0") {
			if($document_verified == "1" && $email_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "1" && $settings['email_verification'] == "0" && $settings['phone_verification'] == "1") {
			if($document_verified == "1" && $mobile_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "0" && $settings['email_verification'] == "1" && $settings['phone_verification'] == "1") {
			if($email_verified == "1" && $mobile_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "1" && $settings['email_verification'] == "1" && $settings['phone_verification'] == "0") {
			if($document_verified == "1" && $email_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "1" && $settings['email_verification'] == "0" && $settings['phone_verification'] == "0") {
			if($document_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "0" && $settings['email_verification'] == "1" && $settings['phone_verification'] == "0") {
			if($email_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "0" && $settings['email_verification'] == "0" && $settings['phone_verification'] == "1") {
			if($mobile_verified == "1") {
				$update = $db->query("UPDATE easyex_users SET status='3' WHERE id='$_SESSION[eex_uid]'");
			}
		} elseif($settings['document_verification'] == "0" && $settings['email_verification'] == "0" && $settings['phone_verification'] == "0") {
			$status = '9';
		} else {
			$status = '0';
		}
	}
}
?>