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
	define('DB_NAME', 'bestplum_submissions');
	define('DB_NAME1', 'bestplum_classifieds');

	/** MySQL database username */
	define('DB_USER', 'root');
	// define('DB_USER', 'bestplum_matt2');

	/** MySQL database password */
	define('DB_PASSWORD', '');
	// define('DB_PASSWORD', 'Test90000');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Table prefix */
	define('DB_TABLE_PREFIX', 'oc_');

	define('REL_WEB_URL', '/submissions/');

	define('WEB_HOST', 'bestplumberfortlauderdale.localhost');
	// define('WEB_HOST', 'www.bestplumberfortlauderdale.com');
	define('WEB_PATH', 'http://'.WEB_HOST.'/submissions/');
	define('WEB_PATH1', 'http://'.WEB_HOST.'/classifieds/');

	define('WEB_CORS_PATH', 'https://cors-anywhere.herokuapp.com/');

	define('COOKIE_PATH', 'cookie_test.txt');


	define('PAGE_NUMBER', 100);

	// Mail Sever
	define('MAILER_PORT', 587);
	define('MAILER_SECURE', 'tls');
	define('MAILER_DEBUG', 2);
	define('MAILER_AUTH', true);


	$table_customer = "oc_t_campaign_customer";
	$table_profile = "oc_t_campaign_profile";
	$table_url_list = "oc_t_campaign_url_list";
	$table_submit = "oc_t_campaign_submit";
	$table_admin_password = "oc_t_campaign_admin";
	$table_register = "oc_t_campaign_register";

	$table_category = "oc_t_category_description";
?>