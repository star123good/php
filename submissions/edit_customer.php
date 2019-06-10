<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>

            <!--  Start of body  -->
			<div class="form-container form-horizontal form-container-box">
			    <div class="header">
			        <h1>Customer Profile</h1>
			    </div>
			    <div class="resp-wrapper">

					<form action="<?php echo WEB_PATH; ?>index.php?type=post_<?php echo $type; ?>" method="post" onsubmit="return validateForm()" name="customer_form">
						
						<div class="control-group">
							<label class="control-label" for="customer_name">Name</label>
							<div class="controls">
								<input id="customer_name" name="customer_name" type="text" value="" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="customer_email">Email</label>
							<div class="controls">
								<input id="customer_email" name="customer_email" type="text" value="" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="customer_password">Password</label>
							<div class="controls">
								<input id="customer_password" autocomplete="off" name="customer_password" type="password" value="" />
							</div>
						</div>

						<?php
							if($type == 'register'){
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
							<div class="controls">
								<button class="ui-button ui-button-middle ui-button-main" type="submit"><?php echo ($type == 'register')?"Create":"Log in"; ?></button>
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
								if($type == 'register'){
							?>
							if(document.forms['customer_form']['customer_password'].value != document.forms['customer_form']['confirm_password'].value){
								alert("Confirm password must equal to password.");
								return false;
							}
							<?php
								}
							?>
						}
					</script>
				
				</div>
			</div>
            <!--  End of body  -->