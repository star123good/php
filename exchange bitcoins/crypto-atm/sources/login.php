<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

if(checkSession()) { 
	$redirect = $settings['url']."account/dashboard";
	header("Location: $redirect");
}

$tpl = new Template("templates/".$settings['default_template']."/login.tpl",$lang);
$tpl->set("url",$settings['url']);
if(isset($_POST['eex_login'])) {
	$email = protect($_POST['email']);
	$password = protect($_POST['password']);
	$passwd = md5($password);
	$check = $db->query("SELECT * FROM easyex_users WHERE email='$email' and password='$passwd'");
	if(empty($email) or empty($password)) { $results = error($lang['error_28']); }
	elseif($check->num_rows==0) { $results = error($lang['error_29']); }
	else {
		$row = $check->fetch_assoc();
		if($row['status'] == "2") {
			$results = error($lang['error_30']);
		} else {
			if($_POST['remember'] == "yes") {
				setcookie("easyexchanger_eex_uid", $row['id'], time() + (86400 * 30), '/'); // 86400 = 1 day
			}
			$_SESSION['eex_uid'] = $row['id'];
			$redirect = $settings['url']."account/dashboard";
			header("Location: $redirect");
		}
	}
} else {
	$results = '';
}
$tpl->set("results",$results);
echo $tpl->output();
?>