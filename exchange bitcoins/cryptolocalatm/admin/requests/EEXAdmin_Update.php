<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../../configs/bootstrap.php");
include("../../includes/bootstrap.php");
//include(getLanguage($settings['url'],null,2));
$module = protect($_GET['module']);
$id = protect($_GET['id']);

if($module == "UpdateCompleted") {
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		?>
		<div class="alert alert-info">
			<h3>Are you sure you made all things to complete exchange?</h3>
			<br/>
			Things before complete:<br/>
			- Verify client payment<br/>
			- Verify client data<br/>
			- Make payment to client and enter transaction id in field below<br/>
		</div>
		<?php
		$receive = gatewayinfo($row['gateway_receive'],"name");
			$receive_is_crypto = gatewayinfo($row['gateway_receive'],"is_crypto");
							if($receive == "Bank Transfer") {
								$account_data = '<tr>
													<td><span class="pull-left">Client name</span></td>
													<td><span class="pull-right">'.$row[u_field_2].'</span></td>
											</tr><tr>
													<td><span class="pull-left">Client location</span></td>
													<td><span class="pull-right">'.$row[u_field_3].'</span></td>
											</tr><tr>
													<td><span class="pull-left">Client bank name</span></td>
													<td><span class="pull-right">'.$row[u_field_4].'</span></td>
											</tr><tr>
													<td><span class="pull-left">Client bank account number/iban</span></td>
													<td><span class="pull-right">'.$row[u_field_5].'</span></td>
											</tr><tr>
													<td><span class="pull-left">Client bank swift code</span></td>
													<td><span class="pull-right">'.$row[u_field_6].'</span></td>
											</tr>';
							} elseif($receive == "Western Union" or $receive == "Moneygram") {
								$account_data = '<tr>
													<td><span class="pull-left">Client name</span></td>
													<td><span class="pull-right">'.$row[u_field_2].'</span></td>
											</tr><tr>
													<td><span class="pull-left">Client location</span></td>
													<td><span class="pull-right">'.$row[u_field_3].'</span></td>
											</tr>';
							} elseif($receive_is_crypto == "1") {
								$account_data = '<tr>
													<td><span class="pull-left">Client '.$receive.' address</span></td>
													<td><span class="pull-right">'.$row[u_field_2].'</span></td>
											</tr>';
							} else {
								$account_data = '';
		$check = $db->query("SELECT * FROM easyex_gateways WHERE name='$receive' and external_gateway='1'");
		if($check->num_rows>0) {
			$r = $check->fetch_assoc();
			$fieldsquery = $db->query("SELECT * FROM easyex_gateways_fields WHERE gateway_id='$r[id]' ORDER BY id");
			if($fieldsquery->num_rows>0) {
				while($field = $fieldsquery->fetch_assoc()) {
					$field_number = $field['field_number']+1;
					$fild = 'u_field_'.$field_number;
					$ret = $row[$fild];
					$account_data .= '<tr>
							<td><span class="pull-left">'.$field[field_name].'</span></td>
							<td><span class="pull-right">'.$ret.'</span></td>
					</tr>';
				}
			}
		} else {
		$account_data = '<tr>
							<td><span class="pull-left">Client '.$receive.' account</span></td>
							<td><span class="pull-right">'.$row[u_field_2].'</span></td>
					</tr>';
		}
							}
							?>
							<table class="table table-striped">
							<tbody>
							<tr>
								<td colspan="2"><b>Send <?php echo $row[amount_receive].' '.gatewayinfo($row['gateway_receive'],"currency"); ?> to following user data:</b></td>
							</tr>
							<?php echo $account_data; ?>
							</tbody>
							</table>
		<div id="txn_id_formgroup" class="form-group">
			<label>Transaction ID/BATCH/NUMBER</label>
			<input type="text" id="txn_id" class="form-control">
		</div>
		<button type="button" class="btn btn-success" onclick="EEXAdmin_UpdateCompleted(<?php echo $row['id']; ?>,2);">Complete</button>
		<?php
	} else {
		echo error("Can not find this exchange request.");
	}
} elseif($module == "UpdateCompletedConfirmed") {
	$txn_id = protect($_GET['txn_id']);
	$time = time();
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		if($row['status'] == "4") {
			echo error("The exchange is already completed.");
		} else {
			$processed_by = $_SESSION['eex_admin_uid'];
			$update = $db->query("UPDATE easyex_gateways SET reserve=reserve-$row[amount_receive] WHERE id='$row[gateway_receive]'");
			$update = $db->query("UPDATE easyex_exchanges SET status='4',updated='$time',processed_by='$processed_by' WHERE id='$id'");
			$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','3','$txn_id','$time')");
			$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','4','','$time')");
			echo success("Exchange #$row[exchange_id] was completed. User was notified by email.");
			EmailSys_ExchangeCompleted($row['id']);
		}
	} else {
		echo error("Can not find this exchange request.");
	}
} elseif($module == "UpdateCanceled") {
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		?>
		<div class="alert alert-info">
			<h5>Are you sure you want to cancel exchange #<?php echo $row['exchange_id']; ?>?</h5>
		</div>
		<button type="button" class="btn btn-success" onclick="EEXAdmin_UpdateCanceled(<?php echo $row['id']; ?>,2);">Yes</button> <button type="button" class="btn btn-danger" onclick="EEXAdmin_UpdateCanceled(<?php echo $row['id']; ?>,3);"">No</button>
		<?php
	} else {
		echo error("Can not find this exchange request.");
	}
} elseif($module == "UpdateCanceledConfirmed") {
	$time = time();
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		if($row['status'] == "6") {
			echo error("The exchange is already canceled.");
		} else {
			$update = $db->query("UPDATE easyex_exchanges SET status='6',updated='$time' WHERE id='$id'");
			$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','7','','$time')");
			echo success("Exchange #$row[exchange_id] was canceled. User was notified by email.");
			EmailSys_ExchangeCanceled($row['id']);
		}
	} else {
		echo error("Can not find this exchange request.");
	}
} else {
	echo error("Unknown module request.");
}
?>