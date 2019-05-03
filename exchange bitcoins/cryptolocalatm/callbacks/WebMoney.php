<?php
error_reporting(0);
require_once '../includes/webmoney.inc.php';
$wm_prerequest = new WM_Prerequest();
if ($wm_prerequest->GetForm() == WM_RES_OK) {
	$orderid = $wm_prerequest->payment_no;
	$merchant = $wm_prerequest->payee_purse;
	$send_amount = $wm_prerequest->payment_amount;
	$trans_id = $wm_prerequest->sys_trans_no;
	$date = $wm_prerequest->sys_trans_date;
	$payer = $wm_prerequest->payer_wm;
	$query = $db->query("SELECT * FROM easyx_exchanges WHERE id='$orderid'");
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
		if (
			$wm_prerequest->payment_no == $row['id'] &&
			$wm_prerequest->payee_purse == gatewayinfo($row['gateway_send'],"a_field_1") &&
			$wm_prerequest->payment_amount == $amount
		)
		{
			if($check_trans->num_rows==0) {
				$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$trans_id','completed','WebMoney','$send_amount','','$date')");
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$trans_id','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$trans_id',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
			}
		}
	}
}
header("Location: $settings[url]");			
?>