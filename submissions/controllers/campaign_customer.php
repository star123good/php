<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');


	if(isset($_POST)){
		$user_array = array(
			'customer_name' => '',
			'customer_email' => '',
			'customer_password' => '',
			'verify_code' => get_verify_code(),
			'admin_check' => '',
			'flag_verify' => 'N'
		);
		$user_array = get_customize($_POST, $user_array);
	}

	// var_dump($user_array);

	$flag_adminer = false;
	$flag_pass = true;
	if($user_array['admin_check'] != ''){
		// adminer
		if($type == "register"){
			// create adminer
			$adminer_secret_password = select_rows($pdo, $table_admin_password, "`pk_i_id` = 1")[0];
			if($user_array['admin_check'] == $adminer_secret_password['s_password']) $flag_adminer = true;
			else $flag_pass = false;
		}
		else if($type == "login"){
			// login adminer
			if($user_array['admin_check'] == 'on') $flag_adminer = true;
		}
	}

	if($type == 'post_customer_edit' && $user_array['customer_id'] > 0){
		// update customer
		if(!(isset($adminer_id) && $adminer_id > 0) && $user_array['customer_id'] != $customer_id) $flag_pass = false;// check adminer or owner
		// check current password ???
	}

	if($type == 'customer_delete' && $customer_pk_id > 0){
		// delete customer
		if(!(isset($adminer_id) && $adminer_id > 0) && $customer_pk_id != $customer_id) $flag_pass = false;// check adminer or owner
	}

	if($flag_pass && $type != 'logout'){
		$next_url = WEB_PATH."index.php?type=customer";

		

		if($type == "register"){
			// register
			$keys = array(
				's_username',
				's_email',
				's_password',
				's_verify_code',
				's_flag_adminer',
				's_flag_verify'
			);
			if($flag_adminer) $user_array['admin_check'] = 'Y';
			else $user_array['admin_check'] = 'N';
			$user_id = insert_row($pdo, $table_customer, $keys, $user_array);
		}
		else if($type == "login"){
			// login
			if($flag_adminer) $user_rows = select_rows($pdo, $table_customer, "`s_username` = '".$user_array['customer_name']."' and `s_email` = '".$user_array['customer_email']."' and `s_password` = '".$user_array['customer_password']."' and `s_flag_adminer` = 'Y'");
			else $user_rows = select_rows($pdo, $table_customer, "`s_username` = '".$user_array['customer_name']."' and `s_email` = '".$user_array['customer_email']."' and `s_password` = '".$user_array['customer_password']."' and `s_flag_adminer` = 'N'");
			if(is_array($user_rows) && count($user_rows) > 0) $user_row = $user_rows[count($user_rows)-1];
			if(isset($user_row['pk_i_id'])) $user_id = $user_row['pk_i_id'];
		}
		else if($type == 'post_customer_edit'){
			// update customer
			$keys = array(
				's_username',
				's_email',
				's_password',
				's_verify_code'
			);
			update_row($pdo, $table_customer, $keys, $user_array, "`pk_i_id` = ".$user_array['customer_id']);
			$next_url = WEB_PATH."index.php?type=customers";
		}
		else if($type == 'customer_delete'){
			// delete customer
			delete_rows($pdo, $table_customer, "`pk_i_id` = ".$customer_pk_id);
			$next_url = WEB_PATH."index.php?type=customers";
		}

		if(isset($user_id) && $user_id > 0){
			// login | register success
			$_SESSION['customer_id'] = $user_id;
			if($flag_adminer) $_SESSION['adminer_id'] = 1;
			else $_SESSION['adminer_id'] = 0;
		}
	}
	else{
		// logout | not passing
		$_SESSION['customer_id'] = 0;
		$_SESSION['adminer_id'] = 0;
		$_SESSION['profile_id'] = 0;
		$next_url = WEB_PATH."index.php";
	}
	

	redirect($next_url);

?>