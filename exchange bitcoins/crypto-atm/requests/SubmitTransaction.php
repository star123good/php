<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
$exchange_id = protect($_GET['exchange_id']);
$transaction_id = protect($_POST['transaction_id']);
if(empty($transaction_id)) {
	$data['status'] = 'error';
	$data['msg'] = $lang['error_15'];
} else {
	if(einfo($exchange_id,"status") == "1") {
		$data['status'] = 'success';
		$data['msg'] = $lang['success_8'];
		$data['content'] = '<div class="alert alert-success">
			<h2><i class="fa fa-check"></i> '.$lang[payment_success_content_1].'</h2>
			'.$lang[payment_success_content_2].'
		</div>
		<center>
		'.$lang[payment_success_content_3].': <a href="'.$settings[url].'track/'.$exchange_id.'">'.$settings[url].'track/'.$exchange_id.'</a>
		</center>';
		$time = time();
		$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$exchange_id','2','$transaction_id','$time')");
		$update = $db->query("UPDATE easyex_exchanges SET status='2',updated='$time',transaction_id='$transaction_id' WHERE exchange_id='$exchange_id'");
	} elseif(einfo($exchanage_id,"status") == "5") {
		$data['status'] = 'error';
		$data['msg'] = $lang['error_16'];
	} else {
		$data['status'] = 'error';
		$data['msg'] = $lang['error_17'];
	}
}
echo json_encode($data);
?>