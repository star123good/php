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
$receive = gatewayinfo($gateway_receive,"name");
if(!empty($gateway_send) or !empty($gateway_receive)) {
	if(gatewayinfo($gateway_send,"name") !== NULL or gatewayinfo($gateway_receive,"name") !== NULL) {
		$InfoTemplate = new Template("../templates/".$settings['default_template']."/homepage/ExchangeInformation.tpl",$lang);
		$InfoTemplate->set("info",gatewayinfo($gateway_send,"additional_information"));
		echo $InfoTemplate->output();
	} else {
		echo '<div style="clear:both;"></div><div style="padding:20px;"><center>'.$lang[info_2].'</center></div>';
	}
}
?>