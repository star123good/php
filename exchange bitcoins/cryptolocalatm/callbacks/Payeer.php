<?php
error_reporting(0);
if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
	$m_operation_id = protect($_POST['m_operation_id')];
	$m_operation_date = protect($_POST['m_operation_date']);
	$m_orderid = protect($_POST['m_orderid']);
	$m_amount = protect($_POST['m_amount']);
	$m_currency = protect($_POST['m_curr']);
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$m_orderid'");
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
			$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$m_operation_id'");
			$m_key = gatewayinfo($row['gateway_send'],"a_field_2");
			$arHash = array($_POST['m_operation_id'],
				$_POST['m_operation_ps'],
				$_POST['m_operation_date'],
				$_POST['m_operation_pay_date'],
				$_POST['m_shop'],
				$_POST['m_orderid'],
				$_POST['m_amount'],
				$_POST['m_curr'],
				$_POST['m_desc'],
				$_POST['m_status'],
				$m_key);
			$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
			if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success') {
				if($m_amount == $amount or $m_currency == $currency) {
					if($check_trans->num_rows==0) {
						$date = time();
						$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$m_operation_id','completed','Payeer','$mb_amount','$mb_currency','$date')");
						$time = time();
						$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$m_operation_id','$time')");
						$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$m_operation_id',updated='$time' WHERE id='$row[id]'");
						EmailSys_PaymentReceived($row['id']);
					}
				}
			}
	}
}
?>