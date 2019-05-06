<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
$data = array();
$gateway_send = protect($_POST['eex_gateway_send']);
$gateway_receive = protect($_POST['eex_gateway_receive']);
$amount_send = protect($_POST['eex_amount_send']);
$amount_receive = protect($_POST['eex_amount_receive']);
$rate_from = protect($_POST['eex_rate_from']);
$rate_to = protect($_POST['eex_rate_to']);
$exchange_id = randomHash(20);
$exchange_id = strtoupper($exchange_id);
$u_field_1 = protect($_POST['u_field_1']);
$u_field_2 = protect($_POST['u_field_2']);
$u_field_3 = protect($_POST['u_field_3']);
$u_field_4 = protect($_POST['u_field_4']);
$u_field_5 = protect($_POST['u_field_5']);
$u_field_6 = protect($_POST['u_field_6']);
$u_field_7 = protect($_POST['u_field_7']);
$u_field_8 = protect($_POST['u_field_8']);
$u_field_9 = protect($_POST['u_field_9']);
$u_field_10 = protect($_POST['u_field_10']);
if(checkSession()) { $uid = $_SESSION['eex_uid']; } else { $uid = 0; }
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();
if(gatewayinfo($gateway_send,"require_login") == "1" && !checkSession()) {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_18].' '.gatewayinfo($gateway_send,"name").' '.gatewayinfo($gateway_send,"currency").' '.$lang[error_18_1];
} elseif(gatewayinfo($gateway_send,"require_email_verify") == "1" && idinfo($_SESSION['eex_uid'],"email_verified") == "0") {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_18].' '.gatewayinfo($gateway_send,"name").' '.gatewayinfo($gateway_send,"currency").' '.$lang[error_18_2];
}  elseif(gatewayinfo($gateway_send,"require_document_verify") == "1" && idinfo($_SESSION['eex_uid'],"document_verified") == "0") {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_18].' '.gatewayinfo($gateway_send,"name").' '.gatewayinfo($gateway_send,"currency").' '.$lang[error_18_3];
}  elseif(gatewayinfo($gateway_send,"require_mobile_verify") == "1" && idinfo($_SESSION['eex_uid'],"mobile_verified") == "0") {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_18].' '.gatewayinfo($gateway_send,"name").' '.gatewayinfo($gateway_send,"currency").' '.$lang[error_18_4];
} elseif(empty($gateway_send) or empty($gateway_receive) or empty($amount_send) or empty($amount_receive) or empty($u_field_1) or empty($u_field_2)) {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_19];
} elseif($amount_send < gatewayinfo($gateway_send,"min_amount")) { 
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_20].' '.gatewayinfo($gateway_send,"min_amount").' '.gatewayinfo($gateway_send,"currency").'.';
} elseif($amount_send > gatewayinfo($gateway_send,"max_amount")) {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_21].' '.gatewayinfo($gateway_send,"max_amount").' '.gatewayinfo($gateway_send,"currency").'.';
} elseif($amount_receive > gatewayinfo($gateway_receive,"reserve")) {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_22];
} elseif(!isValidEmail($u_field_1)) {
	$data['status'] = 'error';
	$data['msg'] = '<i class="fa fa-times"></i> '.$lang[error_23];
} else {
	$insert = $db->query("INSERT easyex_exchanges (uid,gateway_send,gateway_receive,amount_send,amount_receive,rate_from,rate_to,status,created,updated,expired,u_field_1,u_field_2,u_field_3,u_field_4,u_field_5,u_field_6,u_field_7,u_field_8,u_field_9,u_field_10,ip,exchange_id) VALUES ('$uid','$gateway_send','$gateway_receive','$amount_send','$amount_receive','$rate_from','$rate_to','1','$time','0','0','$u_field_1','$u_field_2','$u_field_3','$u_field_4','$u_field_5','$u_field_6','$u_field_7','$u_field_8','$u_field_9','$u_field_10','$ip','$exchange_id')");
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE exchange_id='$exchange_id'");
	$row = $query->fetch_assoc();
	$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,time) VALUES ('$exchange_id','1','$time')");
	EmailSys_NewExchangeOrder($row['id']);
	$data['status'] = urlencode('success');
	$data['msg'] = '<i class="fa fa-check"></i> '.$lang[success_9_1].' #'.$exchange_id.' '.$lang[success_9_2];
	$redirect = '<meta http-equiv="refresh" content="3;URL='.$settings[url].'pay/'.$exchange_id.'" />    ';
	$data['redirecting'] = '<i class="fa fa-spin fa-spinner"></i> '.$lang[info_3].' '.$redirect;
	$data['target_url'] = $settings[url].'pay/'.$exchange_id;
}
echo json_encode($data);
?>