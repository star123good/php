<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
$gateway_send = protect($_GET['gateway_send']);
$gateway_send = (int)$gateway_send;
$gateway_receive = protect($_GET['gateway_receive']);
$gateway_receive = (int)$gateway_receive;
if(!empty($gateway_send) or !empty($gateway_receive)) {
	if(gatewayinfo($gateway_send,"name") !== NULL or gatewayinfo($gateway_receive,"name") !== NULL) {
		$FormTemplate = new Template("../templates/".$settings['default_template']."/homepage/ExchangeAmount_Form.tpl",$lang);
		$rt = get_rates($gateway_send,$gateway_receive);
		if($rt['status'] == "error") {
			$FormTemplate->set("rate_from","0");
			$FormTemplate->set("rate_to","0");
			$FormTemplate->set("default_send","0");
			$FormTemplate->set("default_receive","0");
		} else {
			$FormTemplate->set("rate_from",$rt['rate_from']);
			$FormTemplate->set("rate_to",$rt['rate_to']);
			$FormTemplate->set("default_send",$rt['rate_from']);
			$FormTemplate->set("default_receive",$rt['rate_to']);
		}
		if(gatewayinfo($gateway_send,"include_fee") == "1") {
			if (strpos(gatewayinfo($gateway_send,"extra_fee"),'%') !== false) { 
				$fee_text = gatewayinfo($gateway_send,"extra_fee");
			} else {
				$fee_text = gatewayinfo($gateway_send,"extra_fee")." ".gatewayinfo($gateway_send,"currency");
			}
		} else {
			$fee_text = '';
		}
		if($fee_text) { $extra_fee = '<br/>'.gatewayinfo($gateway_send,"name").' '.$lang[transaction_fee].': '.$fee_text; } else { $extra_fee = ''; }
		$FormTemplate->set("extra_fee",$extra_fee);
		$FormTemplate->set("currency_from",gatewayinfo($gateway_send,"currency"));
		$FormTemplate->set("currency_to",gatewayinfo($gateway_receive,"currency"));
		$FormTemplate->set("reserve",gatewayinfo($gateway_receive,"reserve"));
		$FormTemplate->set("sic1",gatewayinfo($gateway_send,"is_crypto"));
		$FormTemplate->set("sic2",gatewayinfo($gateway_receive,"is_crypto"));
		echo $FormTemplate->output();
	} else {
		echo '<div style="clear:both;"></div><div style="padding:20px;"><center>'.$lang[info_2].'</center></div>';
	}
}
?>