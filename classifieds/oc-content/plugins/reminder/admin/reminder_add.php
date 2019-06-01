<?php
// register reminders
$aReminders = reminder_get_all();
?>
<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>

    <div class="reminder-manage-content reminder-section ">
        <h3><?php _e('Add reminders', 'reminder'); ?></h3>
        <div style="margin:15px;">
            <?php if (count($aReminders) > 0) { ?>
                <table class="table">
                    <thead>
                    <th class="col-status-border"></th>
                    <th class="col-name "><?php _e('Name', 'reminder'); ?></th>
                    <th><?php _e('Description', 'reminder'); ?></th>
                    <th><?php _e('Actions', 'reminder'); ?></th>
                    </thead>
                    <?php
                    foreach ($aReminders as $reminder_slug) {
                        $reminder = ReminderFactory::create($reminder_slug);
                        ?>
                        <tr>
                            <td class="col-status-border-<?php echo $reminder->type; ?>"></td>
                            <td class="col-status-border-<?php echo $reminder->type; ?> col-name"><?php echo $reminder->title; ?></td>
                            <td><?php echo $reminder->description; ?></td>
                            <td class="col-actions">
                                <div style="display: inline-block;width: 150px;">
                                    <a class="btn btn-mini btn-blue" href="<?php echo osc_route_admin_url('reminder-frm', array('slug' => $reminder_slug)); ?>"><?php _e('Create', 'reminder'); ?></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>