<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function getPaymentForm($exchange_id) {
	global $db, $settings;
	$gateway = gatewayinfo(einfo($exchange_id,"gateway_send"),"name");
	if($gateway == "PayPal") { return PF_PayPal($exchange_id); }
	elseif($gateway == "AdvCash") { return PF_AdvCash($exchange_id); }
	elseif($gateway == "Entromoney") { return PF_Entromoney($exchange_id); }
	elseif($gateway == "Mollie") { return PF_Mollie($exchange_id); }
	elseif($gateway == "Payeer") { return PF_Payeer($exchange_id); }
	elseif($gateway == "Payza") { return PF_Payza($exchange_id); }
	elseif($gateway == "Perfect Money") { return PF_PerfectMoney($exchange_id); }
	elseif($gateway == "Skrill") { return PF_Skrill($exchange_id); }
	elseif($gateway == "SolidTrust Pay") { return PF_SolidTrustPay($exchange_id); }
	elseif($gateway == "WebMoney") { return PF_WebMoney($exchange_id); }
	elseif($gateway == "CoinPayments") { return PF_CoinPayments($exchange_id); }
	else { return 'Something was wrong. Please contact with administrator.'; }
}

function PF_CoinPayments($exchange_id) { 
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$return = '<div style="display:none;">
					<form method="POST" id="coinpayments_form" action="https://www.coinpayments.net/index.php">
						<input type="hidden" name="cmd" value="_pay_simple">
						<input type="hidden" name="reset" value="1">
						<input type="hidden" name="merchant" value="'.$merchant.'">
						<input type="hidden" name="item_name" value="'.$payment_note.'">
						<input type="hidden" name="currency" value="'.$currency.'">
						<input type="hidden" name="amountf" value="'.$amount.'">
						<input type="hidden" name="allow_amount" value="0">
						<input type="hidden" name="item_number" value="'.$id.'">
						<input type="hidden" name="invoice" value="'.$exchange_id.'">
						<input type="hidden" name="allow_currency" value="0">
						<input type="hidden" name="allow_currencies" value="'.$currency.'">
						<input type="hidden" name="ipn_url" value="'.$settings[url].'callbacks/checkPayment.php?a=CoinPayments&gtid='.einfo($exchange_id,"gateway_send").'">
					</form>
					</div>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#coinpayments_form").submit(); });</script>';
	return $return;
}

