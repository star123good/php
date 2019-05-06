<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function EasyExCalculator($from,$to,$amount) {
	global $db;
	$rt = get_rates($from,$to);
	if($rt['status'] == "error") {
		$rate_from = 0;
		$rate_to = 0;
	} else {
		$rate_from = $rt['rate_from'];
		$rate_to = $rt['rate_to'];
	}
	if(is_numeric($amount)) {
		if(gatewayinfo($from,"is_crypto") == "1" && gatewayinfo($to,"is_crypto") == "1") {
			if($rate_from<1) {
				$calculate = $amount / $rate_from;
				$converted = number_format($calculate,8,'.','');
			} else {
				$calculate = $amount * $rate_to;
				$converted = number_format($calculate,8,'.','');
			}
		} elseif(gatewayinfo($to,"is_crypto") == "1") {
			$calculate = $amount / $rate_from;
			$converted = number_format($calculate,8,'.','');
		} elseif($rate_from>1) {
			$calculate = $amount / $rate_from;
			$converted = number_format($calculate,2,'.','');
		} else { 	
			$calculate = $amount * $rate_to;
			$converted = number_format($calculate,2,'.','');
		}
	} else {	
		$converted = 0;
	}
	return $converted;
}

function check_unpayed() {
	global $db;
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE status='1' ORDER BY id");
	if($query->num_rows>0) {
		while($row = $query->fetch_assoc()) {
			$time = $row['created']+86400;
			if(time() > $time) {
				$time = time();
				$update = $db->query("UPDATE easyex_exchanges SET status='5',expired='$time' WHERE id='$row[id]'");
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,time) VALUES ('$row[exchange_id]','5','$time')");
			}
		}
	} 
}

function exchangeinfo($eid,$value) {
	global $db;
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$eid'");
	$row = $query->fetch_assoc();
	return $row[$value];
}

function einfo($eid,$value) {
	global $db;
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE exchange_id='$eid'");
	$row = $query->fetch_assoc();
	return $row[$value];
}	

function checkExchange($id) {
	global $db;
	if(einfo($id,"id")) {
		return true;
	} else {
		return false;
	}
}

function getStatus($status,$style) {
	global $db, $settings, $lang;
	if($status == "1") { $text = $lang['status_1']; $class = 'info'; $icon = 'fa fa-clock-o'; }
	elseif($status == "2") { $text = $lang['status_2']; $class = 'info'; $icon = 'fa fa-arrow-down'; }
	elseif($status == "3") { $text = $lang['status_3']; $class = 'primary'; $icon = 'fa fa-arrow-up'; } 
	elseif($status == "4") { $text = $lang['status_4']; $class = 'success'; $icon = 'fa fa-check'; }
	elseif($status == "5") { $text = $lang['status_5']; $class = 'danger'; $icon = 'fa fa-times'; }
	elseif($status == "6") { $text = $lang['status_6']; $class = 'danger'; $icon = 'fa fa-times'; }
	elseif($status == "7") { $text = $lang['status_7']; $class = 'danger'; $icon = 'fa fa-times'; }
	else { $text = 'Unknown'; $class = 'default'; }
	if($style == "1") {
		$status = '<span class="label label-'.$class.'">'.$text.'</span>';
	} else {
		$status = '<span class="text text-'.$class.'"><i class="'.$icon.'"></i> '.$text.'</span>';
	}
	return $status;
}

function decodeEActivity($activity_id,$additional_information) {
	global $db, $settings, $lang;
	if($activity_id == "1") { $message = $lang['activity_1']; }
	elseif($activity_id == "2") { $message = $lang[activity_2].' '.$additional_information; }
	elseif($activity_id == "3") { $message = $lang[activity_3].' '.$additional_information; }
	elseif($activity_id == "4") { $message = $lang['activity_4']; }
	elseif($activity_id == "5") { $message = $lang['activity_5']; }
	elseif($activity_id == "6") { $message = $lang['activity_6']; }
	elseif($activity_id == "7") { $message = $lang['activity_7']; }
	elseif($activity_id == "8") { $message = $lang['activity_8']; }
	elseif($activity_id == "9") { $message = $lang['activity_9']; }
	else { $message = 'Unknown activity.'; }
	return $message;
}
?>