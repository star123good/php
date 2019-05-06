<?php
error_reporting(0);
$orderid = protect($_POST['PAYMENT_ID']);
$eamount = protect($_POST['PAYMENT_AMOUNT']);
$ecurrency = protect($_POST['PAYMENT_UNITS']);
$buyer = protect($_POST['PAYEE_ACCOUNT']);
$trans_id = protect($_POST['PAYMENT_BATCH_NUM']);
$date = date("d/m/Y H:i:s");
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
	$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$trans_id'");
	$passpharce = gatewayinfo($row['gateway_send'],"a_field_2");
	$alternate = strtoupper(md5($passpharce));
	$string=
		$_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
		$_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
		$_POST['PAYMENT_BATCH_NUM'].':'.
		$_POST['PAYER_ACCOUNT'].':'.$alternate.':'.
		$_POST['TIMESTAMPGMT'];
	$hash=strtoupper(md5($string));
	if($hash==$hash){ // proccessing payment if only hash is valid

		/* In section below you must implement comparing of data you recieved
		with data you sent. This means to check if $_POST['PAYMENT_AMOUNT'] is
		particular amount you billed to client and so on. */

		if($_POST['PAYMENT_AMOUNT']==$amount && $_POST['PAYEE_ACCOUNT']==gatewayinfo($row['gateway_send'],"a_field_1") && $_POST['PAYMENT_UNITS']==$currency){
			if($check_trans->num_rows==0) {
				$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$trans_id','completed','Perfect Money','$eamount','$ecurrency','$date')");
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$trans_id','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$trans_id',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
			}
		}							 
	}
}
?>