    <div class="reminder-manage-menu">
        <ul>
            <li class="<?php echo (osc_reminder_is_settings_page()) ? 'active' : ''; ?>">
                <a href="<?php echo (osc_reminder_is_settings_page()) ? '#' : osc_route_admin_url('reminder-manage'); ?>"><?php _e('Manage reminders', 'reminder'); ?></a>
            </li>

            <li class="<?php echo (osc_reminder_is_add_reminder_page()) ? 'active' : ''; ?>">
                <a href="<?php echo (osc_reminder_is_add_reminder_page()) ? '#' : osc_route_admin_url('reminder-add'); ?>"><?php _e('Add reminder', 'reminder'); ?></a>
            </li>

            <li class="<?php echo (osc_reminder_is_add_reminder_stats_page()) ? 'active' : ''; ?>">
                <a href="<?php echo (osc_reminder_is_add_reminder_stats_page()) ? '#' : osc_route_admin_url('reminder-add-stats'); ?>"><?php _e('Add stats reminder', 'reminder'); ?></a>
            </li>

            <li class="<?php echo (osc_reminder_is_add_reminder_conf_page()) ? 'active' : ''; ?>">
                <a href="<?php echo (osc_reminder_is_add_reminder_conf_page()) ? '#' : osc_route_admin_url('reminder-conf'); ?>"><?php _e('Configuration', 'reminder'); ?></a>
            </li>

            <li class="<?php echo (osc_reminder_is_reminder_stats_page()) ? 'active' : ''; ?>">
                <a href="<?php echo (osc_reminder_is_reminder_stats_page()) ? '#' : osc_route_admin_url('reminder-stats'); ?>"><?php _e('Stats', 'reminder'); ?></a>
            </li>

        </ul>
    </div>