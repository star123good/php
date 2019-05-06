<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

if(checkSession()) { 
	$redirect = $settings['url']."account/dashboard";
	header("Location: $redirect");
}

$tpl = new Template("templates/".$settings['default_template']."/register.tpl",$lang);
$tpl->set("url",$settings['url']);
if(isset($_POST['eex_register'])) {
	$firstname = protect($_POST['firstname']);
	$lastname = protect($_POST['lastname']);
	$username = protect($_POST['username']);
	$email = protect($_POST['email']);
	$password = protect($_POST['password']);
	$cpassword = protect($_POST['cpassword']);
	if(isset($_POST['tos_accept'])) { $tos_accept = 1; } else { $tos_accept = 0; }
	$check = $db->query("SELECT * FROM easyex_users WHERE email='$email'");
	$check_u = $db->query("SELECT * FROM easyex_users WHERE username='$username'");
	if(empty($firstname) or empty($lastname) or empty($username) or empty($email) or empty($password) or empty($cpassword)) { $results = error($lang['error_1']); }
	elseif(!isValidUsername($username)) { $results = error($lang['error_32']); }
	elseif($check_u->num_rows>0) { $results = error($lang['error_33']); }
	elseif(!isValidEmail($email)) { $results = error($lang['error_23']); }
	elseif($check->num_rows>0) { $results = error($lang['error_34']); }
	elseif(strlen($password)<8) { $results = error($lang['error_35']); }
	elseif($password !== $cpassword) { $results = error($lang['error_36']); }
	elseif($tos_accept == "0") { $results = error($lang['error_37']); }
	else {
		$time = time();
		$ip = $_SERVER['REMOTE_ADDR'];
		$passwd = md5($password);
		$insert = $db->query("INSERT easyex_users (username,email,password,firstname,lastname,status,ip,signup_time) VALUES ('$username','$email','$passwd','$firstname','$lastname','1','$ip','$time')");
		$results = success($lang['success_15']);
	}
} else {
	$results = '';
}
$tpl->set("results",$results);
echo $tpl->output();
?>