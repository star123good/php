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
		// insert of update
		if(isset($_POST)){
			// init profile array
			$keys = array(
				'pk_i_id',
				'fk_i_user_id',
				'fk_i_customer_id',
				's_campaign_email',
				's_campaign_password',
				's_title',
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
			$profile_array = get_customize($_POST, $profile_array);
	
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

	if($profiles_id > 0){
		$_SESSION['profile_id'] = $profiles_id;
		if($profile_array['save_only'] == 'submit') $next_url = WEB_PATH."index.php?type=submit_login&customer=".$profile_array['customer_id']."&submit_count=".$profile_array['number_ads'] . ((isset($random_submit_count) && $random_submit_count > 0) ? "&random_count=".$random_submit_count : "");
	}
	else{
		$_SESSION['profile_id'] = 0;
	}

	redirect($next_url);

?>