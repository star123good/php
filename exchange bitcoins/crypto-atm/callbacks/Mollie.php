<?php
error_reporting(0);
try {
	/*
	* Initialize the Mollie API library with your API key.
	*
	* See: https://www.mollie.com/beheer/account/profielen/
	*/
	$select = $db->query("SELECT * FROM easyex_gateways WHERE name='Mollie'");
	if($select->num_rows>0) {
		$row = $select->fetch_assoc();
		require_once "../includes/Mollie/API/Autoloader.php";
		$mollie = new Mollie_API_Client;
		$mollie->setApiKey($row["a_field_1"]);

		/*
		* Check if this is a test request by Mollie
		*/
		if (!empty($_GET['testByMollie']))
		{
			die('OK');
		}

		/*
		* Retrieve the payment's current state.
		*/
		$payment  = $mollie->payments->get($_POST["id"]);
		$order_id = $payment->metadata->order_id;


		if ($payment->isPaid() == TRUE)	{
			$query = $db->query("SELECT * FROM easyex_exchanges WHERE id='$order_id'");
				if($query->num_rows>0) {
				$row = $query->fetch_assoc();
				$time = time();
				$insert = $db->query("INSERT easyex_eactivity (exchange_id,activity_id,additional_information,time) VALUES ('$row[exchange_id]','2','$txn_id','$time')");
				$update = $db->query("UPDATE easyex_exchanges SET status='2',transaction_id='$txn_id',updated='$time' WHERE id='$row[id]'");
				EmailSys_PaymentReceived($row['id']);
			}
		}
		elseif ($payment->isOpen() == FALSE)
		{
			/*
			* The payment isn't paid and isn't open anymore. We can assume it was aborted.
			*/
		}
	}
}
catch (Mollie_API_Exception $e)
{
	echo "API call failed: " . htmlspecialchars($e->getMessage());
}
?>