<?php
	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 

	
	// categories
	$categories = select_rows($pdo1, $table_category);

	// get customer
    $user_rows = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_id."'");
    $user_row = $user_rows[0];
?>

            <!--  Start of body  -->
			<div class="form-container form-horizontal form-container-box">
			    <div class="header">
			        <h1>Ad Campaign Profile</h1>
			    </div>
			    <div class="resp-wrapper">

					<form action="<?php echo WEB_PATH; ?>index.php?type=post_profile" method="post" onsubmit="return validateForm()" name="profile_form">

						<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>"/>

						<div class="control-group">
							<label class="control-label" for="campaign_email">Campaign Email</label>
							<div class="controls">
								<input id="campaign_email" name="campaign_email" type="text" value="<?php echo $user_row['s_email'] ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="campaign_password">Campaign Password</label>
							<div class="controls">
								<input id="campaign_password" autocomplete="off" name="campaign_password" type="password" value="<?php echo $user_row['s_password'] ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="title">Title</label>
							<div class="controls">
								<input id="title" name="title" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="description">Description</label>
							<div class="controls">
								<textarea id="description" name="description" rows="5" cols="" value="" >
								</textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="website">Website</label>
							<div class="controls">
								<input id="website" name="website" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="keywords">Keywords</label>
							<div class="controls">
								<input id="keywords" name="keywords" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="facebook_page">Facebook Page</label>
							<div class="controls">
								<input id="facebook_page" name="facebook_page" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="affiliate_link">Affiliate Link</label>
							<div class="controls">
								<input id="affiliate_link" name="affiliate_link" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="youtube_url">YouTube Url</label>
							<div class="controls">
								<input id="youtube_url" name="youtube_url" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="address">Address</label>
							<div class="controls">
								<input id="address" name="address" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="phone">Phone</label>
							<div class="controls">
								<input id="phone" name="phone" type="text" value="" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="city_area">City Area</label>
							<div class="controls">
								<input id="city_area" name="city_area" type="text" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="category">Category</label>
							<div class="controls">
								<select id="category" name="category" value="" >
									<?php 
										foreach ($categories as $value) {
											echo '<option value="'.$value['fk_i_category_id'].'">'.$value['s_name'].'</option>';
										} 
									?>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="image1">Image 1</label>
							<div class="controls">
								<input id="image1" name="image1" type="file" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="image2">Image 2</label>
							<div class="controls">
								<input id="image2" name="image2" type="file" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="image3">Image 3</label>
							<div class="controls">
								<input id="image3" name="image3" type="file" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="number_ads">Number of Ads</label>
							<div class="controls">
								<input id="number_ads" name="number_ads" type="text" value="" />
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button class="ui-button ui-button-middle ui-button-main" type="submit">Save</button>
								<a class="ui-button ui-button-middle ui-button-main" type="button" href="<?php echo WEB_PATH ?>index.php?type=login">Cancel</a>
							</div>
						</div>

					</form>

					<script>
						function validateForm(){
							if(document.forms['profile_form']['campaign_email'].value == ''){
								alert("You must input campain email.");
								return false;
							}
							if(document.forms['profile_form']['campaign_password'].value == ''){
								alert("You must campain password.");
								return false;
							}
							if(document.forms['profile_form']['title'].value == ''){
								alert("You must input title.");
								return false;
							}
						}
					</script>
				
				</div>
			</div>
            <!--  End of body  -->