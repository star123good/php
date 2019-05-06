<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$home = new Template("templates/".$settings['default_template']."/homepage.tpl",$lang);
$home->set("url",$settings['url']);
$gateways = array();
$query_gateways = $db->query("SELECT * FROM easyex_gateways WHERE allow_send='1' and status='1' ORDER BY id");
if($query_gateways->num_rows>0) {
	while($row = $query_gateways->fetch_assoc()) {
		$gateway = array();
		$gateway['id'] = $row['id'];
		$gateway['name'] = $row['name'];
		$gateway['currency'] = $row['currency'];
		$gateway['minimal_amount'] = $row['min_amount'];
		$gateway['maximum_amount'] = $row['max_amount'];
		if($row['is_crypto'] == "1" && $row['merchant_source'] == "coinpayments.net") {
			$gateway['gatewayIcon'] = "assets/icons/crypto/".GetCryptoCurrency($row['name']).".png";
		} else {
			$gateway['gatewayIcon'] = gatewayicon($row['name']);
		}
		$gateways[] = $gateway;
	}
	foreach ($gateways as $gateway) {
		$row = new Template("templates/".$settings['default_template']."/homepage/ExchangeFrom_Rows.tpl",$lang);
		
		foreach ($gateway as $key => $value) {
			$row->set($key, $value);
		}
		$GatewaysList[] = $row;
	}
	$ExchangeFromList = Template::merge($GatewaysList);
} else {
	$ExchangeFromList = '<div style="clear:both;"></div><div style="padding:20px;"><center>
		No configured systems yet. Try again later.
		</center></div>';
}
$home->set("ExchangeFromList",$ExchangeFromList);
echo $home->output();
?>