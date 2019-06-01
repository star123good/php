<?php
$aReminders = ModelReminder::newInstance()->getReminders();
?>

<?php osc_show_flash_message(); ?>

<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>
    <div class="reminder-manage-content reminder-section">
        <h3><?php _e('Manage active reminders', 'reminder'); ?> <?php echo count($aReminders); ?></h3>
        <div style="margin:15px;">
        <?php if (count($aReminders) > 0) { ?>
            <table class="table">
                <thead>
                    <th class="col-status-border "></th>
                    <th class="col-status "><?php _e('Status', 'reminder'); ?></th>
                    <th><?php _e('Created on', 'reminder'); ?></th>
                    <th><?php _e('Reminder name', 'reminder'); ?></th>
                    <th><?php _e('Execute past X days', 'reminder'); ?></th>
                    <th><?php _e('Actions', 'reminder'); ?></th>
                </thead>
                <?php
                foreach ($aReminders as $reminder) {
                    $_url           = osc_route_admin_url('reminder-frm', array('slug' => $reminder['s_slug'], 'days' => $reminder['i_days']));
                    $_url_toggle_enabled = osc_route_admin_url('reminder-toggle-enable', array('slug' => $reminder['s_slug'], 'days' => $reminder['i_days']));
                    ?>
                    <tr class="status-<?php echo ($reminder['b_enabled']==1) ? 'active' : 'blocked' ?>">
                        <td class="col-status-border"></td>
                        <td class="col-status"><?php echo ($reminder['b_enabled']==1) ? __('Enabled', 'reminder') : __('Blocked', 'reminder'); ?></td>
                        <td><?php echo $reminder['dt_created'] ?></td>
                        <td>
                            <?php echo $reminder['s_slug'] ?>
                            <p><strong><?php _e('Subject', 'reminder'); ?>: </strong><i><?php echo $reminder['s_subject'] ?></i></p>
                        </td>
                        <td><?php echo $reminder['i_days'] ?></td>
                        <td class="col-actions">
                            <div style="display: inline-block;width: 150px;">
                                <a class="btn btn-mini <?php echo ($reminder['b_enabled']==0) ? 'btn-orange': 'btn-red'; ?>" href="<?php echo $_url_toggle_enabled; ?>"><?php echo ($reminder['b_enabled']==1) ? __('Block', 'reminder') : __('Enable', 'reminder'); ?></a>
                                <a class="btn btn-mini" href="<?php echo $_url; ?>"><?php _e('Edit reminder', 'reminder'); ?></a>
                                <a class="btn btn-mini" onclick="deleteReminderConfirm('<?php echo osc_esc_js($reminder['s_slug'])?>', '<?php echo $reminder['i_days']; ?>');"><?php _e('Delete reminder', 'reminder'); ?></a>
                                <?php if($reminder['s_slug']!='reminder-admin-stats-daily'
                                    && $reminder['s_slug']!='reminder-admin-stats-weekly') { ?>
                                <a class="btn btn-mini" onclick="testReminder('<?php echo osc_esc_js($reminder['s_slug'])?>', '<?php echo $reminder['i_days']; ?>');"><?php _e('Test reminder', 'reminder'); ?></a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <div class="short-description">
                <strong><?php _e("No reminders found", 'reminder'); ?>.</strong> <?php _e("Create a new reminder now:", 'reminder'); ?>
                <br/>
                <ul>
                    <li class="<?php echo (osc_reminder_is_add_reminder_page()) ? 'active' : ''; ?>">
                        <a href="<?php echo (osc_reminder_is_add_reminder_page()) ? '#' : osc_route_admin_url('reminder-add'); ?>"><?php _e('Add reminder', 'reminder'); ?></a>
                        <br/>
                        <?php _e('User and listing related reminders. New user, user not validated, new listing, listing not validated, listing stats, ...', 'reminder');?>
                    </li>

                    <li class="<?php echo (osc_reminder_is_add_reminder_stats_page()) ? 'active' : ''; ?>">
                        <a href="<?php echo (osc_reminder_is_add_reminder_stats_page()) ? '#' : osc_route_admin_url('reminder-add-stats'); ?>"><?php _e('Reminder Stats', 'reminder'); ?></a>
                        <br/>
                        <?php _e('Basic website statistics.', 'reminder');?>
                        <br/>
                        - <?php _e('New user period vs previous period.', 'reminder'); ?>
                        <br/>
                        - <?php _e('New listings period vs previous period.', 'reminder'); ?>
                        <br/>
                        <?php _e('Daily and weekly reports are available', 'reminder');?>
                    </li>
                </ul>
            </div>
        <?php } ?>
        </div>
    </div>
</div>

<?php if (count($aReminders) > 0) { ?>
<script type="text/javascript">
    function deleteReminderConfirm(slug, days) {
        var r = confirm("Do you really want to delete this reminder?");
        if (r == true) {
            <?php $_url_delete = osc_route_admin_url('reminder-delete', array('slug' => null, 'days' => null)); ?>
            window.location.href = '<?php echo $_url_delete; ?>&slug='+slug+'&days='+days;
        }
    }
    function testReminder(slug, days) {
        var email = prompt("Please enter an email", "");
        if (email != null && checkEmail(email)) {
            window.location.href = '<?php echo osc_route_admin_url('reminder-test-reminder');?>&slug='+slug+'&days='+days+'&email='+email;
        }
    }
    function checkEmail(email) {

        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            var message = '<a class="btn ico btn-mini ico-close">x</a><?php _e('Please provide a valid email address', 'reminder'); ?>';
            $('.flashmessage').last().html('');
            $('.flashmessage').last().append(message);
            $('.flashmessage').last().addClass("flashmessage-error");
            $('.flashmessage').last().show();
            return false;
         }
         return true;
     }
</script>
<?php } ?>
