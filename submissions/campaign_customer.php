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
			'customer_password' => ''
		);
		$user_array = get_customize($_POST, $user_array);
	}

	// var_dump($user_array);

	if($type == "register"){
		// register
		$keys = array(
			's_username',
			's_email',
			's_password'
		);
		$user_id = insert_row($pdo, $table_customer, $keys, $user_array);
	}
	else if($type == "login"){
		// login
		$user_rows = select_rows($pdo, $table_customer, "`s_username` = '".$user_array['customer_name']."' and `s_email` = '".$user_array['customer_email']."' and `s_password` = '".$user_array['customer_password']."'");
		$user_row = $user_rows[count($user_rows)-1];
		if(isset($user_row['pk_i_id'])) $user_id = $user_row['pk_i_id'];
	}
	else{
		// logout
		$_SESSION['customer_id'] = 0;
	}

	if(isset($user_id) && $user_id > 0) $_SESSION['customer_id'] = $user_id;

	echo "<script>window.location='".WEB_PATH."index.php?type=profile'</script>";

?>