<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../../configs/bootstrap.php");
include("../../includes/bootstrap.php");
//include(getLanguage($settings['url'],null,2));
$merchant = protect($_GET['merchant']);

if($merchant == "block.io") {
	?>
	<div class="form-group">
		<label>Select coin</label>
		<select class="form-control" name="coin">
			<option value=""></option>
			<?php
			$scoins = CryptoSupport($merchant);
			foreach($scoins as $coin) {
				echo '<option value="'.$coin.'">'.$coin.'</option>';
			}
			?>
		</select>
	</div>
	<div class="form-group">
								<label>Minimal amount for exchange</label>
								<input type="text" class="form-control" name="min_amount">
							</div>
							<div class="form-group">
								<label>Maximum amount for exchange</label>
								<input type="text" class="form-control" name="max_amount">
							</div>
							<div class="form-group">
								<label>Reserve</label>
								<input type="text" class="form-control" name="reserve">
							</div>
							<div class="form-group">
								<label>Fee</label>
								<input type="text" class="form-control" name="fee">
								<small>Enter fee without %. The price if coin is get automatically from coinmarketcap, and we recalculate it with your fee. For example is Bitcoin price is $7000 and if enter fee 3 (3%) your comission when client buy Bitcoin will be 7000+3%, if client sell Bitcoin to you will be 7000-3%.</small>
							</div>
							<div class="form-group">
								<label>Block.io API Key</label>
								<input type="text" class="form-control" name="a_field_1">
							</div>
							<div class="form-group">
								<label>Block.io Merchant Secret</label>
								<input type="text" class="form-control" name="a_field_2">
							</div>
							<div class="checkbox">
								<label><input type="checkbox" name="option_2" value="yes"> Generate new address for each exchange</label>
							</div>
							<div class="form-group">
								<label>Block.io Address</label>
								<input type="text" class="form-control" name="a_field_4">
								<small>Enter here a address from your block.io account, if you do not want to generate new address for each exchange. Address must be from your block.io account to verify automatically transaction.</small>
							</div>
							<div class="checkbox">
								<label><input type="checkbox" name="include_fee" value="yes"> Include extra fee in total amount for payment</label>
							</div>
							<div class="form-group">
								<label>Extra fee</label>
								<input type="text" class="form-control" name="extra_fee">
								<small>You can setup fixed or percentage fee. This fee will be used to calculate total amount for payment for client. For example: If user sell 100 and if fee is 10% must pay 110 or if user sell 50 and fee is fixed 5.99 must pay 55.99 and etc. If do not want to setup fee leave blank.</small>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="allow_send" value="yes"> Allow customers to send money through this gateway
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_login" value="yes"> Require user to login before exchange
								</label>
							</div> 
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_email_verify" value="yes"> Require user to verify their email address before exchange
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_document_verify" value="yes"> Require user to verify their personal documents before exchange
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_mobile_verify" value="yes"> Require user to verify their mobile number before exchange
								</label>
							</div>
							<div class="form-group">
								<label>Additional information</label>
								<textarea class="form-control" name="additional_information" rows="4">Actually exchange process takes from 10 up to 30 minutes.</textarea>
							</div>
	<?php
} elseif($merchant == "coinpayments.net") {
	?>
	<div class="form-group">
		<label>Select coin</label>
		<select class="form-control" name="coin">
			<option value=""></option>
			<?php
			$scoins = CryptoSupport($merchant);
			foreach($scoins as $coin) {
				echo '<option value="'.$coin.'">'.$coin.'</option>';
			}
			?>
		</select>
	</div>
	<div class="form-group">
								<label>Minimal amount for exchange</label>
								<input type="text" class="form-control" name="min_amount">
							</div>
							<div class="form-group">
								<label>Maximum amount for exchange</label>
								<input type="text" class="form-control" name="max_amount">
							</div>
							<div class="form-group">
								<label>Reserve</label>
								<input type="text" class="form-control" name="reserve">
							</div>
							<div class="form-group">
								<label>Fee</label>
								<input type="text" class="form-control" name="fee">
								<small>Enter fee without %. The price if coin is get automatically from coinmarketcap, and we recalculate it with your fee. For example is Bitcoin price is $7000 and if enter fee 3 (3%) your comission when client buy Bitcoin will be 7000+3%, if client sell Bitcoin to you will be 7000-3%.</small>
							</div>
							<div class="form-group">
								<label>Coinpayments.net Merchant ID</label>
								<input type="text" class="form-control" name="a_field_1">
							</div>
							<div class="form-group">
								<label>Coinpayments.net IPN Secret</label>
								<input type="text" class="form-control" name="a_field_2">
							</div>
							<div class="checkbox">
								<label><input type="checkbox" name="include_fee" value="yes"> Include extra fee in total amount for payment</label>
							</div>
							<div class="form-group">
								<label>Extra fee</label>
								<input type="text" class="form-control" name="extra_fee">
								<small>You can setup fixed or percentage fee. This fee will be used to calculate total amount for payment for client. For example: If user sell 100 and if fee is 10% must pay 110 or if user sell 50 and fee is fixed 5.99 must pay 55.99 and etc. If do not want to setup fee leave blank.</small>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="allow_send" value="yes"> Allow customers to send money through this gateway
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_login" value="yes"> Require user to login before exchange
								</label>
							</div> 
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_email_verify" value="yes"> Require user to verify their email address before exchange
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_document_verify" value="yes"> Require user to verify their personal documents before exchange
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_mobile_verify" value="yes"> Require user to verify their mobile number before exchange
								</label>
							</div>
							<div class="form-group">
								<label>Additional information</label>
								<textarea class="form-control" name="additional_information" rows="4">Actually exchange process takes from 10 up to 30 minutes.</textarea>
							</div>
	<?php
} else {
	echo 'Unknown merchant.';
}
?>