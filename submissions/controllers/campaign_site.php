<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');


	if(isset($_POST)){
		$site_array = array(
            'website_url' => '',
            'login_url' => '',
            'default_url' => '',
            'create_url' => '',
            'register_url' => '',
            'site_id' => 0
		);
		$site_array = get_customize($_POST, $site_array);
	}

	// var_dump($site_array);

        
    if($type == 'delete_site' && $site_id > 0){
        // delete site
        update_row($pdo, $table_url_list, ['s_flag_enable'], ['N'], "`pk_i_id` = ".$site_id);
    }
    else if($type == 'post_site'){
        $keys = array(
            's_web_url',
            's_login_url',
            's_default_url',
            's_create_url',
            's_register_url'
        );
        if($site_array['site_id'] > 0){
            // update site
            update_row($pdo, $table_url_list, $keys, $site_array, "`pk_i_id` = ".$site_array['site_id']);
        }
        else{
            // insert site
            $user_id = insert_row($pdo, $table_url_list, $keys, $site_array);
        }
    }
	

	redirect(WEB_PATH."index.php?type=show_sites");

?>