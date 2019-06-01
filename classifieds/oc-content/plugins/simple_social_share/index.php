<?php
/*
Plugin Name: Simple Social Share
Plugin URI: http://www.osclass.org/
Description: Simple Social item Share without javascript.
Version: 1.1.2
Author: Shamim
Author URI: http://ghoray.com/
Short Name: simple-social-share
Plugin update URI: simple-social-share
*/


function sss_share_buttons()
	{
		?>
	<style type="text/css">
		#sss-share-btn img{
		opacity:1.0;
		filter:alpha(opacity=100); /* For IE8 and earlier */
		}
		#sss-share-btn:hover img{
		opacity:0.5;
		filter:alpha(opacity=50); /* For IE8 and earlier */
		}
	</style>
		 <!-- SIMPLE SOCIAL SHARE BUTTONS START -->
<!-- Email -->
<a href="<?php echo osc_item_send_friend_url(); ?>" target="_blank" id="sss-share-btn"><img src="<?php echo osc_plugin_url(__FILE__);?>images/email.png" alt="<?php _e('Share by email'); ?>" title="<?php _e('Share by email'); ?>" /></a>
<!-- Facebook -->
<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(osc_item_url()); ?>&t=<?php echo osc_item_title(); ?>" target="_blank" id="sss-share-btn"><img src="<?php echo osc_plugin_url(__FILE__);?>images/facebook.png" alt="<?php _e('Share on Facebook'); ?>" title="<?php _e('Share on Facebook'); ?>" /></a>
<!-- Twitter -->
<a href="https://twitter.com/share?url=<?php echo rawurlencode(osc_item_url()); ?>&text=<?php echo osc_item_title(); ?>" target="_blank" id="sss-share-btn"><img src="<?php echo osc_plugin_url(__FILE__);?>images/twitter.png" alt="<?php _e('Share on Twitter'); ?>" title="<?php _e('Share on Twitter'); ?>" /></a>
<!-- Google+ -->
<a href="https://plus.google.com/share?url=<?php echo rawurlencode(osc_item_url()); ?>" target="_blank" id="sss-share-btn"><img src="<?php echo osc_plugin_url(__FILE__);?>images/google.png" alt="<?php _e('Share on Google+'); ?>" title="<?php _e('Share on Google+'); ?>" /></a>
<!-- Linkedin -->
<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode(osc_item_url()); ?>&title=<?php echo osc_item_title(); ?>" target="_blank" id="sss-share-btn"><img src="<?php echo osc_plugin_url(__FILE__);?>images/linkedin.png" alt="<?php _e('Share on LinkedIn'); ?>" title="<?php _e('Share on LinkedIn'); ?>" /></a>
<!-- Pinterest -->
<a href="https://pinterest.com/pin/create/button/?url=<?php echo rawurlencode(osc_item_url()); ?>" target="_blank" id="sss-share-btn"><img src="<?php echo osc_plugin_url(__FILE__);?>images/pinterest.png" alt="<?php _e('Pin on Pinterest'); ?>" title="<?php _e('Pin on Pinterest'); ?>" /></a>
<!-- SIMPLE SOCIAL SHARE BUTTONS END -->

		<?php 
	}
	
osc_add_hook('item_detail', 'sss_share_buttons', 10);
