<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function success($text) {
	return '<div class="alert alert-success" style="text-align:left;"><i class="fa fa-check"></i> <span>'.$text.'</span></div>';
}

function error($text) {
	return '<div class="alert alert-danger" style="text-align:left;"><i class="fa fa-times"></i> <span>'.$text.'</span></div>';
}

function info($text) {
	return '<div class="alert alert-info" style="text-align:left;"><i class="fa fa-info-circle"></i> <span>'.$text.'</span></div>';
}
?>