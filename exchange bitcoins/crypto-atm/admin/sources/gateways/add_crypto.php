<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
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
							<li>Add cryptocurrency</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<script type="text/javascript">
						function LoadCryptoFields(merchant) {
							var data_url = "requests/EEXAdmin_CryptoFields.php?merchant="+merchant;
							$.ajax({
								type: "GET",
								url: data_url,
								dataType: "html",
								success: function (data) {
									$("#merchant_fields").html(data);
								}
							});
						}
						</script>
						
						<?php
						if(isset($_POST['btn_add'])) {
							$merchant_source = protect($_POST['merchant_source']);
							$name = protect($_POST['coin']);
							$currency = GetCryptoCurrency($name);
							$min_amount = protect($_POST['min_amount']);
							$max_amount = protect($_POST['max_amount']);
							$reserve = protect($_POST['reserve']);
							$a_field_1 = protect($_POST['a_field_1']);
							$a_field_2 = protect($_POST['a_field_2']);
							$a_field_3 = protect($_POST['a_field_3']);
							$a_field_4 = protect($_POST['a_field_4']);
							$a_field_5 = protect($_POST['a_field_5']);
							if(isset($_POST['option_2'])) { $a_field_3 = 2; } else { $a_field_3 = 1; }
							$exchange_type = '4';
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
							$additional_information = protect($_POST['additional_information']);
							$check = $db->query("SELECT * FROM easyex_gateways WHERE name='$name' and currency='$currency'");
							if(empty($name) or empty($currency) or empty($min_amount) or empty($max_amount) or empty($reserve) or empty($fee) or empty($a_field_1)) { echo error("All fields are required."); }
							elseif($check->num_rows>0) { echo error("Gateway <b>$name $currency</b> was exists."); }
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
								$insert = $db->query("INSERT easyex_gateways (name,currency,include_fee,extra_fee,exchange_type,fee,min_amount,max_amount,reserve,allow_send,allow_receive,default_send,default_receive,a_field_1,a_field_2,a_field_3,a_field_4,a_field_5,status,require_login,require_email_verify,require_mobile_verify,require_document_verify,additional_information,is_crypto,merchant_source) VALUES ('$name','$currency','$include_fee','$extra_fee','$exchange_type','$fee','$min_amount','$max_amount','$reserve','$allow_send','$allow_receive','$default_send','$default_receive','$a_field_1','$a_field_2','$a_field_3','$a_field_4','$a_field_5','1','$require_login','$require_email_verify','$require_mobile_verify','$require_document_verify','$additional_information','1','$merchant_source')");
								$query = $db->query("SELECT * FROM easyex_gateways WHERE name='$name' and currency='$currency' ORDER BY id DESC LIMIT 1");
								$row = $query->fetch_assoc();
								$listquery = $db->query("SELECT * FROM easyex_gateways ORDER BY id");
								if($listquery->num_rows>0) {
									$i=1;
									$list = '';
									while($ls = $listquery->fetch_assoc()) {
											if($i == 1) { 
												$list = $ls[id];
											} else {
												$list .= ','.$ls[id];
											}
											$i++;
									}
								} 
								$insert = $db->query("INSERT easyex_gateways_directions (gateway_id,directions) VALUES ('$row[id]','$list')");
								echo success("Gateway <b>$name $currency</b> was added successfully.");
							}
						}
						?>
						
						<form action="" method="POST">
							<div class="form-group">
								<label>Select merchant source</label>
								<select name="merchant_source" class="form-control" onchange="LoadCryptoFields(this.value);".>
									<option value=""></option>
									<option value="block.io">Block.io</option>
									<option value="coinpayments.net">Coinpayments.net</option>
								</select>
							</div>
							<div id="merchant_fields">
							
							</div>
							<button type="submit" class="btn btn-primary" name="btn_add"><i class="fa fa-plus"></i> Add</button>
						</form>
					</div>
				</div>
			</div>