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
    
	/**
	 * The base MySQL settings of Osclass
	 */
	define('MULTISITE', 0);

	/** MySQL database name for Osclass */
	define('DB_NAME', 'bestplum_submissions');
	define('DB_NAME1', 'bestplum_classifieds');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', '');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Table prefix */
	define('DB_TABLE_PREFIX', 'oc_');

	define('REL_WEB_URL', '/submissions/');

	define('WEB_PATH', 'http://bestplumberfortlauderdale.localhost/submissions/');
	define('WEB_PATH1', 'http://bestplumberfortlauderdale.localhost/classifieds/');

	define('COOKIE_PATH', 'cookie_test.txt');


	$table_customer = "oc_t_campaign_customer";
	$table_profile = "oc_t_campaign_profile";
	$table_url_list = "oc_t_campaign_url_list";

	$table_category = "oc_t_category_description";
?>