function PF_PayPal($exchange_id) {
	global $db, $settings;
	require("payment_src/paypal_class.php");
	define('EMAIL_ADD', gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1")); // For system notification.
	define('PAYPAL_EMAIL_ADD', gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1"));
	
	// Setup class
	$p = new paypal_class( ); 				 // initiate an instance of the class.
	$p -> admin_mail = EMAIL_ADD; 
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$p->add_field('business', PAYPAL_EMAIL_ADD); //don't need add this item. if y set the $p -> paypal_mail.
	$p->add_field('return', $url.'payment/'.$id.'/'.$exchange_id.'/success');
	$p->add_field('cancel_return', $url.'payment/'.$id.'/'.$exchange_id.'/fail');
	$p->add_field('notify_url', $url.'callbacks/checkPayment.php?a=PayPal');
	$p->add_field('item_name', $payment_note);
	$p->add_field('item_number', $id);
	$p->add_field('amount', $amount);
	$p->add_field('currency_code', $currency);
	$p->add_field('cmd', '_xclick');
	$p->add_field('rm', '2');	// Return method = POST
						 
	$return = $p->submit_paypal_post(); // submit the fields to paypal
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#paypal_form").submit(); });</script>';
	return $return;
}

function PF_AdvCash($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$secret = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_2");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$arHash = array(
			$merchant,
			$settings[name],
			$amount,
			$currency,
			$secret,
			$id
		);
	$sign = strtoupper(hash('sha256', implode(':', $arHash)));
	$return = '<div style="display:none;">
					<form method="GET" id="advcash_form" action="https://wallet.advcash.com/sci/">
					<input type="hidden" name="ac_account_email" value="'.$merchant.'">
					<input type="hidden" name="ac_sci_name" value="'.$settings[name].'">
					<input type="hidden" name="ac_amount" value="'.$amount.'">
					<input type="hidden" name="ac_currency" value="'.$currency.'">
					<input type="hidden" name="ac_order_id" value="'.$id.'">
					<input type="hidden" name="ac_sign" value="'.$sign.'">
					<input type="hidden" name="ac_success_url" value="'.$settings[url].'payment/'.$id.'/'.$exchange_id.'/success" />
					 <input type="hidden" name="ac_success_url_method" value="GET" />
					 <input type="hidden" name="ac_fail_url" value="'.$settings[url].'payment/'.$id.'/'.$exchange_id.'/fail" />
					 <input type="hidden" name="ac_fail_url_method" value="GET" />
					 <input type="hidden" name="ac_status_url" value="'.$settings[url].'callbacks/checkPayment.php?a=AdvCash" />
					 <input type="hidden" name="ac_status_url_method" value="GET" />
					<input type="hidden" name="ac_comments" value="'.$payment_note.'">
					</form>
					</div>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#advcash_form").submit(); });</script>';
	return $return;
}

function PF_Entromoney($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$secret = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_2");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	require("payment_src/entromoney.php");
	$config = array();
	$config['sci_user'] = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$config['sci_id'] 	= gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_2");
	$config['sci_pass'] = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_3");
	$config['receiver'] = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_4");

	// Call lib sci
	try {
		$sci = new Paygate_Sci($config);
	}
	catch (Paygate_Exception $e) {
		exit($e->getMessage());
	}
	$return = '';
	$input = array();
	$input['sci_user'] 		= $config['sci_user'];
	$input['sci_id'] 		= $config['sci_id'];
	$input['receiver'] 		= $config['receiver'];
	$input['amount'] 		= $amount;
	$input['desc'] 			= $payment_note;
	$input['payment_id'] 	= $id;
	$input['up_1'] 			= 'user_param_1';
	$input['up_2'] 			= 'user_param_2';
	$input['up_3'] 			= 'user_param_3';
	$input['up_4'] 			= 'user_param_4';
	$input['up_5'] 			= 'user_param_5';
	$input['url_status'] 	= $settings[url].'callbacks/checkPayment.php?a=Entromoney';
	$input['url_success'] 	= $settings[url].'payment/'.$id.'/'.$exchange_id.'/success';
	$input['url_fail'] 		= $settings[url].'payment/'.$id.'/'.$exchange_id.'/fail';

	// Create hash
	$input['hash']			= $sci->create_hash($input);
	$return = '<form action="'.Paygate_Sci::URL_SCI.'" id="entromoney_form" method="post">';
	foreach ($input as $p => $v) {
		$return .= '<input type="hidden" name="'.$p.'" value="'.$v.'">';
	}
	$return .= '</form>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#entromoney_form").submit(); });</script>';
	return $return;
}

function PF_Mollie($exchange_id) {
	global $db, $settings;
	include("Mollie/API/Autoloader.php");
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$mollie = new Mollie_API_Client;
	$mollie->setApiKey(gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1"));
		try
		{
			$order_id = id;
			/*
			 * Payment parameters:
			 *   amount        Amount in EUROs. This example creates a ˆ 10,- payment.
			 *   description   Description of the payment.
			 *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
			 *   webhookUrl    Webhook location, used to report when the payment changes state.
			 *   metadata      Custom metadata that is stored with the payment.
			 */
			$payment = $mollie->payments->create(array(
				"amount"       => $amount,
				"description"  => $payment_note,
				"redirectUrl"  => "{$settings[url]}payment/".$id."/".$exchange_id."/success",
				"webhookUrl"   => "{$settings[url]}callbacks/checkPayment.php?a=Mollie",
				"metadata"     => array(
					"order_id" => $order_id,
				),
			));
			/*
			 * Send the customer off to complete the payment.
			 */
			//header("Location: " . $payment->getPaymentUrl());
			$return = '<meta http-equiv="refresh" content="0; url='.$payment->getPaymentUrl().'" />';

	}
		catch (Mollie_API_Exception $e)
		{
			$return = "API call failed: " . htmlspecialchars($e->getMessage());
		}
	return $return;
}

function PF_Payeer($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$secret = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_2");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$m_shop = $merchant;
	$m_orderid = $id;
	$m_amount = number_format($amount, 2, '.', '');
	$m_curr = $currency;
	$desc = $payment_note;
	$m_desc = base64_encode($desc);
	$m_key = $secret;

	$arHash = array(
			$m_shop,
			$m_orderid,
			$m_amount,
			$m_curr,
			$m_desc,
			$m_key
		);
	$sign = strtoupper(hash('sha256', implode(':', $arHash)));
	$return = '<div style="display:none;"><form method="GET" id="payeer_form" action="https://payeer.com/merchant/">
		<input type="hidden" name="m_shop" value="'.$m_shop.'">
		<input type="hidden" name="m_orderid" value="'.$m_orderid.'">
		<input type="hidden" name="m_amount" value="'.$m_amount.'">
		<input type="hidden" name="m_curr" value="'.$m_curr.'">
		<input type="hidden" name="m_desc" value="'.$m_desc.'">
		<input type="hidden" name="m_sign" value="'.$sign.'">
		<!--
		<input type="hidden" name="form[ps]" value="2609">
		<input type="hidden" name="form[curr[2609]]" value="USD">
		-->
		<input type="submit" name="m_process" value="Pay with Payeer" />
		</form></div>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#payeer_form").submit(); });</script>';
	return $return;
}

function PF_Payza($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$return = '<form method="post" id="payza_form" action="https://secure.payza.com/checkout" >
				<input type="hidden" name="ap_merchant" value="'.$merchant.'"/>
				<input type="hidden" name="ap_purchasetype" value="item-goods"/>
				<input type="hidden" name="ap_itemname" value="'.$payment_note.'"/>
				<input type="hidden" name="ap_amount" value="'.$amount.'"/>
				<input type="hidden" name="ap_currency" value="'.$currency.'"/>

				<input type="hidden" name="ap_quantity" value="1"/>
				<input type="hidden" name="ap_itemcode" value="'.$id.'"/>
				<input type="hidden" name="ap_description" value=""/>
				<input type="hidden" name="ap_returnurl" value="'.$settings[url].'callbacks/checkPayment.php?a=Payza"/>
				<input type="hidden" name="ap_cancelurl" value="'.$settings[url].'payment/'.$id.'/'.$exchange_id.'/fail"/>

				<input type="hidden" name="ap_taxamount" value="0"/>
				<input type="hidden" name="ap_additionalcharges" value="0"/>
				<input type="hidden" name="ap_shippingcharges" value="0"/> 

				<input type="hidden" name="ap_discountamount" value="0"/> 
				<input type="hidden" name="apc_1" value="Blue"/>

			</form>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#payza_form").submit(); });</script>';
	return $return;
}

function PF_PerfectMoney($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$return = '<div style="display:none;">
				<form action="https://perfectmoney.is/api/step1.asp" id="pm_form" method="POST">
					<input type="hidden" name="PAYEE_ACCOUNT" value="'.$merchant.'">
					<input type="hidden" name="PAYEE_NAME" value="'.$settings[name].'">
					<input type="hidden" name="PAYMENT_ID" value="'.$id.'">
					<input type="text"   name="PAYMENT_AMOUNT" value="'.$amount.'"><BR>
					<input type="hidden" name="PAYMENT_UNITS" value="'.$currency.'">
					<input type="hidden" name="STATUS_URL" value="'.$settings[url].'callbacks/checkPayment.php?a=PerfectMoney">
					<input type="hidden" name="PAYMENT_URL" value="'.$settings[url].'payment/'.$id.'/'.$exchange_id.'/success">
					<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="NOPAYMENT_URL" value="'.$settings[url].'payment/'.$id.'/'.$exchange_id.'/fail">
					<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="SUGGESTED_MEMO" value="'.$payment_note.'">
					<input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
					<input type="submit" name="PAYMENT_METHOD" value="Pay Now!" class="tabeladugme"><br><br>
					</form></div>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#pm_form").submit(); });</script>';
	return $return;	
}

function PF_Skrill($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$return = '<div style="display:none;"><form action="https://www.moneybookers.com/app/payment.pl" method="post" id="skrill_form">
					  <input type="hidden" name="pay_to_email" value="'.$merchant.'"/>
					  <input type="hidden" name="status_url" value="'.$settings[url].'callbacks/checkPayment.php?a=Skrill"/> 
					  <input type="hidden" name="language" value="EN"/>
					  <input type="hidden" name="amount" value="'.$amount.'"/>
					  <input type="hidden" name="currency" value="'.$currency.'"/>
					  <input type="hidden" name="detail1_description" value="'.$payment_note.'"/>
					  <input type="hidden" name="detail1_text" value="'.$id.'"/>
					  <input type="submit" class="btn btn-primary" value="Click to pay."/>
					</form></div>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#skrill_form").submit(); });</script>';
	return $return;
}

function PF_SolidTrustPay($exchange_id) {
	global $db, $settings;
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$sci_name = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_2");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$return = ' <form action="https://solidtrustpay.com/handle.php" method="post" id="solid_form">
						<input type=hidden name="merchantAccount" value="'.$merchant.'" />
						<input type="hidden" name="sci_name" value="'.$sci_name.'">
						<input type="hidden" name="amount" value="'.$amount.'">
						<input type=hidden name="currency" value="'.$currency.'" />
						 <input type="hidden" name="notify_url" value="'.$settings[url].'callbacks/checkPayment.php?a=SolidTrustPay">
						  <input type="hidden" name="confirm_url" value="'.$settings[url].'callbacks/checkPayment.php?a=SolidTrustPay">
						   <input type="hidden" name="return_url" value="'.$settings[url].'payment/'.$id.'/'.$exchange_id.'/success">
						<input type=hidden name="item_id" value="'.$payment_note.'" />
						<input type=hidden name="user1" value="'.$id.'" />
					  </form>';
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#solid_form").submit(); });</script>';
	return $return;
}

function PF_WebMoney($exchange_id) {
	global $db, $settings;
	require("payment_src/webmoney.inc.php");
	$merchant = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
	$amount = einfo($exchange_id,"amount_send");
	if(gatewayinfo(einfo($exchange_id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
		} else {
			$amount = $amount + gatewayinfo(einfo($exchange_id,"gateway_send"),"extra_fee");
		}
	}
	$currency = gatewayinfo(einfo($exchange_id,"gateway_send"),"currency");
	$amount_r = einfo($exchange_id,"amount_receive");
	$currency_r = gatewayinfo(einfo($exchange_id,"gateway_receive"),"currency");
	$user = einfo($exchange_id,"u_field_2");
	$id = einfo($exchange_id,"id");
	$payment_note = 'Exchange #'.$exchange_id.' '.$amount.' '.$currency.' ('.$amount_r.' '.$currency_r.')';
	$paymentno = intval($id);
	$wm_request = new WM_Request();
	$wm_request->payment_amount = $amount;
	$wm_request->payment_desc = $payment_note;
	$wm_request->payment_no = $paymentno;
	$wm_request->payee_purse = $merchant;
	$wm_request->sim_mode = WM_ALL_SUCCESS;
	$wm_request->result_url = $settings['url']."callbacks/checkPayment.php?a=WebMoney";
	$wm_request->success_url = $settings['url']."payment/".$id."/".$exchange_id."/success";
	$wm_request->success_method = WM_POST;
	$wm_request->fail_url = $settings['url']."payment/".$id."/".$exchange_id."/fail";
	$wm_request->fail_method = WM_POST;
	$wm_request->extra_fields = array('FIELD1'=>'VALUE 1', 'FIELD2'=>'VALUE 2');
	$wm_action = 'https://merchant.wmtransfer.com/lmi/payment.asp';
	$wm_btn_label = 'Pay Webmoney';
	$return = $wm_request->SetForm();
	$return .= '<script type="text/javascript" src="'.$settings[url].'templates/EasyExchanger/assets/js/jquery-1.10.2.js"></script>';
	$return .= '<script type="text/javascript">$(document).ready(function() { $("#webmoney_form").submit(); });</script>';
	return $return;
}

function getManualForm($exchange_id) {
	global $db, $settings;
	$gateway_id = einfo($exchange_id,"gateway_send");
	$gateway = gatewayinfo($gateway_id,"name");
	$amount = einfo($exchange_id,"amount_send");
	$currency = gatewayinfo($gateway_id,"currency");
	if(gatewayinfo($gateway_id,"include_fee") == "1") {
		if (strpos(gatewayinfo($gateway_id,"extra_fee"),'%') !== false) { 
			$amount = $amount;
			$explode = explode("%",gatewayinfo($gateway_id,"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
			$fee_text = gatewayinfo($gateway_id,"extra_fee");
		} else {
			$amount = $amount + gatewayinfo($gateway_id,"extra_fee");
			$fee_text = gatewayinfo($gateway_id,"extra_fee")." ".gatewayinfo($gateway_id,"currency");
		}
		$currency = gatewayinfo($gateway_id,"currency");
	} else {
		$amount = $amount;
		$currency = gatewayinfo($gateway_id,"currency");
		$fee_text = '0';
	}
	if(gatewayinfo($gateway_id,"is_crypto")) { $acc_addr = 'address'; } else { $acc_addr = 'account'; }
	if($gateway == "Bank Transfer") {
		$form = 'Send <b>'.$amount.' '.$currency.'</b> to '.$gateway.' for:<br/>
				Bank holder name: '.einfo($exchange_id,"u_field_1").'<br/>
				Bank holder location: '.$einfo($exchange_id,"u_field_2").'<br/>
				Bank name: '.$einfo($exchange_id,"u_field_3").'<br/>
				Bank account number (IBAN): '.$einfo($exchange_id,"u_field_4").'<br/>
				Bank swift: '.$einfo($exchange_id,"u_field_5").'';
		return $form;	
	} elseif($gateway == "Moneygram" or $gateway == "Western Union") {
		$form = 'Send <b>'.$amount.' '.$currency.'</b> to '.$gateway.' for:<br/>
				Name: '.einfo($exchange_id,"u_field_1").'<br/>
				Location: '.$einfo($exchange_id,"u_field_2");
		return $form;
	} elseif(gatewayinfo($gateway_id,"external_gateway") == "1") {
		$form = 'Send <b>'.$amount.' '.$currency.'</b> to '.$gateway.' for:<br/>';
		$check = $db->query("SELECT * FROM easyex_gateways WHERE name='$gateway' and external_gateway='1'");
		if($check->num_rows>0) {
			$r = $check->fetch_assoc();
			$fieldsquery = $db->query("SELECT * FROM easyex_gateways_fields WHERE gateway_id='$r[id]' ORDER BY id");
			if($fieldsquery->num_rows>0) {
				while($field = $fieldsquery->fetch_assoc()) {
					$field_number = $field['field_number'];
					$field_id = 'a_field_'.$field_number;
					$field_value = gatewayinfo($gateway_id,$field_id);
					$form .= $field['field_name'].": ".$field_value."<br/>";
				}
			}
		}
		return $form;
	} else {
		$form = 'Send <b>'.$amount.' '.$currency.'</b> to '.$gateway.' '.$acc_addr.' <b>'.einfo($exchange_id,"u_field_1").'</b>';
		return $form;
	}
}
?>