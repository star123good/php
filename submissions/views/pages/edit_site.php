<?php
	
	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 

    $flag_pass = false;
    if(( isset($customer_id) && $customer_id > 0 && isset($adminer_id) && $adminer_id > 0 )) $flag_pass = true;


	$customer_fields = array(
		'website_url' => '',
		'login_url' => '',
		'default_url' => '',
		'create_url' => '',
		'register_url' => '',
		'site_id' => 0
	);

	if($type == 'add_site'){
        // create new site
	}
	else if($type == 'edit_site'){
        // edit old site
		if($site_id > 0){
            $sites = select_rows($pdo, $table_url_list, "`pk_i_id` = " . $site_id);
            if($sites){
                $site = $sites[0];
                $customer_fields = array(
                    'website_url' => $site['s_web_url'],
                    'login_url' => $site['s_login_url'],
                    'default_url' => $site['s_default_url'],
                    'create_url' => $site['s_create_url'],
                    'register_url' => $site['s_register_url'],
                    'site_id' => $site['pk_i_id']
                );
                $flag_pass = true;
            }
		}
    }

    
    if(!$flag_pass) redirect(WEB_PATH."index.php?type=show_sites");

?>

            <!--  Start of body  -->
			<div class="form-container form-horizontal form-container-box">
			    <div class="header">
			        <h1>Classifieds Site</h1>
			    </div>
			    <div class="resp-wrapper">

					<form action="<?php echo WEB_PATH; ?>index.php?type=post_site" method="post" onsubmit="return validateForm()" name="customer_form">
						<input type="hidden" name="site_id" value="<?php echo $customer_fields['site_id']; ?>">

						<div class="control-group">
							<label class="control-label" for="website_url">SITE URL</label>
							<div class="controls">
								<input id="website_url" name="website_url" type="text" value="<?php echo $customer_fields['website_url']; ?>" style="width:80%" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="default_url">Default URL</label>
							<div class="controls">
								<input id="default_url" name="default_url" type="text" value="<?php echo $customer_fields['default_url']; ?>" style="width:80%" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="login_url">Log In URL</label>
							<div class="controls">
								<input id="login_url" name="login_url" type="text" value="<?php echo $customer_fields['login_url']; ?>" style="width:80%" />
							</div>
						</div>

                        <div class="control-group">
                            <label class="control-label" for="create_url">Create New Item URL</label>
                            <div class="controls">
                                <input id="create_url" name="create_url" type="text" value="<?php echo $customer_fields['create_url']; ?>" style="width:80%" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="register_url">Register URL</label>
                            <div class="controls">
                                <input id="register_url" name="register_url" type="text" value="<?php echo $customer_fields['register_url']; ?>" style="width:80%" />
                            </div>
                        </div>

						<div class="control-group">
							<div class="controls">
								<button class="ui-button ui-button-middle ui-button-main" type="submit">
									<?php 
										if($type == 'add_site') echo "Create";
										else if($type == 'edit_site') echo "Update";
									?>
								</button>
							</div>
						</div>

					</form>

					<script>
						function validateForm(){
							if(document.forms['customer_form']['website_url'].value == ''){
								alert("You must input website url.");
								return false;
							}
						}
					</script>
				
				</div>
			</div>
            <!--  End of body  -->