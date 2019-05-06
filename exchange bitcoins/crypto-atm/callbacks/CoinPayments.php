<?php
error_reporting(0);
 // Fill these in with the information from your CoinPayments.net account. 
	$gtid = protect($_GET['gtid']);
    $cp_merchant_id = gatewayinfo($gtid,"a_field_1"); 
    $cp_ipn_secret = gatewayinfo($gtid,"a_field_2"); 
    $cp_debug_email = gatewayinfo($gtid,"a_field_3"); 

    function errorAndDie($error_msg) { 
        global $cp_debug_email; 
        if (!empty($cp_debug_email)) { 
            $report = 'Error: '.$error_msg."\n\n"; 
            $report .= "POST Data\n\n"; 
            foreach ($_POST as $k => $v) { 
                $report .= "|$k| = |$v|\n"; 
            } 
            mail($cp_debug_email, 'CoinPayments IPN Error', $report); 
        } 
        die('IPN Error: '.$error_msg); 
    } 

    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') { 
        errorAndDie('IPN Mode is not HMAC'); 
    } 

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) { 
        errorAndDie('No HMAC signature sent.'); 
    } 

    $request = file_get_contents('php://input'); 
    if ($request === FALSE || empty($request)) { 
        errorAndDie('Error reading POST data'); 
    } 

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) { 
        errorAndDie('No or incorrect Merchant ID passed'); 
    } 

    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret)); 
    if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) { 
    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function 
        errorAndDie('HMAC signature does not match'); 
    } 
     
    // HMAC Signature verified at this point, load some variables. 

    $txn_id = protect($_POST['txn_id']); 
    $item_name = protect($_POST['item_name']); 
    $item_number = protect($_POST['item_number']); 
    $amount1 = floatval($_POST['amount1']); 
    $amount2 = floatval($_POST['amount2']); 
    $currency1 = protect($_POST['currency1']); 
    $currency2 = protect($_POST['currency2']); 
    $status = intval($_POST['status']); 
    $status_text = protect($_POST['status_text']); 
	 //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field. 
    $order_currency = gatewayinfo(exchangeinfo($id,"gateway_send"),"currency"); 
    $order_total = exchangeinfo($id,"amount_send"); 
    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point 

    // Check the original currency to make sure the buyer didn't change it. 
    if ($currency1 != $order_currency) { 
        errorAndDie('Original currency mismatch!'); 
    }     
     
    // Check amount against order total 
    if ($amount1 < $order_total) { 
        errorAndDie('Amount is less than order total!'); 
    } 
	
	$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$item_number'");
		$row = $query->fetch_assoc();
		
   
    if ($status >= 100 || $status == 2) { 
        // payment is complete or queued for nightly payout, success 
		$date = time();
		$insert = $db->query("INSERT easyex_transactions (transaction_id,status,gateway,amount,currency,time) VALUES ('$txn_id','completed','CoinPayments','$amount1','$currency1','$date')");
		$time = time();
		$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$txn_id','$time')");
		$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$txn_id',updated='$time' WHERE id='$item_number'");
		EmailSys_PaymentReceived($item_number);
    } else if ($status < 0) { 
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent 
		
	} else { 
        //payment is pending, you can optionally add a note to the order page 
   $insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','9','$txn_id','$time')");
		 } 
    die('IPN OK'); 
?>