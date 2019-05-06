<?php
error_reporting(0);
include("../includes/entromoney.php");
$accountQuery = $db->query("SELECT * FROM easyex_gateways WHERE name='Entromoney'");
$acc = $accountQuery->fetch_assoc();
$config = array();
$config['sci_user'] = $acc['a_field_1'];
$config['sci_id'] 	= $acc['a_field_2'];
$config['sci_pass'] = $acc['a_field_3'];
$config['receiver'] = $acc['a_field_4'];
try {
	$sci = new Paygate_Sci($config);
}
catch (Paygate_Exception $e) {
	exit($e->getMessage());
}

$input = array();
$input['hash'] = $_POST['hash'];

// Decode hash
$error = '';
$tran = $sci->query($input, $error);
foreach($tran as $v => $k) {
	$trans[$v] = $k;
}
$date = date("d/m/Y H:i:s");
$status = $trans['status'];
$payment_id = $trans['payment_id'];
$receiver = $trans['account_purse'];
$sender = $trans['purse'];
$eamount = $trans['amount'];
$batch = $trans['batch'];
$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$trans[payment_id]'");
if($query->num_rows>0) {
	$row = $query->fetch_assoc();
	if(gatewayinfo($row[gateway_send],"include_fee") == "1") {
		if (strpos(gatewayinfo($row[gateway_send],"extra_fee"),'%') !== false) { 
			$amount = $row['amount_send'];
			$explode = explode("%",gatewayinfo($row[gateway_send],"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
			$fee_text = gatewayinfo($row[gateway_send],"fee");
		} else {
			$amount = $row['amount_send'] + gatewayinfo($row[gateway_send],"extra_fee");
			$fee_text = gatewayinfo($row[gateway_send],"extra_fee")." ".gatewayinfo($row[gateway_send],"currency");
		}
		$currency = gatewayinfo($row[gateway_send],"currency");
	} else {
		$amount = $row['amount_send'];
		$currency = gatewayinfo($row[gateway_send],"currency");
		$fee_text = '0';
	}
	if(checkSession()) { $uid = $_SESSION['eex_uid']; } else { $uid = 0; }
	$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$batch'");
	if($error) {
		echo $error;
	} else {
		if($status == "completed") {
			if($check_trans->num_rows==0) {
				$date = time();
				$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$batch','completed','Skrill','$eamount','$mb_currency','$date')");
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$batch','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$batch',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
			}
		}
	}
}
?>