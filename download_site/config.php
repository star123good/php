<?php


	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

	
	
	define('LIB_PATH', ABS_PATH . 'lib/');
	define('VIEW_PATH', ABS_PATH . 'views/');

	define('COMPONENT_PATH', VIEW_PATH . 'components/');
	define('LAYOUT_PATH', VIEW_PATH . 'layouts/');
	define('PAGE_PATH', VIEW_PATH . 'pages/');

	
	/**
	 * The base MySQL settings
	 */
	
	define('CHARSET', 'utf8');

	/** MySQL database name */
	define('DB_NAME', '');

	/** MySQL database username */
	define('DB_USER', '');

	/** MySQL database password */
	define('DB_PASSWORD', '');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');


	define('WEB_HOST', '');

	define('WEB_PATH', 'http://'.WEB_HOST.'/');
	
	define('ASSET_PATH', WEB_PATH . 'assets/');
	
	define('JS_PATH', ASSET_PATH . 'js/');
	define('CSS_PATH', ASSET_PATH . 'css/');
	define('SCSS_PATH', ASSET_PATH . 'scss/');
	define('IMAGE_PATH', ASSET_PATH . 'images/');
	define('FONT_PATH', ASSET_PATH . 'fonts/');


    define('SERVICE_URL_ONE', '');
	define('SERVICE_URL_TWO', '');

	define('SERVICE_URL_DEFAULT', '');
	define('SERVICE_URL_LOG_IN', '');
	
	define('COOKIE_PATH', 'cookie_test.txt');

	
	define('LOG_IN_USERNAME', '');
	define('LOG_IN_PASSWORD', '');


	// table names
    $table_user = "";
    $table_film = "";
	$table_site = "";
	
	// You can change other database & tables for streams tables
	/** other database name */
	define('DB_NAME1', '');
	/** other database username */
	define('DB_USER1', '');
	/** other database password */
	define('DB_PASSWORD1', '');
	/** other hostname */
	define('DB_HOST1', 'localhost');
	/** other tables name */
    $table_stream = "";
    $table_stream_option = "";

?>