<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$prefix = protect($_GET['prefix']);
if($prefix == "contacts") {
	$tpl = new Template("templates/".$settings['default_template']."/contacts.tpl",$lang);
	$tpl->set("url",$settings['url']);
	if(isset($_POST['eex_submit'])) {
		$fname = protect($_POST['fname']);
		$lname = protect($_POST['lname']);
		$subject = protect($_POST['subject']);
		$email = protect($_POST['email']);
		$message = protect($_POST['message']);
		if(empty($fname) or empty($lname) or empty($subject) or empty($email) or empty($message)) { $results = error($lang['error_1']); }
		elseif(!isValidEmail($email)) { $results = error($lang['error_23']); }
		else {
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
			$mail->setFrom($email, $fname.' '.$lname);
			//Set who the message is to be sent to
			$mail->addAddress($settings['supportemail'], $settings['supportemail']);
			//Set the subject line
			$mail->Subject = '['.$settings[name].' Contact form] '.$subject;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			//Replace the plain text body with one created manually
			$mail->AltBody = '['.$settings[name].' Contact form] '.$subject;
			//Attach an image file
			//send the message, check for errors
			$send = $mail->send();
			if($send) {
				$results = success($lang['success_14']); 
			} else {
				$results = error($lang['error_31']);
			}
		}
	} else {
		$results = '';
	}
	$tpl->set("results",$results);
	echo $tpl->output();
} elseif($prefix == "faq") {
	$tpl = new Template("templates/".$settings['default_template']."/faq.tpl",$lang);
	$tpl->set("url",$settings['url']);
	$getFaq = $db->query("SELECT * FROM easyex_faq ORDER BY id");
	$rows = '';
	if($getFaq->num_rows>0) {
		while($get = $getFaq->fetch_assoc()) {
			$row = new Template("templates/".$settings['default_template']."/faq_row.tpl",$lang);
			$row->set("id",$get['id']);
			$row->set("question",$get['question']);
			$row->set("answer",$get['answer']);
			$rows .= $row->output();
		}
	}
	$tpl->set("faq_rows",$rows);
	echo $tpl->output();
} else {
	$getPage = $db->query("SELECT * FROM easyex_pages WHERE prefix='$prefix'");
	if($getPage->num_rows>0) {
		$row = $getPage->fetch_assoc();
		$tpl = new Template("templates/".$settings['default_template']."/page.tpl",$lang);
		$tpl->set("url",$settings['url']);
		$tpl->set("page_title",$row['title']);
		$tpl->set("page_content",$row['content']);
		echo $tpl->output();
	} else {
		$redirect = $settings['url'];
		header("Location: $redirect");
	}
}
?>