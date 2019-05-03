<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$id = protect($_GET['exchange_id']);
if(!checkExchange($id)) {
	header("Location: $settings[url]");
}

$tpl = new Template("templates/".$settings['default_template']."/track.tpl",$lang);
$tpl->set("url",$settings['url']);
$tpl->set("exchange_id",$id);
$tpl->set("gateway_send",gatewayinfo(einfo($id,"gateway_send"),"name"));
$tpl->set("gateway_send_currency",gatewayinfo(einfo($id,"gateway_send"),"currency"));
$tpl->set("gateway_send_icon",gatewayicon(gatewayinfo(einfo($id,"gateway_send"),"name")));
$tpl->set("gateway_receive",gatewayinfo(einfo($id,"gateway_receive"),"name"));
$tpl->set("gateway_receive_currency",gatewayinfo(einfo($id,"gateway_receive"),"currency"));	
$tpl->set("gateway_receive_icon",gatewayicon(gatewayinfo(einfo($id,"gateway_receive"),"name")));
if(gatewayinfo(einfo($id,"gateway_receive"),"is_crypto") == "1") {
	$tpl->set("acc_type","address");
	$tpl->set("u_acc",einfo($id,"u_field_2"));
} else { 
	$tpl->set("acc_type","account");
	$tpl->set("u_acc",einfo($id,"u_field_2"));
}
$tpl->set("amount_send",einfo($id,"amount_send"));
$tpl->set("amount_receive",einfo($id,"amount_receive"));
$tpl->set("created_on",date("d/m/Y H:i",einfo($id,"created")));
if(einfo($id,"updated")>0) {
	$updated_on = '<tr>
						<td>'.$lang[updated_on].':</td>
						<td><span class="pull-right">'.date("d/m/Y H:i",einfo($id,"updated")).'</span></td>
				</tr>';
} else {
	$updated_on = '';
}
$tpl->set("updated_on",$updated_on);
if(einfo($id,"expired")>0) {
	$expired_on = '<tr>
						<td>'.$lang[expired_on].':</td>
						<td><span class="pull-right">'.date("d/m/Y H:i",einfo($id,"expired")).'</span></td>
				</tr>';
} else {
	$expired_on = '';
}
$tpl->set("expired_on",$expired_on);
$tpl->set("status",getStatus(einfo($id,"status"),1));
$activity_query = $db->query("SELECT * FROM easyex_eactivity WHERE exchange_id='$id' ORDER BY id");
if($activity_query->num_rows>0) {
	while($act = $activity_query->fetch_assoc()) {
		$activity .= '<tr>
						<td>'.date("d/m/Y H:i",$act[time]).'</td>
						<td>'.decodeEActivity($act[activity_id],$act[additional_information]).'</td>
					</tr>';
	}
} else {
	$activity = '<tr><td colspan="2">n/a</td></tr>';
}
$tpl->set("activity",$activity);
echo $tpl->output();
?>