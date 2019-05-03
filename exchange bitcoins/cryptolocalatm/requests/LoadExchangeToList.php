<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
$gateway_id = protect($_GET['gateway_id']);
$gateway_id = (int)$gateway_id;
if(!empty($gateway_id)) {
	$query = $db->query("SELECT * FROM easyex_gateways_directions WHERE gateway_id='$gateway_id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		$expl = explode(",",$row['directions']);
		$gateways = array();
		foreach($expl as $v) {
			$gateway = array();
			$gateway['id'] = gatewayinfo($v,"id");
			$gateway['name'] = gatewayinfo($v,"name");
			$gateway['currency'] = gatewayinfo($v,"currency");
			$gateway['reserve'] = gatewayinfo($v,"reserve");
			if(gatewayinfo($v,"is_crypto") == "1" && gatewayinfo($v,"merchant_source") == "coinpayments.net") {
				$gateway['gatewayIcon'] = "assets/icons/crypto/".GetCryptoCurrency(gatewayinfo($v,"name")).".png";
			} else {
				$gateway['gatewayIcon'] = gatewayicon(gatewayinfo($v,"name"));
			}
			$gateways[] = $gateway;
		}
		foreach ($gateways as $gateway) {
			$row = new Template("../templates/".$settings['default_template']."/homepage/ExchangeTo_Rows.tpl",$lang);
			
			foreach ($gateway as $key => $value) {
				$row->set($key, $value);
			}
			$GatewaysList[] = $row;
		}
		$ExchangeToList = Template::merge($GatewaysList);
		echo $ExchangeToList;
	} else {
		echo '<div style="clear:both;"></div><div style="padding:20px;"><center>'.$lang[info_1].'</center></div>';
	}
}
?>