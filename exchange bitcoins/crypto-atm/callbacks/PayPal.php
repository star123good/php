<?php
error_reporting(0);
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

// assign posted variables to local variables
$item_name = protect($_POST['item_name']);
$item_number = protect($_POST['item_number']);
$payment_status = protect($_POST['payment_status']);
$payment_amount = protect($_POST['mc_gross']);
$payment_currency = protect($_POST['mc_currency']);
$txn_id = protect($_POST['txn_id']);
$receiver_email = protect($_POST['receiver_email']);
$payer_email = protect($_POST['payer_email']);
$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$item_number'");
if($query->num_rows>0) {
	$row = $query->fetch_assoc();
	$date = date("d/m/Y H:i:s");
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
	$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$txn_id'");
	if (!$fp) {
		echo error("Cant connect to PayPal server.");
	} else {
		fputs ($fp, $header . $req);
		while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 1) {
			if ($payment_status == 'Completed') {
				if ($receiver_email==gatewayinfo($row['gateway_send'],"a_field_1")) {
					if($payment_amount == $amount && $payment_currency == $currency) {
						if($check_trans->num_rows==0) {
							$date = time();
							$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$txn_id','completed','PayPal','$payment_amount','$payment_currency','$date')");
							$time = time();
							$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$txn_id','$time')");
							$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$txn_id',updated='$time' WHERE id='$row[id]'");
							EmailSys_PaymentReceived($row['id']);
						}
					}
													
				} 

			}

	}

	else if (strcmp ($res, "INVALID") == 0) {
		echo 'Invalid payment.';
	}
	}
	fclose ($fp);
	}  
}
?>