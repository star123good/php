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

if($module == "explore") {
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		if($row['updated']>0) {
			$updated = '<tr>
							<td>Request was updated on:</td>
							<td><span class="pull-right">'.date("d/m/Y H:i",$row[updated]).'</span></td.
						</tr>';
			if($row['processed_by']>0) {
				$upr = $row['processed_by'];
				$updated .= '<tr>
								<td>Request was processed by:</td>
								<td><span class="pull-right">'.idinfo($upr,"username").'</span></td>
							</tr>';
			}
		} else { 
			$updated = '';
		}
		if($row['expired']>0) { 
			$expired = '<tr>
							<td>Request was expired on:</td>
							<td><span class="pull-right">'.date("d/m/Y H:i",$row[expired]).'</span></td.
						</tr>';
		} else {
			$expired = '';
		}
		if($row['status']<3) {
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
			$form = '<br><br>
					<table class="table table-striped">
						<tbody>
							<tr>
								<td colspan="2"><b>Send '.$row[amount_receive].' '.gatewayinfo($row['gateway_receive'],"currency").' to following user data:</b></td>
							</tr>
							'.$account_data.'
							<tr>
								<td colspan="2">
									<div class="form-group">
										<a href="javascript:void(0);" onclick="EEXAdmin_UpdateCompleted('.$row[id].',1);" class="btn btn-success">Mark it as completed</a> 
										<span class="pull-right"><a href="javascript:void(0);" onclick="EEXAdmin_UpdateCanceled('.$row[id].',1);" class="btn btn-danger">Cancel order</a></a>
									</div>
								</td>
							</tr>
						</tbody>	
					</table>
					';
		} else {
			$form = '';
		}
		$data['status'] = 'success';
		$data['msg'] = '<div class="modal fade" id="'.$module.'_'.$id.'_modal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="largeModalLabel">EXCHANGE #'.$row[exchange_id].'</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" id="'.$module.'_'.$id.'_modal_content">
									<table class="table table-striped">
										<tbody>
											<tr>
												<td width="50%">From gateway: <span class="pull-right">'.gatewayinfo($row[gateway_send],"name").' '.gatewayinfo($row[gateway_send],"currency").'</span></td>
												<td width="50%">To gateway: <span class="pull-right">'.gatewayinfo($row[gateway_receive],"name").' '.gatewayinfo($row[gateway_receive],"currency").'</span></td>
											</tr>
											<tr>
												<td>Amount send: <span class="pull-right">'.$row[amount_send].' '.gatewayinfo($row[gateway_send],"currency").'</span></td>
												<td>Amount receive: <span class="pull-right">'.$row[amount_receive].' '.gatewayinfo($row['gateway_receive'],"currency").'</span></td>
											</tr>
											<tr>
												<td colspan="2">Exchange rate: <span class="pull-right">'.$row[rate_from].' '.gatewayinfo($row[gateway_send],"currency").' = '.$row[rate_to].' '.gatewayinfo($row[gateway_receive],"currency").'</span></td>
											</tr>
											<tr>
												<td colspan="2">Transaction ID: <span class="pull-right">'.$row[transaction_id].'</span></td>
											</tr>
											<tr>
												<td colspan="2">Status: <span class="pull-right">'.getStatus($row[status],0).'</span></td>
											</tr>
											<tr>
												<td>Request was created on:</td>
												<td><span class="pull-right">'.date("d/m/Y H:i").'</span></td>
											</tr>
											'.$updated.'
											'.$expired.'
										</tbody>
									</table>
									
									'.$form.'
								</div>
							</div>
						</div>
					</div>';
	} else {
		$data['status'] = 'error';
		$data['msg'] = 'Can not find this exchange request.';
	}
} elseif($module == "user_exchanges") {

} else {
	$data['status'] = 'error';
	$data['msg'] = 'Unknown module request.';
}
echo json_encode($data);
?>