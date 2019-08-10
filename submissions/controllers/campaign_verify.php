<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require MAILER_PATH.'src/Exception.php';
    require MAILER_PATH.'src/PHPMailer.php';
    require MAILER_PATH.'src/SMTP.php';

    $next_url = WEB_PATH."index.php";
    

    if($type == "email_verify" && (isset($adminer_id) && $adminer_id > 0) && (isset($customer_pk_id) && $customer_pk_id > 0)){
        // adminer - email verify
        $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");
        if(count($customers) > 0){
            $customer = $customers[0];
            $mail_server = 'smtp.live.com';

            // get user email and password
            if(isset($_GET['username']) && $_GET['username'] != "" && isset($_GET['password']) && $_GET['password'] != ""){
                $usernameFrom = $_GET['username'];
                $passwordFrom = $_GET['password'];
            }
            else{
                $adminer_secret_password = select_rows($pdo, $table_admin_password, "`pk_i_id` = 1")[0];
                $usernameFrom = $adminer_secret_password['s_email'];
                $passwordFrom = $adminer_secret_password['s_email_password'];
                $mail_server = $adminer_secret_password['s_email_server'];
                // die("You must input username and password by GET parameters.");
            }

            // generate verify code
            $code = $customer['s_verify_code'];
            $to      = $customer['s_email']; // Send email to our user
            $subject = 'Signup | Verification'; // Give the email a subject 

            $message = '
            <br>
            <h5>Hello, '.$customer['s_username'].'</h5>
            <p>Thanks for signing up!</p>
            <p>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</p>
            <br>
            <p>------------------------<br>
            Username: '.$customer['s_username'].'<br>
            Password: '.$customer['s_password'].'<br>
            ------------------------</p>
            <br>
            <p>Please click this link to activate your account:<a href="'.WEB_PATH.'index.php?type=email_confirm&email='.$to.'&code='.$code.'" >Verify</a></p>
            '; // Our message above including the link
                                
            // $headers = 'From: ' . WEB_HOST . "\r\n"; // Set from headers
            $headers = 'From: ' . $usernameFrom . "\r\n"; // Set from headers
            // mail($to, $subject, $message, $headers); // Send our email



            // using PHPMailer

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = MAILER_DEBUG;                                 // Enable verbose debug output
                $mail->isSMTP();                                                    // Set mailer to use SMTP
                $mail->Host       = $mail_server;                                   // Specify main and backup SMTP servers
                $mail->SMTPAuth   = MAILER_AUTH;                                    // Enable SMTP authentication
                $mail->Username   = $usernameFrom;                                  // SMTP username
                $mail->Password   = $passwordFrom;                                  // SMTP password
                $mail->SMTPSecure = MAILER_SECURE;                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = MAILER_PORT;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($usernameFrom, WEB_HOST);
                $mail->addAddress($customer['s_email'], $customer['s_username']);     // Add a recipient
                $mail->addReplyTo($usernameFrom, 'Information');

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;
                // $mail->AltBody = $message;

                $mail->send();

                $next_url = WEB_PATH."index.php?type=customers";
                echo '<html><body><p>Email Verify Message has been sent to '.$customer['s_email'].'</p><p>Please check it out.</p><script type="text/javascript"> setTimeout(function(){ window.location="'.$next_url.'" }, 10000); </script></body></html>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }
    }
    else if($type == "email_confirm" && isset($_GET['email']) && $_GET['email'] != "" && isset($_GET['code']) && $_GET['code'] != ""){
        // email confirm
        update_row($pdo, $table_customer, array('s_flag_verify'), array('Y'), "`s_email` = '".$_GET['email']."' and `s_verify_code` = '".$_GET['code']."'");

        echo '<html><body><p>Email Verify Success from '.$_GET['email'].'</p><script type="text/javascript"> setTimeout(function(){ window.location="'.$next_url.'" }, 10000); </script></body></html>';
    }

    // redirect($next_url);

?>