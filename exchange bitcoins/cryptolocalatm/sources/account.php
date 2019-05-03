<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

if(!checkSession()) { 
	$redirect = $settings['url']."login";
	header("Location: $redirect");
}

$b = protect($_GET['b']);

if($b == "dashboard") {
	$tpl = new Template("templates/".$settings['default_template']."/account/dashboard.tpl",$lang);
	$tpl->set("U_FirstName",idinfo($_SESSION['eex_uid'],"firstname"));
	$tpl->set("U_LastName",idinfo($_SESSION['eex_uid'],"lastname"));
	$total_exchanges = $db->query("SELECT * FROM easyex_exchanges WHERE uid='$_SESSION[eex_uid]'");
	$total_exchanges = $total_exchanges->num_rows;
	$tpl->set("U_TotalExchanges",$total_exchanges);
	$getPendingExchanges = $db->query("SELECT * FROM easyex_exchanges WHERE status='1' and uid='$_SESSION[eex_uid]' or status='2' and uid='$_SESSION[eex_uid]' ORDER BY id DESC");
	if($getPendingExchanges->num_rows>0) {
		$pending_exchanges = '';
		while($get = $getPendingExchanges->fetch_assoc()) {
			if($get['status'] == "1") {
				$rows = new Template("templates/".$settings['default_template']."/account/rows/pending_exchanges_rows_with_pay_btn.tpl");
			} else {
				$rows = new Template("templates/".$settings['default_template']."/account/rows/pending_exchanges_rows_without_pay_btn.tpl");
			}
			$rows->set("url",$settings['url']);
			$rows->set("gateway_send",gatewayinfo($get['gateway_send'],"name"));
			$rows->set("gateway_receive",gatewayinfo($get['gateway_receive'],"name"));
			$rows->set("exchange_id",$get['exchange_id']);
			$rows->set("created_on",date("d/m/Y H:i:s",$get['created']));
			$rows->set("status",getStatus($get['status'],1));
			if(gatewayinfo($get['gateway_receive'],"is_crypto") == "1") {
				$rows->set("acc_type","address");
				$rows->set("u_acc",$get['u_field_2']);
			} else { 
				$rows->set("acc_type","account");
				$rows->set("u_acc",$get['u_field_2']);
			}
			$rows->set("amount_send",$get['amount_send']);
			$rows->set("amount_receive",$get['amount_receive']);
			$rows->set("currency_send",gatewayinfo($get['gateway_send'],"currency"));
			$rows->set("currency_receive",gatewayinfo($get['gateway_receive'],"currency"));
			$pending_exchanges .= $rows->output();
		}
	} else {
		$pending_exchanges = ''; 
	}
	$tpl->set("U_Pending_Exchanges",$pending_exchanges);
	$tpl->set("url",$settings['url']);
	echo $tpl->output();
} elseif($b == "exchanges") {
	$tpl = new Template("templates/".$settings['default_template']."/account/exchanges.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$tpl->set("U_FirstName",idinfo($_SESSION['eex_uid'],"firstname"));
	$tpl->set("U_LastName",idinfo($_SESSION['eex_uid'],"lastname"));
	$total_exchanges = $db->query("SELECT * FROM easyex_exchanges WHERE uid='$_SESSION[eex_uid]'");
	$total_exchanges = $total_exchanges->num_rows;
	$tpl->set("U_TotalExchanges",$total_exchanges);
	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$limit = 10;
	$startpoint = ($page * $limit) - $limit;
	if($page == 1) {
		$i = 1;
	} else {
		$i = $page * $limit;
	}
	$statement = "easyex_exchanges WHERE uid='$_SESSION[eex_uid]'";
	$getUserExchanges = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
	if($getUserExchanges->num_rows>0) {
		$exchanges = '';
		while($get = $getUserExchanges->fetch_assoc()) {
			if($get['status'] == "1") {
				$rows = new Template("templates/".$settings['default_template']."/account/rows/pending_exchanges_rows_with_pay_btn.tpl");
			} else {
				$rows = new Template("templates/".$settings['default_template']."/account/rows/pending_exchanges_rows_without_pay_btn.tpl");
			}
			$rows->set("url",$settings['url']);
			$rows->set("gateway_send",gatewayinfo($get['gateway_send'],"name"));
			$rows->set("gateway_receive",gatewayinfo($get['gateway_receive'],"name"));
			$rows->set("exchange_id",$get['exchange_id']);
			$rows->set("created_on",date("d/m/Y H:i:s",$get['created']));
			$rows->set("status",getStatus($get['status'],1));
			if(gatewayinfo($get['gateway_receive'],"is_crypto") == "1") {
				$rows->set("acc_type","address");
				$rows->set("u_acc",$get['u_field_2']);
			} else { 
				$rows->set("acc_type","account");
				$rows->set("u_acc",$get['u_field_2']);
			}
			$rows->set("amount_send",$get['amount_send']);
			$rows->set("amount_receive",$get['amount_receive']);
			$rows->set("currency_send",gatewayinfo($get['gateway_send'],"currency"));
			$rows->set("currency_receive",gatewayinfo($get['gateway_receive'],"currency"));
			$exchanges .= $rows->output();
		}
	} else {
		$exchanges = '';
	}
	$tpl->set("U_Exchanges",$exchanges);
	$ver = $settings['url']."account/exchanges";
	if(web_pagination($statement,$ver,$limit,$page)) {
		$pages = web_pagination($statement,$ver,$limit,$page);
	} else {
		$pages = '';
	}
	$tpl->set("pages",$pages);
	echo $tpl->output();
} elseif($b == "settings") {
	if(isset($_POST['eex_close'])) {
		$tpl = new Template("templates/".$settings['default_template']."/account/close_account.tpl",$lang);
		$tpl->set("url",$settings['url']);
		$tpl->set("U_FirstName",idinfo($_SESSION['eex_uid'],"firstname"));
		$tpl->set("U_LastName",idinfo($_SESSION['eex_uid'],"lastname"));
		$total_exchanges = $db->query("SELECT * FROM easyex_exchanges WHERE uid='$_SESSION[eex_uid]'");
		$total_exchanges = $total_exchanges->num_rows;
		$tpl->set("U_TotalExchanges",$total_exchanges);
		if(isset($_POST['eex_agree'])) { 
			$delete = $db->query("DELETE FROM easyex_exchanges WHERE uid='$_SESSION[eex_uid]'");
			$delete = $db->query("DELETE FROM easyex_feedbacks WHERE uid='$_SESSION[eex_uid]'");
			$delete = $db->query("DELETE FROM easyex_users WHERE id='$_SESSION[eex_uid]'");
			$results = success($lang['success_1']);
			session_unset();
			session_unset($_SESSION['eex_uid']);
			session_destroy();
		} else {
			$results = '';
		}
		if(isset($_POST['eex_cancel'])) {
			$redirect = $settings['url']."account/dashboard";
			header("Location: $redirect");
		}
		$tpl->set("results",$results);
		echo $tpl->output();
	} else {
		$tpl = new Template("templates/".$settings['default_template']."/account/settings.tpl",$lang);
		$tpl->set("url",$settings['url']);
		$tpl->set("U_FirstName",idinfo($_SESSION['eex_uid'],"firstname"));
		$tpl->set("U_LastName",idinfo($_SESSION['eex_uid'],"lastname"));
		$total_exchanges = $db->query("SELECT * FROM easyex_exchanges WHERE uid='$_SESSION[eex_uid]'");
		$total_exchanges = $total_exchanges->num_rows;
		$tpl->set("U_TotalExchanges",$total_exchanges);
		if(isset($_POST['eex_save'])) {
			$firstname = protect($_POST['firstname']);
			$lastname = protect($_POST['lastname']);
			$email = protect($_POST['email']);
			$cpasswd = protect($_POST['cpasswd']);
			$npasswd = protect($_POST['npasswd']);
			$cnpasswd = protect($_POST['cnpasswd']);
			$check = $db->query("SELECT * FROM easyex_users WHERE email='$email'");
			if(empty($firstname) or empty($lastname) or empty($email) or empty($cpasswd)) { $results = error($lang['error_1']); }
			elseif(idinfo($_SESSION['eex_uid'],"email") !== $email && $check->num_rows>0) { $results = error($lang['error_2']); }
			elseif(idinfo($_SESSION['eex_uid'],"password") !== md5($cpasswd)) { $results = error($lang['error_3']); }
			elseif(!empty($npasswd) && strlen($npasswd)<8) { $results = error($lang['error_4']); }
			elseif(!empty($npasswd) && $npasswd !== $cnpasswd) { $results = error($lang['error_5']); }
			else {
				$update = $db->query("UPDATE easyex_users SET firstname='$firstname',lastname='$lastname',email='$email' WHERE id='$_SESSION[eex_uid]'");
				if(!empty($npasswd)) {
					$npasswd = md5($npasswd);
					$update = $db->query("UPDATE easyex_users SET password='$npasswd' WHERE id='$_SESSION[eex_uid]'");
				}
				$results = success($lang['success_2']);
			}
		} else {
			$results = '';
		}
		$tpl->set("u_firstname",idinfo($_SESSION['eex_uid'],"firstname"));
		$tpl->set("u_lastname",idinfo($_SESSION['eex_uid'],"lastname"));
		$tpl->set("u_email",idinfo($_SESSION['eex_uid'],"email"));
		$tpl->set("results",$results);
		echo $tpl->output();
	}
} elseif($b == "verification") {
	$tpl = new Template("templates/".$settings['default_template']."/account/verification.tpl",$lang);
	$tpl->set("U_FirstName",idinfo($_SESSION['eex_uid'],"firstname"));
	$tpl->set("U_LastName",idinfo($_SESSION['eex_uid'],"lastname"));
	$total_exchanges = $db->query("SELECT * FROM easyex_exchanges WHERE uid='$_SESSION[eex_uid]'");
	$total_exchanges = $total_exchanges->num_rows;
	$tpl->set("U_TotalExchanges",$total_exchanges);
	$tpl->set("url",$settings['url']);
	$results = '';
	
	if(isset($_POST['eex_send_email'])) {
		$email = idinfo($_SESSION['eex_uid'],"email");
		$hash = md5($email);
		$update = $db->query("UPDATE easyex_users SET email_hash='$hash' WHERE id='$_SESSION[eex_uid]'");
		EmailSys_EmailVerification($_SESSION['eex_uid']);
		$results = success($lang['success_3']);
	} 
	
	if(isset($_POST['eex_upload'])) { 
		$ext = array('jpg','png','jpeg','pdf'); 
		$fileext1 = end(explode('.',$_FILES['document_1']['name'])); 
		$fileext1 = strtolower($fileext1); 
		$fileext2 = end(explode('.',$_FILES['document_2']['name'])); 
		$fileext2 = strtolower($fileext2); 
		if(empty($_FILES['document_1']['name']) or empty($_FILES['document_2']['name'])) { $results = error($lang['error_6']); }
		elseif(!in_array($fileext1,$ext)) { $results = error($lang['error_7']); }
		elseif(!in_array($fileext2,$ext)) { $results = error($lang['error_7']); }
		else {
			$upload_dir = md5($settings['name'])."/";
			if(!is_dir($upload_dir)) { mkdir($upload_dir,0777); }
			$user_dir = $upload_dir."user_".$_SESSION['eex_uid'];
			if(!is_dir($user_dir)) { mkdir($user_dir,0777); }
			$document_1 = $user_dir."/".$_FILES['document_1']['name'];
			$document_2 = $user_dir."/".$_FILES['document_2']['name'];
			@move_uploaded_file($_FILES['document_1']['tmp_name'], $document_1);
			@move_uploaded_file($_FILES['document_2']['tmp_name'], $document_2);
			$update = $db->query("UPDATE easyex_users SET document_verified='0',document_1='$document_1',document_2='$document_2' WHERE id='$_SESSION[eex_uid]'");
			$results = success($lang['success_4']);
		}
	}

	if(isset($_POST['eex_send_sms_code'])) { 
		$nexmo_sms = new NexmoMessage($settings[nexmo_api_key],$settings[nexmo_api_secret]);
		// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
		$rand = rand(00000,99999);
		$number = idinfo($_SESSION['eex_uid'],"mobile_number");
		$insert = $db->query("INSERT easyex_sms_codes (uid,sms_code,verified) VALUES ('$_SESSION[eex_uid]','$rand','0')");
		$message = 'Your code for '.$settings[name].' is: '.$rand.' ';
		$info = $nexmo_sms->sendText( '+'.$number, $settings[name], $message );
		$results = success("$lang[success_5_1] +$number. $lang[success_5_2]");
	}

	if(isset($_POST['eex_verify_sms_code'])) {
		$sms_code = protect($_POST['sms_code']);
		$check_code = $db->query("SELECT * FROM easyex_sms_codes WHERE uid='$_SESSION[eex_uid]' and sms_code='$sms_code' and verified='0'");
		if(empty($sms_code)) { $results = error($lang['error_8']); }
		elseif($check_code->num_rows==0) { $results = error($lang['error_9']); }
		else {
			$update = $db->query("UPDATE easyex_sms_codes SET verified='1' WHERE uid='$_SESSION[eex_uid]' and sms_code='$sms_code'");
			$update = $db->query("UPDATE easyex_users SET mobile_verified='1' WHERE id='$_SESSION[eex_uid]'");
			$results = success($lang['success_6']);
		}
	} 

	if(isset($_POST['eex_add_number'])) {
		$mobile_number = protect($_POST['mobile_number']);
		if(empty($mobile_number)) { $results = error($lang['error_10']); }
		elseif(!is_numeric($mobile_number)) { $results = error($lang['error_11']); }
		else {
			$update = $db->query("UPDATE easyex_users SET mobile_number='$mobile_number' WHERE id='$_SESSION[eex_uid]'");
			$results = success($lang['success_7']);
		}
	}
	
	if($settings['email_verification'] == "1") {
		if(idinfo($_SESSION['eex_uid'],"email_verified") == "1") {
			$ever = new Template("templates/".$settings['default_template']."/account/verification/email_verified.tpl",$lang);
			$e_ver_tpl = $ever->output();
		} else {
			$ever = new Template("templates/".$settings['default_template']."/account/verification/email_not_verified.tpl",$lang);
			$e_ver_tpl = $ever->output();	
		}
		$tpl->set("Email_Verification",$e_ver_tpl);
	} else {
		$tpl->set("Email_Verification","");
	}
	if($settings['document_verification'] == "1") {
		if(idinfo($_SESSION['eex_uid'],"document_verified") == "1") {
			$dver = new Template("templates/".$settings['default_template']."/account/verification/document_verified.tpl",$lang);
			$d_ver_tpl = $dver->output();
		} else {
			if(idinfo($_SESSION['eex_uid'],"document_1")) {
				$dver = new Template("templates/".$settings['default_template']."/account/verification/document_pending.tpl",$lang);
				$d_ver_tpl = $dver->output();	
			} else {
				$dver = new Template("templates/".$settings['default_template']."/account/verification/document_upload_files.tpl",$lang);
				$d_ver_tpl = $dver->output();
			}
		}
		$tpl->set("Document_Verification",$d_ver_tpl);
	} else {
		$tpl->set("Document_Verification","");
	}
	if($settings['phone_verification'] == "1") {
		if(idinfo($_SESSION['eex_uid'],"mobile_verified") == "1") {
			$mver = new Template("templates/".$settings['default_template']."/account/verification/mobile_verified.tpl",$lang);
			$m_ver_tpl = $mver->output();
		} else {
			if(idinfo($_SESSION['eex_uid'],"mobile_number")) {
				$mver = new Template("templates/".$settings['default_template']."/account/verification/mobile_verify_code.tpl",$lang);
				$mver->set("mobile_number",idinfo($_SESSION['eex_uid'],"mobile_number"));
				$m_ver_tpl = $mver->output();	
			} else {
				$mver = new Template("templates/".$settings['default_template']."/account/verification/mobile_add_number.tpl",$lang);
				$m_ver_tpl = $mver->output();
			}
		}
		$tpl->set("Mobile_Verification",$m_ver_tpl);
	} else {
		$tpl->set("Mobile_Verification","");
	}
	$tpl->set("results",$results);
	echo $tpl->output();
} else {
	$redirect = $settings['url']."account/dashboard";
	header("Location:$redirect");
}
?>