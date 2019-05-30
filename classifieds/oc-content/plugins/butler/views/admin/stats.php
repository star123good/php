<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    if(Params::getParam('plugin_action')=='done') {
        butler_cron();

        // HACK : This will make possible use of the flash messages ;)
        ob_get_clean();
        osc_add_flash_ok_message(__('Butler has cleaned your listings and users', 'butler'), 'admin');
        osc_redirect_to(osc_route_admin_url('butler-admin-stats'));
    }
?>

<div id="general-setting">
    <div id="general-settings">
        <h2 class="render-title"><?php _e('Butler settings', 'butler'); ?></h2>
        <ul id="error_list"></ul>
        <form name="payment_pro_form" action="<?php echo osc_admin_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="plugins" />
            <input type="hidden" name="action" value="renderplugin" />
            <input type="hidden" name="route" value="butler-admin-stats" />
            <input type="hidden" name="plugin_action" value="done" />
            <fieldset>
                <div class="form-horizontal">
                    <div class="form-row">
                        <div class="form-controls"><?php printf(__('Expired listings deleted: %d', 'butler'), osc_get_preference('expired_listings', 'butler')); ?></div>
                    </div>

                    <div class="form-row">
                        <div class="form-controls"><?php printf(__('Inactivated listings deleted: %d', 'butler'), osc_get_preference('activated_listings', 'butler')); ?></div>
                    </div>

                    <div class="form-row">
                        <div class="form-controls"><?php printf(__('Spam listings deleted: %d', 'butler'), osc_get_preference('spam_listings', 'butler')); ?></div>
                    </div>

                    <div class="form-row">
                        <div class="form-controls"><?php printf(__('Inactivated users deleted: %d', 'butler'), osc_get_preference('activated_users', 'butler')); ?></div>
                    </div>

                    <div class="clear"></div>
                    <div class="form-actions">
                        <input type="submit" id="save_changes" value="<?php echo osc_esc_html( __('Run Butler now') ); ?>" class="btn btn-submit" />
                    </div>

                </div>
            </fieldset>
        </form>
    </div>
</div>