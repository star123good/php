<?php
error_reporting(0);
$transaction_id = protect($_POST['transaction_id']);
$merchant_id = protect($_POST['pay_to_email']);
$item_number = protect($_POST['detail1_text']);
$item_name = protect($_POST['detail1_description']);
$mb_amount = protect($_POST['mb_amount']);
$mb_currency = protect($_POST['mb_currency']);
$date = date("d/m/Y H:i:s");
$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$item_number'");
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
	$a_field_1 = gatewayinfo($row['gateway_send'],"a_field_1");
	$a_field_2 = gatewayinfo($row['gateway_send'],"a_field_2");
	$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$transaction_id'");
	$concatFields = $_POST['merchant_id']
		.$_POST['transaction_id']
		.strtoupper(md5($a_field_2))
		.$_POST['mb_amount']
		.$_POST['mb_currency']
		.$_POST['status'];

	$MBEmail = $a_field_1;

	// Ensure the signature is valid, the status code == 2,
	// and that the money is going to you
	if (strtoupper(md5($concatFields)) == $_POST['md5sig']
		&& $_POST['status'] == 2
		&& $_POST['pay_to_email'] == $MBEmail)
	{
		// payment successfully...
		if($mb_amount == $amount && $mb_currency == $currency) {
			if($check_trans->num_rows==0) {
				$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$transaction_id','completed','Skrill','$mb_amount','$mb_currency','$date')");
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$transaction_id','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$transaction_id',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
				$redirect = $settings['url']."payment/".$row['id']."/".$row['exchange_id']."/success";
				header("Location: $redirect");
			}
		}
	}
}			
header("Location: $settings[url]");			
?>