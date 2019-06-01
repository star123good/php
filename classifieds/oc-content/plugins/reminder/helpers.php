<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class hReminder {
    static function _getInputFrm() {
        $return = array();
        $return['i_days']        = Params::getParam('days');
        $return['s_subject']   = Params::getParam('subject');
        $return['b_enabled']  = (Params::getParam('enabled')=='on') ? 1 : 0;
        $return['s_slug']        = Params::getParam('slug');
        $return['s_body_content'] = Params::getParam('body_content', false, false);
        return $return;
    }
}

function osc_reminder_select_start_date() { ?>
    <select name="start_date">
        <option value="08:00">08:00 </option>
        <option value="09:00">09:00 </option>
        <option value="10:00">10:00 </option>
        <option value="11:00">11:00 </option>
        <option value="12:00">12:00 </option>
        <option value="13:00">13:00 </option>
        <option value="14:00">14:00 </option>
        <option value="15:00">15:00 </option>
        <option value="16:00">16:00 </option>
        <option value="17:00">17:00 </option>
        <option value="18:00">18:00 </option>
        <option value="19:00">19:00 </option>
        <option value="20:00">20:00 </option>
        <option value="21:00">21:00 </option>
        <option value="22:00">22:00 </option>
        <option value="23:00">23:00 </option>
        <option value="00:00">00:00 </option>
        <option value="01:00">01:00 </option>
        <option value="02:00">02:00 </option>
        <option value="03:00">03:00 </option>
        <option value="04:00">04:00 </option>
        <option value="05:00">05:00 </option>
        <option value="06:00">06:00 </option>
        <option value="07:00">07:00 </option>
    </select>
<?php
}
/*
 * url helpers
 */
function osc_reminder_is_settings_page() {
    return (Params::getParam('route')=='reminder-manage');
}
function osc_reminder_is_add_reminder_page() {
    return (Params::getParam('route')=='reminder-add');
}
function osc_reminder_is_add_reminder_stats_page() {
    return (Params::getParam('route')=='reminder-add-stats');
}
function osc_reminder_is_add_reminder_conf_page() {
    return (Params::getParam('route')=='reminder-conf');
}
function osc_reminder_is_reminder_stats_page() {
    return (Params::getParam('route')=='reminder-stats');
}