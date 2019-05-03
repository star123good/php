<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
$gateway_send = protect($_GET['gateway_send']);
$gateway_send = (int)$gateway_send;
$gateway_receive = protect($_GET['gateway_receive']);
$gateway_receive = (int)$gateway_receive;
$receive = gatewayinfo($gateway_receive,"name");
if(!empty($gateway_send) or !empty($gateway_receive)) {
	if(gatewayinfo($gateway_send,"name") !== NULL or gatewayinfo($gateway_receive,"name") !== NULL) {
		$FormTemplate = new Template("../templates/".$settings['default_template']."/homepage/ExchangeAccount_Layout.tpl",$lang);
		$fields = array();
		$field = array();
		$field['field_text'] = $lang['field_11'];
		$field['field_name'] = 'u_field_1';
		$field['field_value'] = '';
		$fields[] = $field;
		if(gatewayinfo($gateway_receive,"name") == "Bank Transfer") {
			$fld = array();
			$fld['field_text'] = $lang['field_12'];
			$fld['field_name'] = 'u_field_2'; 
			$fld['field_value'] = '';
			$fields[] = $fld;
			$fld2 = array();
			$fld2['field_text'] = $lang['field_13'];
			$fld2['field_name'] = 'u_field_3'; 
			$fld2['field_value'] = '';
			$fields[] = $fld2;
			$fld3 = array();
			$fld3['field_text'] = $lang['field_14'];
			$fld3['field_name'] = 'u_field_4'; 
			$fld3['field_value'] = '';
			$fields[] = $fld3;
			$fld4 = array();
			$fld4['field_text'] = $lang['field_15'];
			$fld4['field_name'] = 'u_field_5'; 
			$fld4['field_value'] = '';
			$fields[] = $fld4;
			$fld5 = array();
			$fld5['field_text'] = $lang['field_16'];
			$fld5['field_name'] = 'u_field_6'; 
			$fld5['field_value'] = '';
			$fields[] = $fld5;
		} elseif(gatewayinfo($gateway_receive,"name") == "Moneygram" or gatewayinfo($gateway_receive,"name") == "Western Union") {
			$fld = array();
			$fld['field_text'] = $lang['field_12'];
			$fld['field_name'] = 'u_field_2'; 
			$fld['field_value'] = '';
			$fields[] = $fld;
			$fld2 = array();
			$fld2['field_text'] = $lang['field_13'];
			$fld2['field_name'] = 'u_field_3'; 
			$fld2['field_value'] = '';
			$fields[] = $fld2;
		} elseif(gatewayinfo($gateway_receive,"is_crypto") == "1") {
			$fld = array();
			$fld['field_text'] = $lang[your].' '.gatewayinfo($gateway_receive,"name").' '.$lang[address];
			$fld['field_name'] = 'u_field_2'; 
			$fld['field_value'] = '';
			$fields[] = $fld;
		} else {
			$check = $db->query("SELECT * FROM easyex_gateways WHERE name='$receive' and external_gateway='1'");
			if($check->num_rows>0) {
				$r = $check->fetch_assoc();
				$fieldsquery = $db->query("SELECT * FROM easyex_gateways_fields WHERE gateway_id='$r[id]' ORDER BY id");
				if($fieldsquery->num_rows>0) {
					while($field = $fieldsquery->fetch_assoc()) {	
						$field_number = $field['field_number']+1;
						$fld = array();
						$fld['field_text'] = $field[field_name];
						$fld['field_name'] = 'u_field_'.$field_number; 
						$fld['field_value'] = '';
						$fields[] = $fld;
					}
				}
			} else {
				$fld = array();
				$fld['field_text'] = $lang[your].' '.gatewayinfo($gateway_receive,"name").' '.$lang[account];
				$fld['field_name'] = 'u_field_2'; 
				$fld['field_value'] = '';
				$fields[] = $fld;
			}
		}
		foreach ($fields as $field) {
			$row = new Template("../templates/".$settings['default_template']."/homepage/ExchangeAccount_Field.tpl",$lang);
			
			foreach ($field as $key => $value) {
				$row->set($key, $value);
			}
			$FieldsList[] = $row;
		}
		$UserFields = Template::merge($FieldsList);
		$FormTemplate->set("UserFields",$UserFields);
		echo $FormTemplate->output();
	} else {
		echo '<div style="clear:both;"></div><div style="padding:20px;"><center>'.$lang[info_2].'</center></div>';
	}
}
?>