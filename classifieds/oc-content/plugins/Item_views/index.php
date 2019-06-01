<?php
/*
Plugin Name: Admin Item Views
Plugin URI: http://www.osclass.org/
Description:    Osclass 3.1+ displays number of times item was viewed in admin manage listings.
Version: 1.0.0
Author: mmcsus
Author URI: http://www.osclass.org/
Short Name: item_views
Plugin update URI:   
*/

 
  
 function views_help() {
        osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/views_help.php') ;
    } 

 
 


function item_views($table) {
	//IP header
       $table->addColumn('item_views', __('Views'));
           
     

}


function item_views_admin($row, $aRow) {
	// IP address
 
	$row['item_views']  = $aRow['i_num_views'] ; 
	return $row ; 
  
	 
} 


 

// Displays Views header in admin manage listings 
 osc_add_hook('admin_items_table', 'item_views');

// Displays number of times item was viewed in admin manage listings
osc_add_filter("items_processing_row", "item_views_admin" );
  


// This is a hack to show a Configure link at plugins table (you could also use some other hook to show a custom option panel)
osc_add_hook(osc_plugin_path(__FILE__)."_configure", 'views_help');

 

 

 


// This is needed in order to be able to activate the plugin
osc_register_plugin(osc_plugin_path(__FILE__), 'item_views_call_after_install');

// This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'item_views_call_after_uninstall');

 

  

?>
