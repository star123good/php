<?php
	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 


	$flag_pass = true;
    if(!( isset($customer_id) && $customer_id > 0 )) $flag_pass = false;


	// categories
	$categories = select_rows($pdo1, $table_category);
	

	// custom profile fields
	$customer_fields = array(
		'id' => 0,
		'customer_id' => 0,
		'campaign_email' => '',
		'campaign_password' => '',
		'title' => '',
		'description' => '',
		'website' => '',
		'keywords' => '',
		'facebook_page' => '',
		'affiliate_link' => '',
		'youtube_url' => '',
		'address' => '',
		'phone' => '',
		'city_area' => '',
		'category' => 0,
		'image1' => '',
		'image2' => '',
		'image3' => '',
		'number_ads' => 0
	);

	if($type == 'profile'){// create new profile
		// get customer
		if($adminer_id > 0 && $customer_pk_id > 0) $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");
		else $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_id."'");
		if($customers) $customer = $customers[0]; else $customer = [];

		$customer_fields['customer_id'] = $customer_id;
		$customer_fields['campaign_email'] = $customer['s_email'];
		$customer_fields['campaign_password'] = $customer['s_password'];
	}
	else if($type == 'edit_profile'){// edit old profile
		// profiles
		$profiles = select_rows($pdo, $table_profile, "`pk_i_id` = " . $profile_pk_id);
		if($profiles){
			$profile = $profiles[0];
			
			$customer_fields['id'] = $profile['pk_i_id'];
			$customer_fields['customer_id'] = $profile['fk_i_customer_id'];
			$customer_fields['campaign_email'] = $profile['s_campaign_email'];
			$customer_fields['campaign_password'] = $profile['s_campaign_password'];
			$customer_fields['title'] = $profile['s_title'];
			$customer_fields['description'] = $profile['s_description'];
			$customer_fields['website'] = $profile['s_website'];
			$customer_fields['keywords'] = $profile['s_keywords'];
			$customer_fields['facebook_page'] = $profile['s_facebook_page'];
			$customer_fields['affiliate_link'] = $profile['s_affiliage_link'];
			$customer_fields['youtube_url'] = $profile['s_youtube_url'];
			$customer_fields['address'] = $profile['s_address'];
			$customer_fields['phone'] = $profile['s_phone'];
			$customer_fields['city_area'] = $profile['s_city_area'];
			$customer_fields['category'] = $profile['s_category'];
			$customer_fields['image1'] = $profile['s_image_1'];
			$customer_fields['image2'] = $profile['s_image_2'];
			$customer_fields['image3'] = $profile['s_image_3'];
		}
		else $flag_pass = false;
	}


	if(!$flag_pass) redirect(WEB_PATH."index.php");



	
	
	

?>

            <!--  Start of body  -->
			<div class="form-container form-horizontal form-container-box">
			    <div class="header">
			        <h1>Ad Campaign Profile</h1>
			    </div>
			    <div class="resp-wrapper">

					<form action="<?php echo WEB_PATH; ?>index.php?type=post_profile<?php echo (isset($random_submit_count) && $random_submit_count > 0) ? "&random_count=".$random_submit_count : "" ?>" method="post" onsubmit="return validateForm()" name="profile_form" id="profile_form">

						<input type="hidden" name="customer_id" value="<?php echo $customer_fields['customer_id']; ?>"/>
						<input type="hidden" name="id" value="<?php echo $customer_fields['id']; ?>"/>
						<input type="hidden" name="save_only" id="save_only" value=""/>

						<div class="control-group">
							<label class="control-label" for="campaign_email">Campaign Email</label>
							<div class="controls">
								<input id="campaign_email" name="campaign_email" type="text" value="<?php echo $customer_fields['campaign_email']; ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="campaign_password">Campaign Password</label>
							<div class="controls">
								<input id="campaign_password" autocomplete="off" name="campaign_password" type="password" value="<?php echo $customer_fields['campaign_password']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="title">Title</label>
							<div class="controls">
								<input id="title" name="title" type="text" value="<?php echo $customer_fields['title']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="description">Description</label>
							<div class="controls">
								<textarea id="description" name="description" rows="5" cols="" value="" >
									<?php echo $customer_fields['description']; ?>
								</textarea>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="website">Website</label>
							<div class="controls">
								<input id="website" name="website" type="text" value="<?php echo $customer_fields['website']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="keywords">Keywords</label>
							<div class="controls">
								<input id="keywords" name="keywords" type="text" value="<?php echo $customer_fields['keywords']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="facebook_page">Facebook Page</label>
							<div class="controls">
								<input id="facebook_page" name="facebook_page" type="text" value="<?php echo $customer_fields['facebook_page']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="affiliate_link">Affiliate Link</label>
							<div class="controls">
								<input id="affiliate_link" name="affiliate_link" type="text" value="<?php echo $customer_fields['affiliate_link']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="youtube_url">YouTube Url</label>
							<div class="controls">
								<input id="youtube_url" name="youtube_url" type="text" value="<?php echo $customer_fields['youtube_url']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="address">Address</label>
							<div class="controls">
								<input id="address" name="address" type="text" value="<?php echo $customer_fields['address']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="phone">Phone</label>
							<div class="controls">
								<input id="phone" name="phone" type="text" value="<?php echo $customer_fields['phone']; ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="city_area">City Area</label>
							<div class="controls">
								<input id="city_area" name="city_area" type="text" value="<?php echo $customer_fields['city_area']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="category">Category</label>
							<div class="controls">
								<select id="category" name="category" value="" >
									<?php 
										foreach ($categories as $value) {
											echo '<option value="'.$value['fk_i_category_id'].'"  >'.$value['s_name'].'</option>';
										} 
									?>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="image1">Image 1</label>
							<div class="controls">
								<input id="image1" name="image1" type="file" value="<?php echo $customer_fields['image1']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="image2">Image 2</label>
							<div class="controls">
								<input id="image2" name="image2" type="file" value="<?php echo $customer_fields['image2']; ?>" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="image3">Image 3</label>
							<div class="controls">
								<input id="image3" name="image3" type="file" value="<?php echo $customer_fields['image3']; ?>" />
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
								<button class="ui-button ui-button-middle ui-button-main" type="button" onclick="handleClickSaveSubmit()" >
									Save & Submit
								</button>
								<button class="ui-button ui-button-middle ui-button-main" type="button" onclick="handleClickSave()">
									Save
								</button>
								<a class="ui-button ui-button-middle ui-button-main" type="button" href="<?php echo WEB_PATH ?>index.php?type=login">
									Cancel
								</a>
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
						function handleClickSave(){
							if(confirm('Are you sure you want to save ads only?\nIf you want to save only, you needn\'t input number of ads.')){
								$('#save_only').val('save').change();
								document.getElementById("profile_form").submit();
							}
						}
						function handleClickSaveSubmit(){
							if(confirm('Are you sure you want to submit ads now?\nIf you want to submit, you must input number of ads.')){
								$('#save_only').val('submit').change();
								if(document.forms['profile_form']['number_ads'].value != '') document.getElementById("profile_form").submit();
							}
						}
						$(document).ready(function(){
							$('#category').val(<?php echo $customer_fields['category']; ?>).change();

							<?php
								if(isset($random_submit_count) && $random_submit_count > 0){
							?>
								setTimeout(function(){
									$('#save_only').val('submit').change();
									$('#number_ads').val(1).change();
									document.getElementById("profile_form").submit();
								}, 1000);
							<?php		
								}
							?>
						});
					</script>
				
				</div>
			</div>
            <!--  End of body  -->