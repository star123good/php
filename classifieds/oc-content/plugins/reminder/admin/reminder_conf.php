<?php
$email = osc_get_preference('bcc_email','reminder');
$stats_email = osc_get_preference('bcc_stats_email','reminder');
?>
<?php osc_show_flash_message(); ?>

<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>
    <div class="reminder-manage-content reminder-section">
        <div style="margin:15px;">
            <form action="<?php osc_admin_base_url(); ?>" method="post">
                <input type="hidden" name="page" value="plugins"/>
                <input type="hidden" name="action" value="renderplugin"/>
                <input type="hidden" name="route" value="reminder-conf"/>
                <input type="hidden" name="reminder_admin" value="reminder-admin-conf-post"/>

                <div class="form-horizontal">
                    <p><h3><?php _e('Send a copy of every "reminder" email', 'reminder'); ?></h3></p>
                    <div class="form-row">
                        <div class="form-label"> <?php _e('BCC Email', 'reminder'); ?></div>
                        <div class="form-controls">
                            <input type="text" value="<?php echo osc_esc_html($email); ?>" name="bcc_email"/>
                            <div class="help-box">
                                <?php  _e('Will be included as bcc email address in every reminder sent', 'reminder'); ?>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <p><h3><?php _e('Send a copy of "Weekly website statistics reminder"', 'reminder'); ?></h3></p>
                    <p style="margin-left: 1em;">
                        <?php printf(__('Stats reminders are send to the <b>%s</b> by default', 'reminder'), osc_contact_email());  ?>
                    </p>
                    <p style="margin-left: 1em;">
                        <?php _e('You can add more email addresses separated by coma.', 'reminder');  ?>
                    </p>
                    <div class="form-row">
                        <div class="form-label"> <?php _e('BCC Email', 'reminder'); ?></div>
                        <div class="form-controls">
                            <input type="text" value="<?php echo osc_esc_html($stats_email); ?>" name="bcc_stats_email"/>
                            <div class="help-box">
                                <?php  _e('Will be included as bcc email address only on "Weekly website statistics reminder"', 'reminder'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" id="save_changes" value="<?php echo osc_esc_html(__("Save changes", 'reminder')); ?>" class="btn btn-submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
