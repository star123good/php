<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

if(checkSession()) { 
	$redirect = $settings['url']."account/dashboard";
	header("Location: $redirect");
}

$b = protect($_GET['b']);
if($b == "reset") {
	$tpl = new Template("templates/".$settings['default_template']."/password/reset.tpl",$lang);
	$tpl->set("url",$settings['url']);
	if(isset($_POST['eex_reset'])) {
		$email = protect($_POST['email']);
		$check = $db->query("SELECT * FROM easyex_users WHERE email='$email'");
		if(empty($email)) { $results = error($lang['error_24']); }
		elseif($check->num_rows==0) { $results = error($lang['error_25']); }
		else {
			$row = $check->fetch_assoc();
			$randomHash = randomHash(13);
			$email = $row['email'];
			$mreceiver = $email;
			$update = $db->query("UPDATE easyex_users SET password_recovery='$randomHash' WHERE id='$row[id]'");
			EmailSys_PasswordReset($row['id']);
			$results = success($lang['success_10']);
		}
	} else {
		$results = info($lang['info_4']);
	}
	$tpl->set("results",$results);
	echo $tpl->output();
} elseif($b == "change") {
	$tpl = new Template("templates/".$settings['default_template']."/password/change.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$hash = protect($_GET['hash']);
	$query = $db->query("SELECT * FROM easyex_users WHERE password_recovery='$hash'");
	if($query->num_rows==0) { header("Location: $settings[url]"); }
	$row = $query->fetch_assoc();
	$tpl->set("email",$row['email']);
	if(isset($_POST['eex_change'])) {
		$password = protect($_POST['password']);
		$repassword = protect($_POST['repassword']);
		if(empty($password)) { $results = error($lang['error_26']); }
		elseif($password !== $repassword) { $results = error($lang['error_27']); }
		else {
			$pass = md5($password);
			$update = $db->query("UPDATE easyex_users SET password='$pass',password_recovery='' WHERE id='$row[id]'");
			$results = success($lang['success_11']);
		}
	} else {
		$results = '';
	}
	$tpl->set("results",$results);
	echo $tpl->output();
} else {

}
?>