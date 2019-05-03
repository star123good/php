<?php
error_reporting(0);
$receivedSecurityCode = protect($_POST['ap_securitycode']);
$receivedMerchantEmailAddress = protect($_POST['ap_merchant']);	
$transactionStatus = protect($_POST['ap_status']);
$testModeStatus = protect($_POST['ap_test']);	 
$purchaseType = protect($_POST['ap_purchasetype']);
$totalAmountReceived = protect($_POST['ap_totalamount']);
$feeAmount = protect($_POST['ap_feeamount']);
$netAmount = protect($_POST['ap_netamount']);
$transactionReferenceNumber = protect($_POST['ap_referencenumber']);
$currency = protect($_POST['ap_currency']); 	
$transactionDate= protect($_POST['ap_transactiondate']);
$transactionType= protect($_POST['ap_transactiontype']);
								
//Setting the customer's information from the IPN post variables
$customerFirstName = protect($_POST['ap_custfirstname']);
$customerLastName = protect($_POST['ap_custlastname']);
$customerAddress = protect($_POST['ap_custaddress')];
$customerCity = protect($_POST['ap_custcity']);
$customerState = protect($_POST['ap_custstate']);
$customerCountry = protect($_POST['ap_custcountry']);
$customerZipCode = protect($_POST['ap_custzip']);
$customerEmailAddress = protect($_POST['ap_custemailaddress']);
								
//Setting information about the purchased item from the IPN post variables
$myItemName = protect($_POST['ap_itemname']);
$myItemCode = protect($_POST['ap_itemcode']);
$myItemDescription = protect($_POST['ap_description']);
$myItemQuantity = protect($_POST['ap_quantity']);
$myItemAmount = protect($_POST['ap_amount']);
								
$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$myItemCode'");
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
		$check_trans = $db->query("SELECT * FROM easyex_transactions WHERE transaction_id='$transactionReferenceNumber'");
		//Setting extra information about the purchased item from the IPN post variables
		$additionalCharges = $_POST['ap_additionalcharges'];
		$shippingCharges = $_POST['ap_shippingcharges'];
		$taxAmount = $_POST['ap_taxamount'];
		$discountAmount = $_POST['ap_discountamount'];
								 
		//Setting your customs fields received from the IPN post variables
		$myCustomField_1 = $_POST['apc_1'];
		$myCustomField_2 = $_POST['apc_2'];
		$myCustomField_3 = $_POST['apc_3'];
		$myCustomField_4 = $_POST['apc_4'];
		$myCustomField_5 = $_POST['apc_5'];
		$myCustomField_6 = $_POST['apc_6'];
									
		if ($receivedMerchantEmailAddress == gatewayinfo($row['gateway_send'],"a_field_1")) {
			//Check if the security code matches
			if ($receivedSecurityCode ==  gatewayinfo($row['gateway_send'],"a_field_2")) {
				if ($transactionStatus == "Success") {
					if ($testModeStatus == "1") {
						// Since Test Mode is ON, no transaction reference number will be returned.
						// Your site is currently being integrated with Payza IPN for TESTING PURPOSES
						// ONLY. Don't store any information in your production database and 
						// DO NOT process this transaction as a real order.
					} else {
						if($check_trans->num_rows==0) {
							$date = time();
							$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$transactionReferenceNumber','completed','Payza','$myItemAmount','$mb_currency','$date')");
							$time = time();
							$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$transactionReferenceNumber','$time')");
							$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$transactionReferenceNumber',updated='$time' WHERE id='$row[id]'");
							EmailSys_PaymentReceived($row['id']);
							$redirect = $settings['url']."payment/".$row['id']."/".$row['exchange_id']."/success";
							header("Location: $redirect");
						}
					}			
				} 
			}
		}
	}
?>