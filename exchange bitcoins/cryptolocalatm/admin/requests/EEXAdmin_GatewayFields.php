<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../../configs/bootstrap.php");
include("../../includes/bootstrap.php");
//include(getLanguage($settings['url'],null,2));
$gateway = protect($_GET['gateway']);
if($gateway == "PayPal") {
	?>
	<div class="form-group">
		<label>Your PayPal account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Skrill") {
	?>
	<div class="form-group">
		<label>Your Skrill account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Your Skrill secret key</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<?php
} elseif($gateway == "WebMoney") {
	?>
	<div class="form-group">
		<label>Your WebMoney account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Payeer") {
	?>
	<div class="form-group">
		<label>Your Payeer account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Your Payeer secret key</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<?php
} elseif($gateway == "Perfect Money") {
	?>
	<div class="form-group">
		<label>Your Perfect Money account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Account ID or API NAME</label>
		<input type="text" class="form-control" name="a_field_3">
	</div>
	<div class="form-group">
		<label>Passpharse</label>
		<input type="text" class="form-control" name="a_field_2">
		<small>Alternate Passphrase you entered in your Perfect Money account.</small>
	</div>
	<?php
} elseif($gateway == "AdvCash") {
	?>
	<div class="form-group">
		<label>Your AdvCash account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "OKPay") {
	?>
	<div class="form-group">
		<label>Your OKPay account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
 } elseif($gateway == "iTunes Gift Card" or $gateway == "Target Gift Card" or $gateway == "Steam Wallet" or $gateway == "Amazon Gift Card" or $gateway == "Ebay Gift Card") {
	?>
	<input type="hidden" name="a_field_1" value="<?php echo $gateway; ?>">
	<?php
} elseif($gateway == "Xoomwallet") {
	?>
	<div class="form-group">
		<label>Your Xoomwallet account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Entromoney") { 
	?>
	<div class="form-group">
		<label>Your Entromoney Account ID</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Your Entromoney Receiver (Example: U11111111 or E1111111)</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<div class="form-group">
		<label>SCI ID</label>
		<input type="text" class="form-control" name="a_field_3">
	</div>
	<div class="form-group">
		<label>SCI PASS</label>
		<input type="text" class="form-control" name="a_field_4">
	</div>
	<?php
} elseif($gateway == "SolidTrust Pay") {
	?>
	<div class="form-group">
		<label>Your SolidTrust Pay account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>SCI Name</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<div class="form-group">
		<label>SCI Password</label>
		<input type="text" class="form-control" name="a_field_3">
	</div>
	<?php
} elseif($gateway == "Neteller") {
	?>
	<div class="form-group">
		<label>Your Neteller account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "UQUID") {
	?>
	<div class="form-group">
		<label>Your UQUID account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "BTC-e") {
	?>
	<div class="form-group">
		<label>Your BTC-e account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Yandex Money") {
	?>
	<div class="form-group">
		<label>Your Yandex Money account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "QIWI") {
	?>
	<div class="form-group">
		<label>Your QIWI account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Payza") {
	?>
	<div class="form-group">
		<label>Your Payza account</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>IPN SECURITY CODE</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<?php
}  elseif($gateway == "Mollie") {
	?>
	<div class="form-group">
		<label>Your Mollie API Key</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Bitcoin") {
	?>
	<div class="form-group">
		<label>Your secret key</label>
		<input type="text" class="form-control" name="a_field_1">
		<small>Enter random secret key, to protect IPN requestst</small>
	</div>
	<div class="form-group">
		<label>Your Blockchain.info xPub</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<div class="form-group">
		<label>Your Blockchain.info API Key</label>
		<input type="text" class="form-control" name="a_field_3">
	</div>
	<?php
} elseif($gateway == "Litecoin") {
	?>
	<div class="form-group">
		<label>Your Litecoin address</label>
		<input type="text" class="form-control" name="a_field_1">
		</div>
	<?php
} elseif($gateway == "Dogecoin") {
	?>
	<div class="form-group">
		<label>Your Dogecoin address</label>
		<input type="text" class="form-control" name="a_field_1">
		</div>
	<?php
} elseif($gateway == "Edinarcoin") {
	?>
	<div class="form-group">
		<label>Your Edinarcoin address</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Dash") {
	?>
	<div class="form-group">
		<label>Your Dash address</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Peercoin") {
	?>
	<div class="form-group">
		<label>Your Peercoin address</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Ethereum") {
	?>
	<div class="form-group">
		<label>Your Ethereum address</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
}  elseif($gateway == "TheBillioncoin") {
	?>
	<div class="form-group">
		<label>Your TheBillioncoin address</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<?php
} elseif($gateway == "Bank Transfer") {
	?>
	<div class="form-group">
		<label>Bank Account Holder's Name</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Bank Account Number/IBAN</label>
		<input type="text" class="form-control" name="a_field_4">
	</div>
	<div class="form-group">
		<label>SWIFT Code</label>
		<input type="text" class="form-control" name="a_field_5">
	</div>
	<div class="form-group">
		<label>Bank Name in Full</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<div class="form-group">
		<label>Bank Branch Country, City, Address</label>
		<input type="text" class="form-control" name="a_field_3">
	</div>
	<?php
} elseif($gateway == "Western Union") {
	?>
	<div class="form-group">
		<label>Your name (For money receiving)</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Your location (For money receiving)</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<?php
} elseif($gateway == "Moneygram") {
	?>
	<div class="form-group">
		<label>Your name (For money receiving)</label>
		<input type="text" class="form-control" name="a_field_1">
	</div>
	<div class="form-group">
		<label>Your location (For money receiving)</label>
		<input type="text" class="form-control" name="a_field_2">
	</div>
	<?php
} else {}
?>