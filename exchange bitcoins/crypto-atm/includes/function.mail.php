<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function EmailSys_NewExchangeOrder($id) {
	global $db, $settings, $smtpconf;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = $smtpconf["host"];
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = $smtpconf["port"];
	//Whether to use SMTP authentication
	$mail->SMTPAuth = $smtpconf['SMTPAuth'];
	//Username to use for SMTP authentication
	$mail->Username = $smtpconf["user"];
	//Password to use for SMTP authentication
	$mail->Password = $smtpconf["pass"];
	//Set who the message is to be sent from
	$mail->setFrom($settings['infoemail'], $settings['name']);
	//Set who the message is to be sent to
	$mail->addAddress(exchangeinfo($id,"u_field_1"), exchangeinfo($id,"u_field_1"));
	//Set the subject line
	$mail->Subject = 'Order #'.exchangeinfo($id,"exchange_id").' Received';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$email_template = file_get_contents($settings['url']."templates/Email_Templates/NewExchangeOrder.tpl");
	$email_template = str_ireplace("{@site_name}",$settings['name'],$email_template);
	$email_template = str_ireplace("{@url}",$settings['url'],$email_template);
	$email_template = str_ireplace("{@exchange_id}",exchangeinfo($id,"exchange_id"),$email_template);
	$email_template = str_ireplace("{@email}",exchangeinfo($id,"u_field_1"),$email_template);
	$email_template = str_ireplace("{@from}",gatewayinfo(exchangeinfo($id,"gateway_send"),"name"),$email_template);
	$email_template = str_ireplace("{@from_c}",gatewayinfo(exchangeinfo($id,"gateway_send"),"currency"),$email_template);
	$email_template = str_ireplace("{@to}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"name"),$email_template);
	$email_template = str_ireplace("{@to_c}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"currency"),$email_template);
	$email_template = str_ireplace("{@amount_s}",exchangeinfo($id,"amount_send"),$email_template);
	$email_template = str_ireplace("{@amount_r}",exchangeinfo($id,"amount_receive"),$email_template);
	$mail->msgHTML($email_template);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Order #'.exchangeinfo($id,"exchange_id").' Received';
	//Attach an image file
	//send the message, check for errors
	$mail->send();
}

function EmailSys_PaymentReceived($id) {
	global $db, $settings, $smtpconf;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = $smtpconf["host"];
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = $smtpconf["port"];
	//Whether to use SMTP authentication
	$mail->SMTPAuth = $smtpconf['SMTPAuth'];
	//Username to use for SMTP authentication
	$mail->Username = $smtpconf["user"];
	//Password to use for SMTP authentication
	$mail->Password = $smtpconf["pass"];
	//Set who the message is to be sent from
	$mail->setFrom($settings['infoemail'], $settings['name']);
	//Set who the message is to be sent to
	$mail->addAddress(exchangeinfo($id,"u_field_1"), exchangeinfo($id,"u_field_1"));
	//Set the subject line
	$mail->Subject = 'Payment received for order #'.exchangeinfo($id,"exchange_id");
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$email_template = file_get_contents($settings['url']."templates/Email_Templates/PaymentReceived.tpl");
	$email_template = str_ireplace("{@site_name}",$settings['name'],$email_template);
	$email_template = str_ireplace("{@url}",$settings['url'],$email_template);
	$email_template = str_ireplace("{@exchange_id}",exchangeinfo($id,"exchange_id"),$email_template);
	$email_template = str_ireplace("{@email}",exchangeinfo($id,"u_field_1"),$email_template);
	$email_template = str_ireplace("{@from}",gatewayinfo(exchangeinfo($id,"gateway_send"),"name"),$email_template);
	$email_template = str_ireplace("{@from_c}",gatewayinfo(exchangeinfo($id,"gateway_send"),"currency"),$email_template);
	$email_template = str_ireplace("{@to}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"name"),$email_template);
	$email_template = str_ireplace("{@to_c}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"currency"),$email_template);
	$email_template = str_ireplace("{@amount_s}",exchangeinfo($id,"amount_send"),$email_template);
	$email_template = str_ireplace("{@amount_r}",exchangeinfo($id,"amount_receive"),$email_template);
	$mail->msgHTML($email_template);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Payment received for order #'.exchangeinfo($id,"exchange_id");
	//Attach an image file
	//send the message, check for errors
	$mail->send();
}

function EmailSys_ExchangeCompleted($id) {
	global $db, $settings, $smtpconf;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = $smtpconf["host"];
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = $smtpconf["port"];
	//Whether to use SMTP authentication
	$mail->SMTPAuth = $smtpconf['SMTPAuth'];
	//Username to use for SMTP authentication
	$mail->Username = $smtpconf["user"];
	//Password to use for SMTP authentication
	$mail->Password = $smtpconf["pass"];
	//Set who the message is to be sent from
	$mail->setFrom($settings['infoemail'], $settings['name']);
	//Set who the message is to be sent to
	$mail->addAddress(exchangeinfo($id,"u_field_1"), exchangeinfo($id,"u_field_1"));
	//Set the subject line
	$mail->Subject = 'Exchange #'.exchangeinfo($id,"exchange_id").' Completed';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$email_template = file_get_contents($settings['url']."templates/Email_Templates/ExchangeCompleted.tpl");
	$email_template = str_ireplace("{@site_name}",$settings['name'],$email_template);
	$email_template = str_ireplace("{@url}",$settings['url'],$email_template);
	$email_template = str_ireplace("{@exchange_id}",exchangeinfo($id,"exchange_id"),$email_template);
	$email_template = str_ireplace("{@email}",exchangeinfo($id,"u_field_1"),$email_template);
	$email_template = str_ireplace("{@gateway}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"name"),$email_template);
	$email_template = str_ireplace("{@account}",exchangeinfo($id,"u_field_2"),$email_template);
	$email_template = str_ireplace("{@currency}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"currency"),$email_template);
	$email_template = str_ireplace("{@amount}",exchangeinfo($id,"amount_receive"),$email_template);
	$mail->msgHTML($email_template);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Exchange #'.exchangeinfo($id,"exchange_id").' Completed';
	//Attach an image file
	//send the message, check for errors
	$mail->send();
}

function EmailSys_ExchangeCanceled($id) {
	global $db, $settings, $smtpconf;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = $smtpconf["host"];
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = $smtpconf["port"];
	//Whether to use SMTP authentication
	$mail->SMTPAuth = $smtpconf['SMTPAuth'];
	//Username to use for SMTP authentication
	$mail->Username = $smtpconf["user"];
	//Password to use for SMTP authentication
	$mail->Password = $smtpconf["pass"];
	//Set who the message is to be sent from
	$mail->setFrom($settings['infoemail'], $settings['name']);
	//Set who the message is to be sent to
	$mail->addAddress(exchangeinfo($id,"u_field_1"), exchangeinfo($id,"u_field_1"));
	//Set the subject line
	$mail->Subject = 'Exchange #'.exchangeinfo($id,"exchange_id").' Canceled';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$email_template = file_get_contents($settings['url']."templates/Email_Templates/ExchangeCanceled.tpl");
	$email_template = str_ireplace("{@site_name}",$settings['name'],$email_template);
	$email_template = str_ireplace("{@url}",$settings['url'],$email_template);
	$email_template = str_ireplace("{@exchange_id}",exchangeinfo($id,"exchange_id"),$email_template);
	$email_template = str_ireplace("{@email}",exchangeinfo($id,"u_field_1"),$email_template);
	$email_template = str_ireplace("{@supportemail}",$settings['supportemail'],$email_template);
	$email_template = str_ireplace("{@gateway}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"name"),$email_template);
	$email_template = str_ireplace("{@account}",exchangeinfo($id,"u_field_2"),$email_template);
	$email_template = str_ireplace("{@currency}",gatewayinfo(exchangeinfo($id,"gateway_receive"),"currency"),$email_template);
	$email_template = str_ireplace("{@amount}",exchangeinfo($id,"amount_receive"),$email_template);
	$mail->msgHTML($email_template);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Exchange #'.exchangeinfo($id,"exchange_id").' Canceled';
	//Attach an image file
	//send the message, check for errors
	$mail->send();
}

function EmailSys_PasswordReset($id) {
	global $db, $settings, $smtpconf;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = $smtpconf["host"];
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = $smtpconf["port"];
	//Whether to use SMTP authentication
	$mail->SMTPAuth = $smtpconf['SMTPAuth'];
	//Username to use for SMTP authentication
	$mail->Username = $smtpconf["user"];
	//Password to use for SMTP authentication
	$mail->Password = $smtpconf["pass"];
	//Set who the message is to be sent from
	$mail->setFrom($settings['infoemail'], $settings['name']);
	//Set who the message is to be sent to
	$mail->addAddress(idinfo($id,"email"), idinfo($id,"email"));
	//Set the subject line
	$mail->Subject = 'Password Change Request';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$email_template = file_get_contents($settings['url']."templates/Email_Templates/PasswordReset.tpl");
	$email_template = str_ireplace("{@site_name}",$settings['name'],$email_template);
	$email_template = str_ireplace("{@url}",$settings['url'],$email_template);
	$email_template = str_ireplace("{@email}",idinfo($id,"email"),$email_template);
	$email_template = str_ireplace("{@username}",idinfo($id,"username"),$email_template);
	$email_template = str_ireplace("{@hash}",idinfo($id,"password_recovery"),$email_template);
	$mail->msgHTML($email_template);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Password Change Request';
	//Attach an image file
	//send the message, check for errors
	$mail->send();
}

function EmailSys_EmailVerification($id) {
	global $db, $settings, $smtpconf;
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = $smtpconf["host"];
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = $smtpconf["port"];
	//Whether to use SMTP authentication
	$mail->SMTPAuth = $smtpconf['SMTPAuth'];
	//Username to use for SMTP authentication
	$mail->Username = $smtpconf["user"];
	//Password to use for SMTP authentication
	$mail->Password = $smtpconf["pass"];
	//Set who the message is to be sent from
	$mail->setFrom($settings['infoemail'], $settings['name']);
	//Set who the message is to be sent to
	$mail->addAddress(idinfo($id,"email"), idinfo($id,"email"));
	//Set the subject line
	$mail->Subject = 'Email Verification';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$email_template = file_get_contents($settings['url']."templates/Email_Templates/EmailVerification.tpl");
	$email_template = str_ireplace("{@site_name}",$settings['name'],$email_template);
	$email_template = str_ireplace("{@url}",$settings['url'],$email_template);
	$email_template = str_ireplace("{@email}",idinfo($id,"email"),$email_template);
	$email_template = str_ireplace("{@username}",idinfo($id,"username"),$email_template);
	$email_template = str_ireplace("{@hash}",idinfo($id,"email_hash"),$email_template);
	$mail->msgHTML($email_template);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Email Verification';
	//Attach an image file
	//send the message, check for errors
	$mail->send();
}
?>