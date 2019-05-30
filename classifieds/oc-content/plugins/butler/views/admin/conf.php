<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    if(Params::getParam('plugin_action')=='done') {
        $ed = Params::getParam('expired_days');
        if(!is_numeric($ed) || $ed<1) {
            $ed = 1;
        }
        $al = Params::getParam('activated_listings_days');
        if(!is_numeric($al) || $al<1) {
            $al = 1;
        }
        $sd = Params::getParam('spam_days');
        if(!is_numeric($sd) || $sd<1) {
            $sd = 1;
        }
        $au = Params::getParam('activated_users_days');
        if(!is_numeric($au) || $au<1) {
            $au = 1;
        }
        $limit = Params::getParam('limit');
        if(!is_numeric($limit) || $limit<1) {
            $limit = 250;
        }

        osc_set_preference('delete_expired', Params::getParam("delete_expired") ? Params::getParam("delete_expired") : '0', 'butler');
        osc_set_preference('expired_days', $ed, 'butler');

        osc_set_preference('delete_activated_listings', Params::getParam("delete_activated_listings") ? Params::getParam("delete_activated_listings") : '0', 'butler');
        osc_set_preference('activated_listings_days', $al, 'butler');

        osc_set_preference('delete_spam', Params::getParam("delete_spam") ? Params::getParam("delete_spam") : '0', 'butler');
        osc_set_preference('spam_days', $sd, 'butler');

        osc_set_preference('delete_activated_users', Params::getParam("delete_activated_users") ? Params::getParam("delete_activated_users") : '0', 'butler');
        osc_set_preference('activated_users_days', $au, 'butler');

        osc_set_preference('limit', $limit, 'butler');

        // HACK : This will make possible use of the flash messages ;)
        ob_get_clean();
        osc_add_flash_ok_message(__('Congratulations, the plugin is now configured', 'butler'), 'admin');
        osc_redirect_to(osc_route_admin_url('butler-admin-conf'));
    }
?>

<div id="general-setting">
    <div id="general-settings">
        <h2 class="render-title"><?php _e('Butler settings', 'butler'); ?></h2>
        <ul id="error_list"></ul>
        <form name="payment_pro_form" action="<?php echo osc_admin_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="plugins" />
            <input type="hidden" name="action" value="renderplugin" />
            <input type="hidden" name="route" value="butler-admin-conf" />
            <input type="hidden" name="plugin_action" value="done" />
            <fieldset>
                <div class="form-horizontal">
                    <div class="form-row">
                        <p><?php _e('Please remember that to work properly, cron or auto-cron must be enabled, being your system cron the preferred method', 'butler'); ?></p>
                    </div>
                    <div class="form-row">
                        <div class="form-label"><?php _e('Expired listings', 'butler'); ?></div>
                        <div class="form-controls">
                            <div class="form-label-checkbox">
                                <label>
                                    <input type="checkbox" <?php echo (osc_get_preference('delete_expired', 'butler')==1 ? 'checked="true"' : ''); ?> name="delete_expired" value="1" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="expired_div">
                        <div class="form-label"><?php _e('Delete expired listings after X days', 'butler'); ?></div>
                        <div class="form-controls"><input type="text" class="xsmall" name="expired_days" value="<?php echo osc_get_preference('expired_days', 'butler'); ?>" /></div>
                    </div>

                    <hr/>

                    <div class="form-row">
                        <div class="form-label"><?php _e('Non activated listings', 'butler'); ?></div>
                        <div class="form-controls">
                            <div class="form-label-checkbox">
                                <label>
                                    <input type="checkbox" <?php echo (osc_get_preference('delete_activated_listings', 'butler')==1 ? 'checked="true"' : ''); ?> name="delete_activated_listings" value="1" />
                                    <?php _e('Delete listings that have not been activated by their authors', 'butler'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="activated_listings_div">
                        <div class="form-label"><?php _e('Delete non activated listings after X days', 'butler'); ?></div>
                        <div class="form-controls"><input type="text" class="xsmall" name="activated_listings_days" value="<?php echo osc_get_preference('activated_listings_days', 'butler'); ?>" /></div>
                    </div>

                    <hr/>

                    <div class="form-row">
                        <div class="form-label"><?php _e('Spam listings', 'butler'); ?></div>
                        <div class="form-controls">
                            <div class="form-label-checkbox">
                                <label>
                                    <input type="checkbox" <?php echo (osc_get_preference('delete_spam', 'butler')==1 ? 'checked="true"' : ''); ?> name="delete_spam" value="1" />
                                    <?php _e('Delete listings that have been marked as spam by the admin or akismet', 'butler'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="spam_div">
                        <div class="form-label"><?php _e('Delete spam listings after X days', 'butler'); ?></div>
                        <div class="form-controls"><input type="text" class="xsmall" name="spam_days" value="<?php echo osc_get_preference('spam_days', 'butler'); ?>" /></div>
                    </div>

                    <hr/>

                    <div class="form-row">
                        <div class="form-label"><?php _e('Non activated users', 'butler'); ?></div>
                        <div class="form-controls">
                            <div class="form-label-checkbox">
                                <label>
                                    <input type="checkbox" <?php echo (osc_get_preference('delete_activated_users', 'butler')==1 ? 'checked="true"' : ''); ?> name="delete_activated_users" value="1" />
                                    <?php _e('Delete users that have not activated their accounts', 'butler'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="activated_users_div">
                        <div class="form-label"><?php _e('Delete non activated users after X days', 'butler'); ?></div>
                        <div class="form-controls"><input type="text" class="xsmall" name="activated_users_days" value="<?php echo osc_get_preference('activated_users_days', 'butler'); ?>" /></div>
                    </div>

                    <hr/>

                    <div class="form-row">
                        <div class="form-label"><?php _e('Limit', 'butler'); ?></div>
                        <div class="form-controls"><input type="text" class="xsmall" name="limit" value="<?php echo osc_get_preference('limit', 'butler'); ?>" /></div>
                        <div class="form-label"></div>
                        <span class="help-box"><?php _e('Number of listings/users that will be deleted each time. If you have memory problems, lower this value, if you have a high traffic website, raise it. <b>Default value: 250</b>', 'butler'); ?></span>
                    </div>

                    <div class="clear"></div>
                    <div class="form-actions">
                        <input type="submit" id="save_changes" value="<?php echo osc_esc_html( __('Save changes') ); ?>" class="btn btn-submit" />
                    </div>

                </div>
            </fieldset>
        </form>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        butlerShow();
        $('input[name="delete_expired"]').on("click", function() { butlerShow(); });
        $('input[name="delete_activated_listings"]').on("click", function() { butlerShow(); });
        $('input[name="delete_spam"]').on("click", function() { butlerShow(); });
        $('input[name="delete_activated_users"]').on("click", function() { butlerShow(); });
    });

    function butlerShow() {
        if ($('input[name="delete_expired"]').attr('checked')=="checked") {
            $("#expired_div").show();
        } else {
            $("#expired_div").hide();
        }
        if ($('input[name="delete_activated_listings"]').attr('checked')=="checked") {
            $("#activated_listings_div").show();
        } else {
            $("#activated_listings_div").hide();
        }
        if ($('input[name="delete_spam"]').attr('checked')=="checked") {
            $("#spam_div").show();
        } else {
            $("#spam_div").hide();
        }
        if ($('input[name="delete_activated_users"]').attr('checked')=="checked") {
            $("#activated_users_div").show();
        } else {
            $("#activated_users_div").hide();
        }
    }

</script>