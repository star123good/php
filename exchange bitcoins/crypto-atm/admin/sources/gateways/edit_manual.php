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
							<li>Edit manual payment</li>
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
				$a_field_6 = protect($_POST['a_field_6']);
				$a_field_7 = protect($_POST['a_field_7']);
				$a_field_8 = protect($_POST['a_field_8']);
				$a_field_9 = protect($_POST['a_field_9']);
				$a_field_10 = protect($_POST['a_field_10']);
				$field_1 = protect($_POST['field_1']);
				$field_2 = protect($_POST['field_2']);
				$field_3 = protect($_POST['field_3']);
				$field_4 = protect($_POST['field_4']);
				$field_5 = protect($_POST['field_5']);
				$field_6 = protect($_POST['field_6']);
				$field_7 = protect($_POST['field_7']);
				$field_8 = protect($_POST['field_8']);
				$field_9 = protect($_POST['field_9']);
				$field_10 = protect($_POST['field_10']);
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
				if(empty($min_amount) or empty($max_amount) or empty($reserve) or empty($fee) or empty($a_field_1) or empty($additional_information)) { echo error("All fields are required."); }
				elseif(!is_numeric($min_amount)) { echo error("Please enter minimal amount with numbers."); } 
				elseif(!is_numeric($max_amount)) { echo error("Please enter maximum amount with numbers."); }
				elseif(!is_numeric($reserve)) { echo error("Please enter reserve with numbers."); }
				elseif(!is_numeric($fee)) { echo error("Please enter fee with numbers."); }
				else {
					foreach($_POST['field'] as $k => $v) {
						if(!empty($v)) {
							$check = $db->query("SELECT * FROM easyex_gateways_fields WHERE gateway_id='$row[id]' and field_number='$k'");
							if($check->num_rows>0) {
								$update = $db->query("UPDATE easyex_gateways_fields SET field_name='$v' WHERE gateway_id='$row[id]' and field_number='$k'");
							} else {
								$insert = $db->query("INSERT easyex_gateways_fields (gateway_id,field_name,field_number) VALUES ('$row[id]','$v','$k')");
							}
						}
					}
					if($default_send == "1") { $update = $db->query("UPDATE easyex_gateways SET default_send='0'"); }
					If($default_receive == "1") { $update = $db->query("UPDATE easyex_gateways SET default_receive='0'"); }
					$update = $db->query("UPDATE easyex_gateways SET require_login='$require_login',require_email_verify='$require_email_verify',require_mobile_verify='$require_mobile_verify',require_document_verify='$require_document_verify',is_crypto='$is_crypto',additional_information='$additional_information',min_amount='$min_amount',include_fee='$include_fee',extra_fee='$extra_fee',fee='$fee',max_amount='$max_amount',reserve='$reserve',allow_send='$allow_send',allow_receive='$allow_receive',default_send='$default_send',default_receive='$default_receive',a_field_1='$a_field_1',a_field_2='$a_field_2',a_field_3='$a_field_3',a_field_4='$a_field_4',a_field_5='$a_field_5',a_field_6='$a_field_6',a_field_7='$a_field_7',a_field_8='$a_field_8',a_field_9='$a_field_9',a_field_10='$a_field_10' WHERE id='$row[id]'");
					$query = $db->query("SELECT * FROM easyex_gateways WHERE id='$row[id]'");
					$row = $query->fetch_assoc();
					echo success("Your changes was saved successfully.");
				}
			}
						?>
						
							<form action="" method="POST"  enctype="multipart/form-data">

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
					<small>The exchange rate is automatically converted by mconvert.net Currency Convertor API, but API convert just exchange rate. So you have a profit you need to fill this field with a number she will act as a percentage. For example: If you enter the number 2 would mean 2%, and if users exchanged 100 dollars to euro exchange rate is 1 USD = 0.97 EUR, will receive the 96EUR with the real exchange rate and if you set 2% your profit of 96 EUR will It was 1.92 EUR and the customer will receive 94.08 EUR. Enter number without %.</small>
								</div>
				<div id="account_fields">
					<?php
					$fieldsquery = $db->query("SELECT * FROM easyex_gateways_fields WHERE gateway_id='$row[id]' ORDER BY id");
					if($fieldsquery->num_rows>0) {
						while($field = $fieldsquery->fetch_assoc()) {
							$f[$field[field_number]] = $field[field_name];
						}
					}
					?>
					<div class="row">
						<div class="col-md-12"><?php echo info("<b>Name of the field</b> will be required by user when make exchange by this gateway. For example if you adding Bank Gateway enter for field name <b>SGBank Name</b> and etc.. For <b>Value of the field</b> need to enter your data for field, when user sell to this gateway will show data for payment in fields you are entered. You can add up to 10 fields."); ?></div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 1</label>
								<input type="text" class="form-control" name="field[1]" value="<?php echo $f[1]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 1</label>
								<input type="text" class="form-control" name="a_field_1" value="<?php echo $row['a_field_1']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 2</label>
								<input type="text" class="form-control" name="field[2]" value="<?php echo $f[2]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 2</label>
								<input type="text" class="form-control" name="a_field_2" value="<?php echo $row['a_field_2']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 3</label>
								<input type="text" class="form-control" name="field[3]" value="<?php echo $f[3]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 3</label>
								<input type="text" class="form-control" name="a_field_3" value="<?php echo $row['a_field_3']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 4</label>
								<input type="text" class="form-control" name="field[4]" value="<?php echo $f[4]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 4</label>
								<input type="text" class="form-control" name="a_field_4" value="<?php echo $row['a_field_4']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 5</label>
								<input type="text" class="form-control" name="field[5]" value="<?php echo $f[5]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 5</label>
								<input type="text" class="form-control" name="a_field_5" value="<?php echo $row['a_field_5']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 6</label>
								<input type="text" class="form-control" name="field[6]" value="<?php echo $f[6]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 6</label>
								<input type="text" class="form-control" name="a_field_6" value="<?php echo $row['a_field_6']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 7</label>
								<input type="text" class="form-control" name="field[7]" value="<?php echo $f[7]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 7</label>
								<input type="text" class="form-control" name="a_field_7" value="<?php echo $row['a_field_7']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 8</label>
								<input type="text" class="form-control" name="field[8]" value="<?php echo $f[8]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 8</label>
								<input type="text" class="form-control" name="a_field_8" value="<?php echo $row['a_field_8']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 9</label>
								<input type="text" class="form-control" name="field[9]" value="<?php echo $f[9]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 9</label>
								<input type="text" class="form-control" name="a_field_9" value="<?php echo $row['a_field_9']; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Name of the Field 10</label>
								<input type="text" class="form-control" name="field[10]" value="<?php echo $f[10]; ?>">
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Value of the Field 10</label>
								<input type="text" class="form-control" name="a_field_10" value="<?php echo $row['a_field_10']; ?>">
							</div>
						</div>
					</div>
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
								  <input type="checkbox" name="is_crypto" value="yes" <?php if($row['is_crypto'] == "1") { echo 'checked'; } ?>> Is crypto currency
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