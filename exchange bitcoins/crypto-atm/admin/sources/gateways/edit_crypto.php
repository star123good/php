<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_gateways WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=gateways"); }
	$row = $query->fetch_assoc();
?>		
<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Gateways</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit crypto</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
				<div class="card">
					<div class="card-body">
						
						<?php
						if(isset($_POST['btn_save'])) {
				$min_amount = protect($_POST['min_amount']);
				$max_amount = protect($_POST['max_amount']);
				$reserve = protect($_POST['reserve']);
				$a_field_1 = protect($_POST['a_field_1']);
				$a_field_2 = protect($_POST['a_field_2']);
				$a_field_3 = protect($_POST['a_field_3']);
				$a_field_4 = protect($_POST['a_field_4']);
				$a_field_5 = protect($_POST['a_field_5']);
				if(isset($_POST['option_2'])) { $a_field_3 = 2; } else { $a_field_3 = 1; }
							$fee = protect($_POST['fee']);
				$extra_fee = protect($_POST['extra_fee']);
				if(isset($_POST['include_fee'])) { $include_fee = '1'; } else { $include_fee = '0'; }
				if(isset($_POST['allow_send'])) { $allow_send = '1'; } else { $allow_send = '0'; }
				if(isset($_POST['allow_receive'])) { $allow_receive = '1'; } else { $allow_receive = '0'; }
				if(isset($_POST['default_send'])) {	$default_send = '1'; 	} else {	$default_send = '0';  }
				if(isset($_POST['default_receive'])) { $default_receive = '1'; } else { $default_receive = '0'; }
				if(isset($_POST['require_login'])) { $require_login = '1'; } else { $require_login = '0'; }
				if(isset($_POST['require_email_verify'])) { $require_email_verify = '1'; } else { $require_email_verify = '0'; }
				if(isset($_POST['require_mobile_verify'])) { $require_mobile_verify = '1'; } else { $require_mobile_verify = '0'; }
				if(isset($_POST['require_document_verify'])) { $require_document_verify = '1'; } else { $require_document_verify = '0'; }
				if(isset($_POST['is_crypto'])) { $is_crypto = '1'; } else { $is_crypto = '0'; }
				$additional_information = protect($_POST['additional_information']);
				$merchant_source = $row['merchant_source'];
				if(empty($min_amount) or empty($max_amount) or empty($reserve) or empty($fee) or empty($a_field_1)) { echo error("All fields are required."); }
				elseif(!is_numeric($min_amount)) { echo error("Please enter minimal amount with numbers."); } 
				elseif(!is_numeric($max_amount)) { echo error("Please enter maximum amount with numbers."); }
				elseif(!is_numeric($reserve)) { echo error("Please enter reserve with numbers."); }
				elseif(!is_numeric($fee)) { echo error("Please enter fee with numbers."); }
				elseif($merchant_source == "block.io" && empty($a_field_1)) { echo error("Please enter a Block.io API Key."); }
				elseif($merchant_source == "block.io" && empty($a_field_2)) { echo error("Please enter a Block.io Secret."); }
				elseif($merchant_source == "block.io" && $a_field_3 == "0" && empty($a_field_4)) { echo error("Please enter a Block.io Address.");  }
				elseif($merchant_source == "coinpayments.net" && empty($a_field_1)) { echo error("Please enter a Coinpayments.net Merchant ID"); }
				elseif($merchant_source == "coinpayments.net" && empty($a_field_2)) { echo error("Please enter a Coinpayments.net IPN Secret"); }	
				else {
					if($default_send == "1") { $update = $db->query("UPDATE easyex_gateways SET default_send='0'"); }
					If($default_receive == "1") { $update = $db->query("UPDATE easyex_gateways SET default_receive='0'"); }
					$update = $db->query("UPDATE easyex_gateways SET require_login='$require_login',require_email_verify='$require_email_verify',require_mobile_verify='$require_mobile_verify',require_document_verify='$require_document_verify',additional_information='$additional_information',min_amount='$min_amount',include_fee='$include_fee',extra_fee='$extra_fee',fee='$fee',max_amount='$max_amount',reserve='$reserve',allow_send='$allow_send',allow_receive='$allow_receive',default_send='$default_send',default_receive='$default_receive',a_field_1='$a_field_1',a_field_2='$a_field_2',a_field_3='$a_field_3',a_field_4='$a_field_4',a_field_5='$a_field_5' WHERE id='$row[id]'");
					$query = $db->query("SELECT * FROM easyex_gateways WHERE id='$row[id]'");
					$row = $query->fetch_assoc();
					echo success("Your changes was saved successfully.");
				}
			}
			
						?>
						
							<form action="" method="POST">
				<div class="form-group">
					<label>Gateway</label>
					<input type="text" class="form-control" disabled value="<?php echo $row['name']." ".$row['currency']; ?>">
				</div>
						<div class="form-group">
					<label>Minimal amount for exchange</label>
					<input type="text" class="form-control" name="min_amount" value="<?php echo $row['min_amount']; ?>">
				</div>
				<div class="form-group">
					<label>Maximum amount for exchange</label>
					<input type="text" class="form-control" name="max_amount" value="<?php echo $row['max_amount']; ?>">
				</div>
				<div class="form-group">
					<label>Reserve</label>
					<input type="text" class="form-control" name="reserve" value="<?php echo $row['reserve']; ?>">
				</div>
				<div class="form-group">
					<label>Fee</label>
					<input type="text" class="form-control" name="fee" value="<?php echo $row['fee']; ?>">
					<small>Enter fee without %. The price if coin is get automatically from coinmarketcap, and we recalculate it with your fee. For example is Bitcoin price is $7000 and if enter fee 3 (3%) your comission when client buy Bitcoin will be 7000+3%, if client sell Bitcoin to you will be 7000-3%.</small>
							</div>
				<div id="account_fields">
					<?php
					$merchant_source = $row['merchant_source'];
					if($merchant_source == "block.io") {
					?>
					<div class="form-group">
								<label>Block.io API Key</label>
								<input type="text" class="form-control" name="a_field_1" value="<?php echo $row['a_field_1']; ?>">
							</div>
							<div class="form-group">
								<label>Block.io Merchant Secret</label>
								<input type="text" class="form-control" name="a_field_2" value="<?php echo $row['a_field_2']; ?>">
							</div>
							<div class="checkbox">
								<label><input type="checkbox" name="option_2" value="yes" <?php if($row['a_field_3'] == "2") { echo 'checked'; } ?>> Generate new address for each exchange</label>
							</div>
							<div class="form-group">
								<label>Block.io Address</label>
								<input type="text" class="form-control" name="a_field_4" value="<?php echo $row['a_field_4']; ?>">
								<small>Enter here a address from your block.io account, if you do not want to generate new address for each exchange. Address must be from your block.io account to verify automatically transaction.</small>
							</div>
					<?php
					} elseif($merchant_source == "coinpayments.net") {
					?>
					<div class="form-group">
								<label>Coinpayments.net Merchant ID</label>
								<input type="text" class="form-control" name="a_field_1" value="<?php echo $row['a_field_1']; ?>">
							</div>
							<div class="form-group">
								<label>Coinpayments.net IPN Secret</label>
								<input type="text" class="form-control" name="a_field_2" value="<?php echo $row['a_field_2']; ?>">
							</div>
					<?php
					} else {}
					?>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" name="include_fee" value="yes" <?php if($row['include_fee'] == "1") { echo 'checked'; } ?>> Include extra fee in total amount for payment</label>
				</div>
				<div class="form-group">
					<label>Extra fee</label>
					<input type="text" class="form-control" name="extra_fee" value="<?php echo $row['extra_fee']; ?>">
					<small>You can setup fixed or percentage fee. This fee will be used to calculate total amount for payment for client. For example: If user sell 100 and if fee is 10% must pay 110 or if user sell 50 and fee is fixed 5.99 must pay 55.99 and etc. If do not want to setup fee leave blank.</small>
				</div>
				<div class="checkbox">
					<label>
					  <input type="checkbox" name="allow_send" value="yes" <?php if($row['allow_send'] == "1") { echo 'checked'; } ?>> Allow customers to send money through this gateway
					</label>
				  </div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_login" value="yes" <?php if($row['require_login'] == "1") { echo 'checked'; } ?>> Require user to login before exchange
								</label>
							</div> 
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_email_verify" value="yes" <?php if($row['require_email_verify'] == "1") { echo 'checked'; } ?>> Require user to verify their email address before exchange
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_document_verify" value="yes" <?php if($row['require_document_verify'] == "1") { echo 'checked'; } ?>> Require user to verify their personal documents before exchange
								</label>
							</div>
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="require_mobile_verify" value="yes" <?php if($row['require_mobile_verify'] == "1") { echo 'checked'; } ?>> Require user to verify their mobile number before exchange
								</label>
							</div>
							<div class="form-group">
								<label>Additional information</label>
								<textarea class="form-control" name="additional_information" rows="4"><?php  echo $row['additional_information']; ?></textarea>
							</div>
							 <button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
						</form>
					</div>
				</div>
			</div>