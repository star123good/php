<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>
    <div class="reminder-manage-content reminder-section ">
        <h3><?php _e('Add statistics reminder', 'reminder'); ?></h3>
        <div style="margin:15px;">
            <table class="table">
                <thead>
                <th class="col-status-border"></th>
                <th class="col-name "><?php _e('Name', 'reminder'); ?></th>
                <th><?php _e('Description', 'reminder'); ?></th>
                <th><?php _e('Actions', 'reminder'); ?></th>
                </thead>
                <tr>
                    <td class="col-status-border-stats"></td>
                    <td class="col-status-border-stats col-name"><?php _e('Daily website statistics', 'reminder'); ?></td>
                    <td>
                        <?php _e('Admin daily digest with stats on your site.', 'reminder'); ?>
                        <ol>
                            <li>
                                <?php _e(' new users last <b>day</b> versus last period', 'reminder'); ?>
                            </li>
                            <li>
                                <?php _e(' new listings last <b>day</b> versus last period', 'reminder'); ?>
                            </li>
                        </ol>
                    </td>
                    <td class="col-actions">
                        <div style="display: inline-block;width: 150px;">
                            <a class="btn btn-mini btn-blue" href="<?php echo osc_route_admin_url('reminder-frm', array('slug' => 'reminder-admin-stats-daily')); ?>"><?php _e('Create', 'reminder'); ?></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-status-border-stats"></td>
                    <td class="col-status-border-stats col-name"><?php _e('Weekly website statistics', 'reminder'); ?></td>
                    <td>
                        <?php _e('Admin weekly digest with stats on your site.', 'reminder'); ?>
                        <ol>
                            <li>
                                <?php _e(' new users last <b>week</b> versus last period', 'reminder'); ?>
                            </li>
                            <li>
                                <?php _e(' new listings last <b>week</b> versus last period', 'reminder'); ?>
                            </li>
                        </ol>
                    </td>
                    <td class="col-actions">
                        <div style="display: inline-block;width: 150px;">
                            <a class="btn btn-mini btn-blue" href="<?php echo osc_route_admin_url('reminder-frm', array('slug' => 'reminder-admin-stats-weekly')); ?>"><?php _e('Create', 'reminder'); ?></a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>