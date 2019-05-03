<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

// EasyExchanger version
$version = '1.0';

function CheckEEXVer($version) {
	$get = "http://demos.sdevpro.com/VerCheck/EEX.php";
	$ch = curl_init();
	$url = $get;
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);
	$data = array();
	if($result == $version) {
		$data['status'] = 'success';
		$data['msg'] = 'You are using latest version of EasyExchanger.';
	} else {
		$data['status'] = 'error';
		$data['msg'] = 'We have new updates for EasyExchanger script. Please <a href="https://demos.sdevpro.com/VerCheck/EEX_Changelog.txt" target="_blank">click here</a> to see new updates.';
	}
	return $data;
}
?>