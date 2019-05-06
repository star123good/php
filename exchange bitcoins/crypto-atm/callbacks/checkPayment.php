<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
//include(getLanguage($settings['url'],null,2));
$a = protect($_GET['a']);
if($a == "PayPal") { include("PayPal.php"); }
elseif($a == "AdvCash") { include("AdvCash.php"); }
elseif($a == "Entromoney") { include("Entromoney.php"); }
elseif($a == "Mollie") { include("Mollie.php"); }
elseif($a == "Payeer") { include("Payeer.php"); }
elseif($a == "Payza") { include("Payza.php"); }
elseif($a == "PerfectMoney") { include("PerfectMoney.php"); }
elseif($a == "Skrill") { include("Skrill.php"); }
elseif($a == "SolidTrustPay") { include("SolidTrustPay.php"); }
elseif($a == "WebMoney") { include("WebMoney.php"); }
elseif($a == "CoinPayments") { include("CoinPayments.php"); }
else {
	echo 'Error! Unknown merchant.';
}
?>