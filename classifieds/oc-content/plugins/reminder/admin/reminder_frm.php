<?php
//$name       = View::newInstance()->_get('name');
//$legend      = View::newInstance()->_get('legend');
//$description    = View::newInstance()->_get('description');

$reminder = ReminderFactory::create(Params::getParam('slug'));
$name = $reminder->title;
$description = $reminder->description;
$legend = $reminder->legend;

if (Params::getParam('slug') == 'reminder-admin-stats-daily') {
    $name = __('Daily stats');
    $description = __('Admin daily digest with stats on your site.', 'reminder');
}
if (Params::getParam('slug') == 'reminder-admin-stats-weekly') {
    $name = __('Weekly stats');
    $description = __('Admin weekly digest with stats on your site.', 'reminder');
}

$slug         = View::newInstance()->_get('slug');
$subject     = View::newInstance()->_get('subject');
$days         = View::newInstance()->_get('days');
$enabled    = View::newInstance()->_get('enabled');
$body_content = View::newInstance()->_get('body_content');
$custom_start_hour = View::newInstance()->_get('custom_start_hour');
$plugin_action = View::newInstance()->_get('plugin_action');
$reminder_force_days = View::newInstance()->_get('reminder_force_days');
?>
<style><?php include 'style.css'; ?></style>
<div class="reminder-manage-wrapper">
    <?php include 'reminder_menu.php'; ?>
    <div class="reminder-manage-content">
        <div id="item-form" class="reminder-section">
            <?php osc_show_flash_message(); ?>

            <form action="<?php osc_admin_base_url(); ?>" method="post">
                <input type="hidden" name="page" value="plugins"/>
                <input type="hidden" name="action" value="renderplugin"/>
                <input type="hidden" name="route" value="reminder-frm"/>
                <input type="hidden" name="reminder_admin" value="reminder-admin-settings-post"/>
                <input type="hidden" name="slug" value="<?php echo $slug; ?>"/>
                <?php if ($plugin_action == 'add') { ?>
                    <input type="hidden" name="plugin_action" value="add"/>
                <?php } else { ?>
                    <input type="hidden" name="plugin_action" value="edit"/>
                <?php } ?>
                <h3><?php echo $name; ?></h3>
                <div class="content">
                    <p class="short-description"><?php echo $description; ?></p>
                    <?php if(count($reminder->requirements)>0) { ?>
                    <p>
                        <?php _e('In order for a reminder to be send must be met:', 'reminder'); ?>
                        <ul>
                            <?php foreach($reminder->requirements as $must) { ?>
                            <li><?php echo $must; ?></li>
                            <?php } ?>
                        </ul>
                    </p>
                    <?php } ?>
                    <p class="days">
                        <?php
                        if ($plugin_action == 'add') {
                            $type = "text";
                            if($reminder_force_days!='') { $type = "hidden"; }
                            if($custom_start_hour) {
                                osc_reminder_select_start_date();
                            }
                            ?>
                            <input type="<?php echo $type; ?>" name="days" value="<?php echo $days; ?>"/>
                        <?php
                        }
                        if ($plugin_action != 'add' || $reminder_force_days != '') { ?>
                            <span class="day_str"><?php _e('After', 'reminder'); ?> <b><?php echo $days; ?></b> <?php _e('days', 'reminder'); ?></span>
                    <?php }
                    ?>
                    </p>

                    <p>
                        <label for="b_enabled">
                            <input id="b_enabled" type="checkbox" <?php echo ($enabled==="1") ? 'checked="checked"' : ''; ?> name="enabled"/>
                            <?php _e('Enabled', 'reminder'); ?>
                        </label>
                    </p>
                    <p>
                        <label><?php _e('Email subject:', 'reminder'); ?></label><br/>
                        <input class="xxlarge" type="text" name="subject" value="<?php echo osc_esc_html($subject); ?>"/>
                    </p>
                    <div id="left-side">
                        <textarea id="body_content" name="body_content" rows="10"><?php echo $body_content; ?></textarea>
                    </div>
                    <div id="right-side">
                        <?php if(count($legend)>0) { ?>
                        <div class="well ui-rounded-corners">
                            <h3 style="margin: 0;margin-bottom: 10px;text-align: center; color: #616161;">Legend</h3>
                            <?php foreach ($legend as $key => $value) { ?>
                                <label><b><?php echo $key; ?></b><br><?php echo $value; ?></label><hr>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="clear"></div>
                    <div class="form-actions">
                        <input type="submit" id="save_changes" value="<?php echo osc_esc_html(__("Save changes", 'reminder')); ?>" class="btn btn-submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>