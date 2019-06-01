<?php
$aStats = View::newInstance()->_get('aStats');
$totalemails = count($aStats);
?>
<?php osc_show_flash_message(); ?>

<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>
    <div class="reminder-manage-content reminder-section">
        <h3><?php _e('Emails sent', 'reminder'); ?> - <?php echo Params::getParam('date'); ?> (<?php echo $totalemails; ?> <?php _e('emails sent', 'reminder'); ?>)</h3>
        <div style="margin:15px;">
            <div class="form-row float-left">
                <a class="btn btn-mini" href="<?php echo osc_route_admin_url('reminder-stats') ?>"><?php _e('Show last 30 days', 'reminder'); ?></a>
            </div>
            <form action="<?php osc_admin_base_url(); ?>" method="post">
                <input type="hidden" name="page" value="plugins"/>
                <input type="hidden" name="action" value="renderplugin"/>
                <input type="hidden" name="route" value="reminder-stats-day"/>
                <div class="form-row float-right">
                    <label><?php _e('Filter by date', 'reminder'); ?></label>
                    <input id="datepicker" name="date" type="text"/>
                    <input type="submit" id="save_changes" value="<?php echo osc_esc_html(__("Filter", 'reminder')); ?>" class="btn btn-mini"/>
                </div>
                <br>
                <br>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th><?php _e('Date', 'reminder'); ?></th>
                        <th><?php _e('Reminder type', 'reminder'); ?></th>
                        <th><?php _e('Days', 'reminder'); ?></th>
                        <th><?php _e('Email', 'reminder'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aStats as $row) { ?>
                    <tr>
                        <td><b><?php echo $row['dt_date']; ?></b></td>
                        <td><?php echo $row['s_reminder_slug']; ?></td>
                        <td><?php echo $row['i_reminder_days']; ?></td>
                        <td><?php echo $row['s_email']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>