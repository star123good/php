<?php
	
	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 


	$customer_fields = array(
		'customer_name' => '',
		'customer_email' => '',
		'customer_password' => '',
		'admin_check' => '',
		'customer_id' => 0
	);

	if($type == 'register'){
	}
	else if($type == 'customer_edit'){
		if($customer_pk_id > 0 && $customer_pk_id != $customer_id){
			if(!( isset($customer_id) && $customer_id > 0 && isset($adminer_id) && $adminer_id > 0 )) redirect(WEB_PATH."index.php");
			$customers = select_rows($pdo, $table_customer, "`pk_i_id` = " . $customer_pk_id);
		}
		else if($customer_id > 0){
			$customers = select_rows($pdo, $table_customer, "`pk_i_id` = " . $customer_id);
		}

		if($customers){
			$customer_fields = array(
				'customer_name' => $customers[0]['s_username'],
				'customer_email' => $customers[0]['s_email'],
				'customer_password' => $customers[0]['s_password'],
				'admin_check' => ($customers[0]['s_flag_adminer'] == 'Y'),
				'customer_id' => $customers[0]['pk_i_id']
			);
		}
		else{
			redirect(WEB_PATH."index.php");
		}
	}
	else if($type == 'login'){
	}

?>

            <!--  Start of body  -->
			<div class="form-container form-horizontal form-container-box">
			    <div class="header">
			        <h1>Customer Profile</h1>
			    </div>
			    <div class="resp-wrapper">

					<form action="<?php echo WEB_PATH; ?>index.php?type=post_<?php echo $type; ?>" method="post" onsubmit="return validateForm()" name="customer_form">
						<input type="hidden" name="customer_id" value="<?php echo $customer_fields['customer_id']; ?>">

						<div class="control-group">
							<label class="control-label" for="customer_name">Name</label>
							<div class="controls">
								<input id="customer_name" name="customer_name" type="text" value="<?php echo $customer_fields['customer_name']; ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="customer_email">Email</label>
							<div class="controls">
								<input id="customer_email" name="customer_email" type="text" value="<?php echo $customer_fields['customer_email']; ?>" />
							</div>
						</div>

						<?php
							if($type == 'customer_edit'){
						?>
						<div class="control-group">
							<label class="control-label" for="current_password">Current Password</label>
							<div class="controls">
								<input id="current_password" autocomplete="off" name="current_password" type="password" value="" />
							</div>
						</div>
						<?php
							}
						?>

						<div class="control-group">
							<label class="control-label" for="customer_password">Password</label>
							<div class="controls">
								<input id="customer_password" autocomplete="off" name="customer_password" type="password" value="" />
							</div>
						</div>

						<?php
							if($type != 'login'){
						?>
						<div class="control-group">
							<label class="control-label" for="confirm_password">Confirm Password</label>
							<div class="controls">
								<input id="confirm_password" autocomplete="off" name="confirm_password" type="password" value="" />
							</div>
						</div>
						<?php
							}
						?>

						<div class="control-group">
							<div class="controls checkbox">
								<input id="admin_check" type="checkbox" name="admin_check" <?php echo ($customer_fields['admin_check']) ? "checked" : ""; ?> /> <label for="admin_check">Admin Area</label>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button class="ui-button ui-button-middle ui-button-main" type="submit">
									<?php 
										if($type == 'register') echo "Create";
										else if($type == 'customer_edit') echo "Update";
										else echo "Log in"; 
									?>
								</button>
								<?php if($type == "login") echo '<a class="ui-button ui-button-middle ui-button-main" type="button" href="'.WEB_PATH.'index.php?type=register">Create a new customer</a>'; ?>
							</div>
						</div>

					</form>

					<script>
						function validateForm(){
							if(document.forms['customer_form']['customer_name'].value == ''){
								alert("You must input customer name.");
								return false;
							}
							if(document.forms['customer_form']['customer_email'].value == ''){
								alert("You must input customer email.");
								return false;
							}
							if(document.forms['customer_form']['customer_password'].value == ''){
								alert("You must input password.");
								return false;
							}
							<?php
								if($type != 'login'){
							?>
							if(document.forms['customer_form']['customer_password'].value != document.forms['customer_form']['confirm_password'].value){
								alert("Confirm password must equal to password.");
								return false;
							}
							<?php
								}
							?>
							if(document.forms['customer_form']['admin_check'].checked){
							<?php
								if($type != 'login'){
							?>
								if(confirm("Would you create a admin customer?")){
									let secret = prompt("Please type the secret password.");
									if(secret == null || secret == '') return false;
									document.forms['customer_form']['admin_check'].value = secret;
								}
								else return false;
							<?php
								}
							?>
								return confirm("Would you log in by adminer?");
							}
						}
					</script>
				
				</div>
			</div>
            <!--  End of body  -->