<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');


	
	if($type == "delete_profile"){
		// delete profile
		if(isset($profile_pk_id) && $profile_pk_id > 0){
			delete_rows($pdo, $table_profile, "`pk_i_id` = ".$profile_pk_id);
		}
	}
	else{
		// insert or update
		if(isset($_POST)){
			// init profile array
			$keys = array(
				'pk_i_id',
				'fk_i_user_id',
				'fk_i_customer_id',
				's_campaign_email',
				's_campaign_password',
				's_title',
				's_html_description',
				's_description',
				's_website',
				's_keywords',
				's_facebook_page',
				's_affiliage_link',
				's_youtube_url',
				's_address',
				's_phone',
				's_city_area',
				's_category',
				's_image_path',
				's_image_1',
				's_image_2',
				's_image_3',
				's_number_ads'
			);
			$profile_array = array(
				'id' => 0,
				'user_id' => 0,
				'customer_id' => 0,
				'campaign_email' => '',
				'campaign_password' => '',
				'title' => '',
				'html_description' => 'N',
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
				'image_path' => '',
				'image1' => '',
				'image2' => '',
				'image3' => '',
				'number_ads' => 0 
			);
			$profile_array = get_customize($_POST, $profile_array);
			
			// image files process
			if(isset($_POST['ajax_photos']) && is_array($_POST['ajax_photos'])){
				$new_file_path = UPLOADS_PATH.date("Ymd")."/";
				if(!is_dir($new_file_path)) mkdir($new_file_path);
				foreach($_POST['ajax_photos'] as $key => $photo){
					$profile_array['image'.($key+1)] = $photo;
					if(is_file(UPLOADS_PATH."temp/".$photo)) rename(UPLOADS_PATH."temp/".$photo, $new_file_path.$photo);
				}
				$profile_array['image_path'] = str_ireplace(ABS_PATH, "", $new_file_path);
			}
			if($profile_array['html_description'] == "on") $profile_array['html_description'] = "Y";
	
			// var_dump($profile_array);
	
			if($profile_array['id'] > 0){
				// update
				$result = update_row($pdo, $table_profile, $keys, $profile_array, "`pk_i_id` = ".$profile_array['id']);
				if($result) $profiles_id = $profile_array['id'];
			}
			else{
				// insert
				$profiles_id = insert_row($pdo, $table_profile, $keys, $profile_array);
			}
			
		}
	}

	

	$next_url = WEB_PATH."index.php?type=customer";

	if(isset($profiles_id) && $profiles_id > 0){
		$_SESSION['profile_id'] = $profiles_id;
		if($profile_array['save_only'] == 'submit') $next_url = WEB_PATH."index.php?type=submit_login&customer=".$profile_array['customer_id']."&submit_count=".$profile_array['number_ads'] . ((isset($random_submit_count) && $random_submit_count > 0) ? "&random_count=".$random_submit_count : "");
	}
	else{
		$_SESSION['profile_id'] = 0;
	}

	redirect($next_url);

?>