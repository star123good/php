<?php
$aStatsLast30 = View::newInstance()->_get('aStatsLast30');

?>
<?php osc_show_flash_message(); ?>

<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>
    <div class="reminder-manage-content reminder-section">
        <h3><?php _e('Stats - Last 30 days', 'reminder'); ?></h3>
        <div style="margin:15px;">
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
                        <th><?php _e('Emails sent', 'reminder'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aStatsLast30 as $row) {
                        $_date = str_replace(' 00:00:00', '', $row['dt_date']); ?>
                    <tr>
                        <td><b><?php echo $_date; ?></b> - <a href="<?php echo osc_route_admin_url('reminder-stats-day', array('date' => $_date )); ?>"><?php _e('View more', 'reminder'); ?></a></td>
                        <td><?php echo $row['i_total_emails']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  $(function() {
    $( "#datepicker" ).datepicker({'dateFormat' : 'yy-mm-dd'});
  });
  </script>