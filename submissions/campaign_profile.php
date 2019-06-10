<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');


	if(isset($_POST)){
		// init profile array
		$keys = array(
			'pk_i_id',
			'fk_i_user_id',
			'fk_i_cutomer_id',
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

		$profiles_id = insert_row($pdo, $table_profile, $keys, $profile_array);
	}

	if($profiles_id > 0){
		$_SESSION['profile_id'] = $profiles_id;
		echo "<script>window.location='".WEB_PATH."index.php?type=submit_login'</script>";
	}
	else echo "<script>window.location='".WEB_PATH."index.php?type=profile'</script>";

?>