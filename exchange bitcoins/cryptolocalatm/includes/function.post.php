<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function CreatePostURL($value) {
	$value = strtolower($value);
	$value = str_ireplace(".","",$value);
	$value = str_ireplace(",","",$value);
	$value = str_ireplace("!","",$value);
	$value = str_ireplace("@","",$value);
	$value = str_ireplace("#","",$value);
	$value = str_ireplace("$","",$value);
	$value = str_ireplace("%","",$value);
	$value = str_ireplace("^","",$value);
	$value = str_ireplace("&","",$value);
	$value = str_ireplace("*","",$value);
	$value = str_ireplace("*","",$value);
	$value = str_ireplace("-","",$value);
	$value = str_ireplace("+","",$value);
	$value = str_ireplace("/","",$value);
	$value = str_ireplace(";","",$value);
	$value = str_ireplace(":","",$value);
	$value = str_ireplace("'","",$value);
	$value = str_ireplace("|","",$value);
	$value = str_ireplace(" ","-",$value);
	return $value;
}
?>