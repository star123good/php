<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

    if( !defined('ABS_PATH') ) {
        define( 'ABS_PATH', str_replace('\\', '/', dirname(__FILE__) . '/' ));
    }

	define('CHARSET', 'utf8');

	
	// from oc-load.php
	define('LIB_PATH', ABS_PATH . 'oc-includes/');
	define('CONTENT_PATH', ABS_PATH . 'oc-content/');
	define('THEMES_PATH', CONTENT_PATH . 'themes/');
	define('PLUGINS_PATH', CONTENT_PATH . 'plugins/');
	define('TRANSLATIONS_PATH', CONTENT_PATH . 'languages/');
	define('UPLOADS_PATH', CONTENT_PATH . 'uploads/');
	
	// PATHs
    define('ASSETS_PATH', ABS_PATH . 'assets/');
    define('JAVASCRIPTS_PATH', ASSETS_PATH . 'js/');
    define('CONTROLLERS_PATH', ABS_PATH . 'controllers/');
    define('LIBRARY_PATH', ABS_PATH . 'lib/');
    define('MAILER_PATH', LIBRARY_PATH . 'PHPMailer-master/');
    define('VIEW_PATH', ABS_PATH . 'views/');
    define('PAGES_PATH', VIEW_PATH . 'pages/');
    define('COMPONENTS_PATH', VIEW_PATH . 'components/');
    
	/**
	 * The base MySQL settings of Osclass
	 */
	define('MULTISITE', 0);

	/** MySQL database name for Osclass */
	define('DB_NAME', '');
	define('DB_NAME1', '');

	/** MySQL database username */
	define('DB_USER', '');

	/** MySQL database password */
	define('DB_PASSWORD', '');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Table prefix */
	define('DB_TABLE_PREFIX', 'oc_');

	define('REL_WEB_URL', '/submissions/');

	define('WEB_HOST', 'localhost');
	define('WEB_PATH', '');
	define('WEB_PATH1', '');

	define('WEB_CORS_PATH', 'https://cors-anywhere.herokuapp.com/');

	define('COOKIE_PATH', 'cookie_test.txt');


	define('PAGE_NUMBER', 100);

	// Mail Sever
	define('MAILER_PORT', 587);
	define('MAILER_SECURE', 'tls');
	define('MAILER_DEBUG', 2);
	define('MAILER_AUTH', true);


	$table_customer = "";
	$table_profile = "";
	$table_url_list = "";
	$table_submit = "";
	$table_admin_password = "";
	$table_register = "";

	$table_category = "";
?>