<?php
error_reporting(0);
$ac_src_wallet = protect($_GET['ac_src_wallet']);
$ac_dest_wallet = protect($_GET['ac_dest_wallet']);
$ac_amount = protect($_GET['ac_amount']);
$ac_merchant_currency = protect($_GET['ac_merchant_currency']);
$ac_transfer = protect($_GET['ac_transfer']);
$ac_start_date = protect($_GET['ac_start_date']);
$ac_order_id = protect($_GET['ac_order_id']);
$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$ac_order_id'");
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
	$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$ac_transfer'");
	if($ac_dest_wallet == gatewayinfo($row['gateway_send'],"a_field_1")) {
		if($ac_amount == $amount or $ac_merchant_currency == $currency) {
			if($check_trans->num_rows==0) {
				$date = time();
				$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$ac_transfer','completed','AdvCash','$ac_amount','$ac_merchant_currency','$date')");
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$ac_transfer','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$ac_transfer',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
			}
		}
	}
}
?>