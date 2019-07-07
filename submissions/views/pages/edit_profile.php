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
		'html_description' => 'N',
		'website' => '',
		'keywords' => '',
		'facebook_page' => '',
		'affiliate_link' => '',
		'youtube_url' => '',
		'address' => '',
		'phone' => '',
		'city_area' => '',
		'category' => 0,
		'image_path' => '',
		'image_files' => array(),
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
			$customer_fields['html_description'] = $profile['s_html_description'];
			$customer_fields['website'] = $profile['s_website'];
			$customer_fields['keywords'] = $profile['s_keywords'];
			$customer_fields['facebook_page'] = $profile['s_facebook_page'];
			$customer_fields['affiliate_link'] = $profile['s_affiliage_link'];
			$customer_fields['youtube_url'] = $profile['s_youtube_url'];
			$customer_fields['address'] = $profile['s_address'];
			$customer_fields['phone'] = $profile['s_phone'];
			$customer_fields['city_area'] = $profile['s_city_area'];
			$customer_fields['category'] = $profile['s_category'];
			
			$customer_fields['image_path'] = $profile['s_image_path'];
			foreach(array($profile['s_image_1'], $profile['s_image_2'], $profile['s_image_3']) as $image_file_name){
				if($image_file_name != ""){
					if(is_file(ABS_PATH.$profile['s_image_path'].$image_file_name)){
						copy(ABS_PATH.$profile['s_image_path'].$image_file_name, UPLOADS_PATH."temp/".$image_file_name);
						$customer_fields['image_files'][] = $image_file_name;
					}
				}
			}
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
							<div class="controls checkbox">
								<input id="html_description" type="checkbox" name="html_description" <?php echo ($customer_fields['html_description'] == "Y") ? "checked" : "" ?> > <label for="html_description">Check here is you are using html in the description</label>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="description">Description</label>
							<div class="controls">
								<textarea id="description" name="description" rows="10" cols="" value="" >
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

						<div id="restricted-fine-uploader"></div>
            			<div style="clear:both;"></div>
						<?php
							if(count($customer_fields['image_files']) > 0) { 
						?>
							<h3><?php echo 'Images already uploaded'; ?></h3>
							<ul class="qq-upload-list">
								<?php foreach($customer_fields['image_files'] as $img){ ?>
									<li class=" qq-upload-success">
										<span class="qq-upload-file"><?php echo $img; ?></span>
										<a class="qq-upload-delete" href="#" ajaxfile="<?php echo $img; ?>" style="display: inline; cursor:pointer;"><?php echo 'Delete'; ?></a>
										<div class="ajax_preview_img"><img src="<?php echo WEB_PATH . "oc-content/uploads/temp/" . $img; ?>" alt="<?php echo $img; ?>"></div>
										<input type="hidden" name="ajax_photos[]" value="<?php echo $img; ?>">
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
            			<div style="clear:both;"></div>
						<script>
							$(document).ready(function() {

								$('.qq-upload-delete').on('click', function(evt) {
									evt.preventDefault();
									var parent = $(this).parent()
									var result = confirm("This action can't be undone. Are you sure you want to continue?");
									var urlrequest = '';
									if($(this).attr('ajaxfile')!=undefined) {
										urlrequest = 'ajax_photo='+$(this).attr('ajaxfile');
									} else {
										urlrequest = 'id='+$(this).attr('photoid')+'&item='+$(this).attr('itemid')+'&code='+$(this).attr('photoname')+'&secret='+$(this).attr('photosecret');
									}
									if(result) {
										$.ajax({
											type: "POST",
											url: '<?php echo WEB_PATH; ?>index.php?type=ajax&action=delete_image&'+urlrequest,
											dataType: 'json',
											success: function(data){
												parent.remove();
											}
										});
									}
								});

								$('#restricted-fine-uploader').on('click','.primary_image', function(event){
									if(parseInt($("div.primary_image").index(this))>0){

										var a_src   = $(this).parent().find('.ajax_preview_img img').attr('src');
										var a_title = $(this).parent().find('.ajax_preview_img img').attr('alt');
										var a_input = $(this).parent().find('input').attr('value');
										// info
										var a1 = $(this).parent().find('span.qq-upload-file').text();
										var a2 = $(this).parent().find('span.qq-upload-size').text();

										var li_first =  $('ul.qq-upload-list li').get(0);

										var b_src   = $(li_first).find('.ajax_preview_img img').attr('src');
										var b_title = $(li_first).find('.ajax_preview_img img').attr('alt');
										var b_input = $(li_first).find('input').attr('value');
										var b1      = $(li_first).find('span.qq-upload-file').text();
										var b2      = $(li_first).find('span.qq-upload-size').text();

										$(li_first).find('.ajax_preview_img img').attr('src', a_src);
										$(li_first).find('.ajax_preview_img img').attr('alt', a_title);
										$(li_first).find('input').attr('value', a_input);
										$(li_first).find('span.qq-upload-file').text(a1);
										$(li_first).find('span.qq-upload-size').text(a2);

										$(this).parent().find('.ajax_preview_img img').attr('src', b_src);
										$(this).parent().find('.ajax_preview_img img').attr('alt', b_title);
										$(this).parent().find('input').attr('value', b_input);
										$(this).parent().find('span.qq-upload-file').text(b1);
										$(this).parent().find('span.qq-upload-file').text(b2);
									}
								});

								$('#restricted-fine-uploader').on('click','.primary_image', function(event){
									$(this).addClass('over primary');
								});

								$('#restricted-fine-uploader').on('mouseenter mouseleave','.primary_image', function(event){
									if(event.type=='mouseenter') {
										if(!$(this).hasClass('primary')) {
											$(this).addClass('primary');
										}
									} else {
										if(parseInt($("div.primary_image").index(this))>0){
											$(this).removeClass('primary');
										}
									}
								});


								$('#restricted-fine-uploader').on('mouseenter mouseleave','li.qq-upload-success', function(event){
									if(parseInt($("li.qq-upload-success").index(this))>0){

										if(event.type=='mouseenter') {
											$(this).find('div.primary_image').addClass('over');
										} else {
											$(this).find('div.primary_image').removeClass('over');
										}
									}
								});

								window.removed_images = 0;
								$('#restricted-fine-uploader').on('click', 'a.qq-upload-delete', function(event) {
									window.removed_images = window.removed_images+1;
									$('#restricted-fine-uploader .flashmessage-error').remove();
								});

								$('#restricted-fine-uploader').fineUploader({
									request: {
										endpoint: "<?php echo WEB_PATH; ?>index.php?type=ajax&action=ajax_upload"
									},
									multiple: true,
									validation: {
										allowedExtensions: ['png','gif','jpg','jpeg'],
										sizeLimit: 1048576,
										itemLimit: 3
									},
									messages: {
										tooManyItemsError: 'Too many items ({netItems}) would be uploaded. Item limit is {itemLimit}.',
										onLeave: 'The files are being uploaded, if you leave now the upload will be cancelled.',
										typeError: '{file} has an invalid extension. Valid extension(s): {extensions}.',
										sizeError: '{file} is too large, maximum file size is {sizeLimit}.',
										emptyError: '{file} is empty, please select files again without it.'
									},
									deleteFile: {
										enabled: true,
										method: "POST",
										forceConfirm: false,
										endpoint: "<?php echo WEB_PATH; ?>index.php?type=ajax&action=delete_ajax_upload"
									},
									retry: {
										showAutoRetryNote : true,
										showButton: true
									},
									text: {
										uploadButton: 'Click or Drop for upload images',
										waitingForResponse: 'Processing...',
										retryButton: 'Retry',
										cancelButton: 'Cancel',
										failUpload: 'Upload failed',
										deleteButton: 'Delete',
										deletingStatusText: 'Deleting...',
										formatProgress: '{percent}% of {total_size}'
									}
								}).on('error', function (event, id, name, errorReason, xhrOrXdr) {
										$('#restricted-fine-uploader .flashmessage-error').remove();
										$('#restricted-fine-uploader').append('<div class="flashmessage flashmessage-error">' + errorReason + '<a class="close" onclick="javascript:$(\'.flashmessage-error\').remove();" >X</a></div>');
								}).on('statusChange', function(event, id, old_status, new_status) {
									$(".alert.alert-error").remove();
								}).on('complete', function(event, id, fileName, responseJSON) {
									if (responseJSON.success) {
										var new_id = id - removed_images;
										var li = $('.qq-upload-list li')[new_id];
										if(parseInt(new_id)==0) {
											$(li).append('<div class="primary_image primary"></div>');
										} else {
											$(li).append('<div class="primary_image"><a title="Make primary image"></a></div>');
										}
										$(li).append('<div class="ajax_preview_img"><img src="<?php echo WEB_PATH; ?>oc-content/uploads/temp/'+responseJSON.uploadName+'" alt="' + responseJSON.uploadName + '"></div>');
										$(li).append('<input type="hidden" name="ajax_photos[]" value="'+responseJSON.uploadName+'"></input>');
									}
								});

							});

						</script>
						
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