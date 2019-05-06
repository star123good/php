<?php
error_reporting(0);
$tr_id = protect($_POST['tr_id']);
$eamount = protect($_POST['amount']);
$ecurrency = protect($_POST['currency']);
$orderid = protect($_POST['user1']);
$merchant = protect($_POST['merchantAccount']);
$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$orderid'");
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
			$fee_text = gatewayinfo($row[gateway_send],"extra_fee");
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
	$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$tr_id'");
	$sci_pwd = gatewayinfo($row[gateway_send],"u_field_3");
	$sci_pwd = md5($sci_pwd.'s+E_a*');  //encryption for db
	$hash_received = MD5($_POST['tr_id'].":".MD5($sci_pwd).":".$_POST['amount'].":".$_POST['merchantAccount'].":".$_POST['payerAccount']);

	if ($hash_received == $_POST['hash']) {
		if($merchant == gatewayinfo($row['gateway_send'],"u_field_1")) {
			if($check_trans->num_rows==0) {
				$date = time();
				$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$tr_id','completed','SolidTrust Pay','$eamount','$ecurrency','$date')");
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$tr_id','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$tr_id',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
				$redirect = $settings['url']."payment/".$row['id']."/".$row['exchange_id']."/success";
				header("Location: $redirect");
			}
		}
	}
}
header("Location: $settings[url]");			
?>