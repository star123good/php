<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['id']);
if(!checkExchange($id)) {
	header("Location: $settings[url]");
}

if(einfo($id,"status") !== "1") {
	$redirect = $settings['url']."track/".$id;
	header("Location: $redirect");
}

$exchange_type = gatewayinfo(einfo($id,"gateway_send"),"exchange_type");
if($exchange_type == "2") {
	$tpl = new Template("templates/".$settings['default_template']."/pay.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$tpl2 = new Template("templates/".$settings['default_template']."/pay/Automatic.tpl",$lang);
	$tpl2->set("gateway_name",gatewayinfo(einfo($id,"gateway_send"),"name"));
	$tpl2->set("AutoForm",getPaymentForm($id));
	$tpl->set("PaymentForm",$tpl2->output());
	echo $tpl->output();
} elseif($exchange_type == "3") {
	$tpl = new Template("templates/".$settings['default_template']."/pay.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$tpl2 = new Template("templates/".$settings['default_template']."/pay/Manually.tpl",$lang);
	$tpl2->set("url",$settings['url']);
	$tpl2->set("gateway_send",gatewayinfo(einfo($id,"gateway_send"),"name"));
	$tpl2->set("gateway_send_currency",gatewayinfo(einfo($id,"gateway_send"),"currency"));
	$tpl2->set("gateway_send_icon",gatewayicon(gatewayinfo(einfo($id,"gateway_send"),"name")));
	$tpl2->set("gateway_receive",gatewayinfo(einfo($id,"gateway_receive"),"name"));
	$tpl2->set("gateway_receive_currency",gatewayinfo(einfo($id,"gateway_receive"),"currency"));
	$tpl2->set("gateway_receive_icon",gatewayicon(gatewayinfo(einfo($id,"gateway_receive"),"name")));
	$tpl2->set("exchange_id",$id);
	$tpl2->set("ManualForm",getManualForm($id));
	if(gatewayinfo(einfo($id,"gateway_send"),"include_fee") == "1") {
		if (strpos(gatewayinfo(einfo($id,"gateway_send"),"extra_fee"),'%') !== false) { 
			$amount = einfo($id,"amount_send");
			$explode = explode("%",gatewayinfo(einfo($id,"gateway_send"),"extra_fee"));
			$fee_percent = 100+$explode[0];
			$new_amount = ($amount * 100) / $fee_percent;
			$new_amount = round($new_amount,2);
			$fee_amount = $amount-$new_amount;
			$amount = $amount+$fee_amount;
			$fee_text = gatewayinfo(einfo($id,"gateway_send"),"extra_fee");
		} else {
			$amount = einfo($id,"amount_send") + gatewayinfo(einfo($id,"gateway_send"),"extra_fee");
			$fee_text = gatewayinfo(einfo($id,"gateway_send"),"extra_fee")." ".gatewayinfo($row[gateway_send],"currency");
		}
		$currency = gatewayinfo(einfo($id,"gateway_send"),"currency");
	} else {
		$amount = einfo($id,"amount_send");
		$currency = gatewayinfo(einfo($id,"gateway_send"),"currency");
		$fee_text = '0 '.$currency;
	}
	$tpl2->set("amount_send",einfo($id,"amount_send"));
	$tpl2->set("amount_total",$amount);
	$tpl2->set("extra_fee",$fee_text);
	$tpl2->set("additional_information",nl2br(gatewayinfo(einfo($id,"gateway_send"),"additional_information")));
	$tpl2->set("amount_receive",einfo($id,"amount_receive"));
	if(gatewayinfo(einfo($id,"gateway_receive"),"is_crypto") == "1") {
		$tpl2->set("acc_type",$lang['address']);
		$tpl2->set("u_acc",einfo($id,"u_field_2"));
	} else { 
		$tpl2->set("acc_type",$lang['account']);
		$tpl2->set("u_acc",einfo($id,"u_field_2"));
	}
	$tpl->set("PaymentForm",$tpl2->output());
	echo $tpl->output();
} elseif($exchange_type == "4") {
	$merchant = gatewayinfo(einfo($id,"gateway_send"),"merchant_source");
	if($merchant == "block.io") {
		$gateway = gatewayinfo(einfo($id,"gateway_send"),"name");
		$cryptosupport = CryptoSupport($merchant);
		if($cryptosupport) {
			if(in_array($gateway, $cryptosupport)) {
				$blockio_api_key = gatewayinfo(einfo($id,"gateway_send"),"a_field_1");
				$blockio_secret = gatewayinfo(einfo($id,"gateway_send"),"a_field_2");	
				$option = gatewayinfo(einfo($id,"gateway_send"),"a_field_3");
				if($option == "1") {
					// use one address for each exchange
					$address = gatewayinfo(einfo($id,"gateway_send"),"a_field_4");
				} elseif($option == "2") {
					// use new address for each exchange
					$apiKey = $blockio_api_key;
					$pin = $blockio_secret;
					$version = 2; // the API version
					$block_io = new BlockIo($apiKey, $pin, $version);
					if(einfo($id,"u_field_10")) {
						$address = einfo($id,"u_field_10");
					} else {
						$new_address = $block_io->get_new_address();
						if($new_address->status == "success") { 
							$address = $new_address->data->address;
							$time = time();
							$update = $db->query("UPDATE easyex_exchanges SET u_field_10='$address' WHERE exchange_id='$id'");
							$insert = $db->query("INSERT easyex_edata (exchange_id,type,value,num,time) VALUES ('$id','new_address','$address','0','$time')");
						} else {
							$address = 'Cant generate new address, please contact with administrator.';
						}
					}
				} else {
					$address = 'no address';
				}
				$tpl = new Template("templates/".$settings['default_template']."/pay.tpl",$lang);
				$tpl->set("url",$settings['url']);
				$tpl2 = new Template("templates/".$settings['default_template']."/pay/Block.io.tpl",$lang);
				$tpl2->set("url",$settings['url']);
				$tpl2->set("amount_send",einfo($id,"amount_send"));
				$tpl2->set("gateway_send",gatewayinfo(einfo($id,"gateway_send"),"name"));
				$tpl2->set("gateway_send_id",einfo($id,"gateway_send"));
				$tpl2->set("gateway_send_currency",gatewayinfo(einfo($id,"gateway_send"),"currency"));
				$tpl2->set("gateway_send_icon",gatewayicon(gatewayinfo(einfo($id,"gateway_send"),"name")));
				$tpl2->set("gateway_receive",gatewayinfo(einfo($id,"gateway_receive"),"name"));
				$tpl2->set("gateway_receive_currency",gatewayinfo(einfo($id,"gateway_receive"),"currency"));
				$tpl2->set("gateway_receive_icon",gatewayicon(gatewayinfo(einfo($id,"gateway_receive"),"name")));
				$tpl2->set("exchange_id",$id);
				$tpl2->set("address",$address);
				if(gatewayinfo(einfo($id,"gateway_send"),"include_fee") == "1") {
					if (strpos(gatewayinfo(einfo($id,"gateway_send"),"extra_fee"),'%') !== false) { 
						$amount = einfo($id,"amount_send");
						$explode = explode("%",gatewayinfo(einfo($id,"gateway_send"),"extra_fee"));
						$fee_percent = 100+$explode[0];
						$new_amount = ($amount * 100) / $fee_percent;
						$new_amount = round($new_amount,2);
						$fee_amount = $amount-$new_amount;
						$amount = $amount+$fee_amount;
						$fee_text = gatewayinfo(einfo($id,"gateway_send"),"extra_fee");
					} else {
						$amount = einfo($id,"amount_send") + gatewayinfo(einfo($id,"gateway_send"),"extra_fee");
						$fee_text = gatewayinfo(einfo($id,"gateway_send"),"extra_fee")." ".gatewayinfo($row[gateway_send],"currency");
					}
					$currency = gatewayinfo(einfo($id,"gateway_send"),"currency");
				} else {
					$amount = einfo($id,"amount_send");
					$currency = gatewayinfo(einfo($id,"gateway_send"),"currency");
					$fee_text = '0 '.$currency;
				}
				$tpl2->set("amount_send",einfo($id,"amount_send"));
				$tpl2->set("amount_total",$amount);
				$tpl2->set("extra_fee",$fee_text);
				$tpl2->set("additional_information",nl2br(gatewayinfo(einfo($id,"gateway_send"),"additional_information")));
				$tpl2->set("amount_receive",einfo($id,"amount_receive"));
				if(gatewayinfo(einfo($id,"gateway_receive"),"is_crypto") == "1") {
					$tpl2->set("acc_type","address");
					$tpl2->set("u_acc",einfo($id,"u_field_2"));
				} else { 
					$tpl2->set("acc_type","account");
					$tpl2->set("u_acc",einfo($id,"u_field_2"));
				}
				$tpl->set("PaymentForm",$tpl2->output());
				echo $tpl->output();
			} else {
				$tpl = new Template("templates/".$settings['default_template']."/error.tpl",$lang);
				$tpl->set("url",$settings['url']);
				$tpl->set("error_head","Block.io is not support $gateway");
				$tpl->set("error_content","The gateway is not configurated currectly. Please report this to site admin to solve problem.");
				echo $tpl->output();				
			}
		} else {
			$tpl = new Template("templates/".$settings['default_template']."/error.tpl",$lang);
			$tpl->set("url",$settings['url']);
			$tpl->set("error_head","Block.io is not support $gateway");
			$tpl->set("error_content","The $gateway is not a crypto currency. Please report this to site admin to solve problem.");
			echo $tpl->output();
		}
	} elseif($merchant == "coinpayments.net") {
		$tpl = new Template("templates/".$settings['default_template']."/pay.tpl",$lang);
		$tpl->set("url",$settings['url']);
		$tpl2 = new Template("templates/".$settings['default_template']."/pay/Automatic.tpl",$lang);
		$tpl2->set("gateway_name",gatewayinfo(einfo($id,"gateway_send"),"name"));
		$tpl2->set("AutoForm",PF_CoinPayments($id));
		$tpl->set("PaymentForm",$tpl2->output());
		echo $tpl->output();
	} else {
	
	}
} else {
	header("Location: $settings[url]");
}
?>