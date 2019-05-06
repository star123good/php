<?php
define('EASYEX_INSTALLED',TRUE);
ob_start();
session_start();
error_reporting(0);
include("../configs/bootstrap.php");
include("../includes/bootstrap.php");
include(getLanguage($settings['url'],null,2));
$gateway_id = protect($_GET['gateway_id']);
$gateway = protect($_GET['gateway']);
$currency = protect($_GET['currency']);
$address = protect($_GET['address']);
$amount = protect($_GET['amount']);
$source = protect($_GET['source']);
$exchange_id = protect($_GET['exchange_id']);
if(empty($exchange_id) or empty($gateway_id) or empty($gateway) or empty($currency) or empty($address) or empty($amount) or empty($source)) {
	$data['status'] = 'error';
	$data['msg'] = $lang['error_12'];
} else {
	if($source == "block.io") {
		$blockio_api_key = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_1");
		$blockio_secret = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_2");	
		$option = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_3");
		if($option == "1") {
			$address = gatewayinfo(einfo($exchange_id,"gateway_send"),"a_field_4");
			$apiKey = $blockio_api_key;
			$pin = $blockio_secret;
			$version = 2; // the API version
			$block_io = new BlockIo($apiKey, $pin, $version);
			$transactions = $block_io->get_transactions(array('type' => 'received', 'addresses' => $address));
			$tx = $transactions->data->txs;
			$tx = json_decode(json_encode($tx), true);
			$searched_amount = einfo($exchange_id,"amount_send");
			$before_confirms = '5';
			$famount = '';
			$ftxid = '';
			$fconfs = '';
			foreach($tx as $k => $v) {
				$txs['id'] = $k;
				foreach($v as $a => $b) {
					$txs[$k][$a] = $b;
					if($a == 'amounts_received') {
						foreach($b[0] as $c => $d) {
							$txs[$k][$c] = $d;
							if($c == "amount") {
								if($d == $searched_amount) {
									$famount = $d;
									$ftxid = $txs[$k]['txid'];
									$fconfs = $txs[$k]['confirmations'];
								}
							}
						}	
					}
				}
			}
			if(!empty($famount) && !empty($ftxid)) {
				if($fconfs < $before_confirms) {
					//echo 'Transaction found!<br/>TXID: '.$ftxid.'<br/>Amount: '.$famount.'<br/>Confirmations: '.$fconfs;
					$data['status'] = 'success';
					$data['msg'] = $lang['success_8'];
					$data['content'] = '<div class="alert alert-success">
						<h2><i class="fa fa-check"></i> '.$lang[payment_success_content_1].'</h2>
						'.$lang[payment_success_content_2].'
					</div>
					<center>
					'.$lang[payment_success_content_3].': <a href="'.$settings[url].'track/'.$exchange_id.'">'.$settings[url].'track/'.$exchange_id.'</a>
					</center>';
					$time = time();
					$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$exchange_id','2','$ftxid','$time')");
					$update = $db->query("UPDATE easyex_exchanges SET status='2',updated='$time',transaction_id='$ftxid' WHERE exchange_id='$exchange_id'");
					$update = $db->query("UPDATE easyex_edata SET num=num+$famount WHERE exchange_id='$exchange_id'");
				}
			}
		} elseif($option == "2") {
			$address = einfo($exchange_id,"u_field_10");
			$apiKey = $blockio_api_key;
			$pin = $blockio_secret;
			$version = 2; // the API version
			$block_io = new BlockIo($apiKey, $pin, $version);
			$transactions = $block_io->get_transactions(array('type' => 'received', 'addresses' => $address));
			$tx = $transactions->data->txs;
			$tx = $tx[0];
			$txid = $tx->txid;
			$amount = $tx->amounts_received;
			$amount = $amount[0];
			$amount = $amount->amount;
			if(einfo($exchange_id,"amount_send") == $amount) {
				$data['status'] = 'success';
				$data['msg'] = $lang['success_8'];
				$data['content'] = '<div class="alert alert-success">
					<h2><i class="fa fa-check"></i> '.$lang[payment_success_content_1].'</h2>
					'.$lang[payment_success_content_2].'
				</div>
				<center>
				'.$lang[payment_success_content_3].': <a href="'.$settings[url].'track/'.$exchange_id.'">'.$settings[url].'track/'.$exchange_id.'</a>
				</center>';
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$exchange_id','2','$txid','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',updated='$time',transaction_id='$txid' WHERE exchange_id='$exchange_id'");
				$update = $db->query("UPDATE easyex_edata SET num=num+$amount WHERE exchange_id='$exchange_id'");
			} else {
				$data['status'] = 'error';
				$data['msg'] = $lang[amount_does_not_match].' '.$lang[requested_amount].': '.einfo($exchange_id,"amount_send").'. '.$lang[you_are_send].': '.$amount;
			}
		} else {
			$data['status'] = 'error';
			$data['msg'] = $lang['error_13']; 
		}
	} elseif($source == "coinpayments.net") {
	
	} else {
		$data['status'] = 'error';
		$data['msg'] = $lang['error_14'];
	}
}
echo json_encode($data);
?>