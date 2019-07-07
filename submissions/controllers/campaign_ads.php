<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');


    $next_url = WEB_PATH."index.php?type=customers";

    if((isset($adminer_id) && $adminer_id > 0) && (isset($customer_pk_id) && $customer_pk_id > 0)){
        // adminer
        if($type == "register_ads"){
            // register on ads sites
            $_SESSION['register_links'] = array();

            if(isset($_GET['register_sites']) && $_GET['register_sites'] != ""){
                $site_ids = explode("*", $_GET['register_sites']);
                $_SESSION['register_links'] = $site_ids;
                $next_url = WEB_PATH."index.php?type=register_ads_link&customer=".$customer_pk_id;
            }
            // exit();
        }
        else if($type == "register_ads_link"){
            // register on ads sites
            if(isset($_SESSION['register_links']) && is_array($_SESSION['register_links']) && count($_SESSION['register_links']) > 0){
                $site_ids = $_SESSION['register_links'];
                $site_id = $site_ids[0];
                $sites = select_rows($pdo, $table_url_list, "`pk_i_id` = " . $site_id . " and `s_flag_enable` = 'Y'");

                $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");
                
                if(count($customers) > 0 && count($sites) > 0){
                    $next_url = WEB_PATH."index.php?type=register_ads_put&customer=".$customer_pk_id;
                    $customer = $customers[0];
                    $site_register_url = $sites[0]['s_register_url'];

                    $contents = get_url($site_register_url, null, null);

                    $javascripts = '<script type="text/javascript">
                                        $(document).ready(function(){
                                            $("form[name=register]").prepend("<input type=\"hidden\" name=\"url_link\" id=\"url_link\" />");
                                            $("form[name=register] input#url_link").val($("form[name=register]").attr("action"));
                                            $("form[name=register]").attr("action", "'. $next_url .'");

                                            if($("form[name=register] input#s_name").length){
                                                setTimeout(function(){ $("form input#s_name").val("'.$customer['s_username'].'"); }, 1000);
                                            }
                                            if($("form[name=register] input#s_email").length){
                                                setTimeout(function(){ $("form input#s_email").val("'.$customer['s_email'].'"); }, 2000);
                                            }
                                            if($("form[name=register] input#s_password").length){
                                                setTimeout(function(){ $("form input#s_password").val("'.$customer['s_password'].'"); }, 3000);
                                            }
                                            if($("form[name=register] input#s_password2").length){
                                                setTimeout(function(){ $("form input#s_password2").val("'.$customer['s_password'].'"); }, 4000);
                                            }

                                            if($("form[name=register] button[type=submit]").length > 0){
                                                // setTimeout(function(){ $("form[name=register] button[type=submit]").trigger("click"); }, 10000);
                                            }

                                            setTimeout(function(){
                                                // runtime out 10seconds
                                                window.location = "' . $next_url . '";
                                            }, 10000);
                                        });
                                    </script>';

                    echo str_ireplace('</body>', $javascripts . '</body>', $contents['html']);

                }

                exit();
            }
        }
        else if($type == "register_ads_put"){
            // register on ads sites by curl
            if(isset($_SESSION['register_links']) && is_array($_SESSION['register_links']) && count($_SESSION['register_links']) > 0){
                $site_ids = $_SESSION['register_links'];
                $site_id = $site_ids[0];
                $sites = select_rows($pdo, $table_url_list, "`pk_i_id` = " . $site_id . " and `s_flag_enable` = 'Y'");
                $site_ids = array_slice($site_ids, 1);
                $_SESSION['register_links'] = $site_ids;

                $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");

                if(count($customers) > 0 && count($sites) > 0){
                    if(count($site_ids) > 0) $next_url = WEB_PATH."index.php?type=register_ads_link&customer=".$customer_pk_id;
                    $customer = $customers[0];

                    $contents = curl_bypass_csrf_validation(
                        $sites[0]['s_register_url'], 
                        $sites[0]['s_default_url'], 
                        null, 
                        "CSRFToken",
                        array("s_name" => $customer['s_username'], "s_email" => $customer['s_email'], "s_password" => $customer['s_password'], "s_password2" => $customer['s_password'])
                    );

                    $javascripts = '<script type="text/javascript">
                                        // $(document).ready(function(){
                                            setTimeout(function(){
                                                // runtime out 10seconds
                                                window.location = "' . $next_url . '";
                                            }, 10000);
                                        // });
                                    </script>';
                    
                    $register_sites = select_rows($pdo, $table_register, "`s_customer_id` = '".$customer_pk_id."' and `s_site_id` = '".$sites[0]['pk_i_id']."'");

                    if(strstr($contents, "</body>")) {
                        if(count($register_sites) > 0) update_row($pdo, $table_register, 
                            array('s_registered'), array('Y'),  
                            "`s_customer_id` = '".$customer_pk_id."' and `s_site_id` = '".$sites[0]['pk_i_id']."'");
                        else insert_row($pdo, $table_register, 
                            array('s_customer_id', 's_site_id', 's_registered', 's_confirm'), 
                            array($customer_pk_id, $sites[0]['pk_i_id'], 'Y', 'N'));
                    }
                    else{
                        if(count($register_sites) > 0) update_row($pdo, $table_register, 
                            array('s_registered'), array('N'),  
                            "`s_customer_id` = '".$customer_pk_id."' and `s_site_id` = '".$sites[0]['pk_i_id']."'");
                        else insert_row($pdo, $table_register, 
                            array('s_customer_id', 's_site_id', 's_registered', 's_confirm'), 
                            array($customer_pk_id, $sites[0]['pk_i_id'], 'N', 'N'));

                        $contents = "<html><head></head><body>This Ads site is not possible to private register.</body></html>";
                    }

                    echo str_ireplace('</body>', $javascripts . '</body>', $contents);
                    exit();
                }
            }           
        }
        else if($type == "confirm_ads"){
            // get verify links from email in order to confirm ads sites.
            $_SESSION['verify_links'] = array();

            $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");
            if(count($customers) > 0){
                $customer = $customers[0];

                // get email

                try{
                    if(isset($_GET['email_server']) && $_GET['email_server'] != "") $mail_server = $_GET['email_server']; else $mail_server = "mail.realreply.com";
                    if(isset($_GET['email_port']) && $_GET['email_port'] != "") $mail_port = $_GET['email_port']; else $mail_port = 995;
                    if(isset($_GET['email_type']) && $_GET['email_type'] != "") $mail_type = $_GET['email_type']; else $mail_type = "pop_ssl";
                    if($mail_type == "pop_ssl") $mail_type = "/pop3/ssl";
                    else $mail_type = "/pop3";
                    $user_email = $customer['s_email'];
                    $user_pass = $customer['s_password'];

                    $mbox = imap_open("{".$mail_server.":".$mail_port.$mail_type."/novalidate-cert}INBOX", $user_email, $user_pass);//{mail.realreply.com:995/pop3/ssl/novalidate-cert}INBOX
                    // $mbox = imap_open("{".$mail_server.":".$mail_port."/imap/ssl/novalidate-cert}INBOX", $user_email, $user_pass);//{imap-mail.outlook.com:993/imap/ssl/novalidate-cert}INBOX
                    // $mbox = imap_open("{".$mail_server.":".$mail_port."/pop3/ssl/novalidate-cert}INBOX", $user_email, $user_pass);//{pop3.live.com:995/pop3/ssl/novalidate-cert}INBOX
                    // $mbox = imap_open("{".$mail_server.":".$mail_port."/ssl}INBOX", $user_email, $user_pass);//{imap-mail.outlook.com:993/ssl}INBOX

                    // $msg_count = imap_num_msg($mbox);
                    $msgs = array();
                    $link_urls = array();
                    $output = "";

                    //Lets get all emails that were received since a given date.
                    // $search = 'SINCE "' . date("j F Y", strtotime("-1 days")) . '"';
                    $search = 'UNSEEN';
                    $emails = imap_search($mbox, $search);
                    
                    //If the $emails variable is not a boolean FALSE value or
                    //an empty array.
                    if(!empty($emails)){
                        //Loop through the emails.
                        foreach($emails as $email){
                            $emailBody = imap_fetchbody($mbox, $email, 1, FT_PEEK);
                            $output .= $emailBody;
                        }
                    }

                    
                    // for($i = 1; $i <= $msg_count; $i++) {
                        // $headerInfo = imap_headerinfo($mbox, $i);
                        // $overview = imap_fetch_overview($mbox, $i, 0);
                        // $emailStructure = imap_fetchstructure($mbox, $i);
                        // $output .= "\n\n\n";
                        // $output .= '<b>Subject:- </b>' . $headerInfo->subject . '<br/><br/>';
                        // $output .= '<b>Toaddress:- </b>' . $headerInfo->toaddress . '<br/><br/>';
                        // $output .= "\n" . '<b>Date:- </b>' . $headerInfo->date . '<br/><br/>';
                        // $output .= "\n" . '<b>fromaddress:- </b>' . $headerInfo->fromaddress . '<br/><br/>';
                        // $output .= '<b>reply_toaddress:- </b>' . $headerInfo->reply_toaddress . '<br/><br/>';
                        // $output .= '<b>Status:- </b>' . $overview[0]->seen ? 'read' : 'unread' . '<br/><br/>';
                        // if (!isset($emailStructure->parts)) {
                        //     $emailBody = imap_body($mbox, $i, FT_PEEK);
                        //     $output .= $emailBody;
                        // } else {
                            //
                        // }
                        // $msgs[] = array(
                        //     'index'     => $i,
                        //     'header'    => $headerInfo,
                        //     'body'      => $emailBody,
                        //     'overview'  => $overview,
                        //     'structure' => $emailStructure
                        // );
                    // }

                    preg_match_all("/link: <a href=([^>]+)>/", $output, $link_urls);
                    // preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $output, $link_urls);
                    // preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $output, $link_urls);
                    $link_urls = $link_urls[1];
                    // echo $output;
                    // var_dump($link_urls);
                    $_SESSION['verify_links'] = $link_urls;
                    $next_url = WEB_PATH."index.php?type=verify_ads&customer=".$customer['pk_i_id'];
                    imap_close($mbox);
                }
                catch(Exception $e){
                    var_dump($e);
                }
            }
            // exit();

        }
        else if($type == "verify_ads"){
            // verify ads sites
            if(isset($_SESSION['verify_links']) && is_array($_SESSION['verify_links']) && count($_SESSION['verify_links']) > 0){
                $urls = $_SESSION['verify_links'];
                // var_dump($urls);
                $url = trim(str_replace("\"", "", $urls[0]));
                // echo $url;

                $sites = select_rows($pdo, $table_url_list, "`s_flag_enable` = 'Y' AND ('".$url."' LIKE CONCAT('%', `s_web_url`, '%'))");
                
                $_SESSION['verify_links'] = array_slice($urls, 1);
                $contents = get_url($url, null, null);
                $javascripts = '<script type="text/javascript">
                                    // $(document).ready(function(){
                                        setTimeout(function(){ window.location.reload(1); }, 10000);
                                    // });
                                </script>';

                
                if(count($sites) > 0){

                    $register_sites = select_rows($pdo, $table_register, "`s_customer_id` = '".$customer_pk_id."' and `s_site_id` = '".$sites[0]['pk_i_id']."'");

                    if(strstr($contents['html'], "</body>")) {
                        if(count($register_sites) > 0) update_row($pdo, $table_register, 
                            array('s_confirm'), array('Y'),  
                            "`s_customer_id` = '".$customer_pk_id."' and `s_site_id` = '".$sites[0]['pk_i_id']."'");
                        else insert_row($pdo, $table_register, 
                            array('s_customer_id', 's_site_id', 's_registered', 's_confirm'), 
                            array($customer_pk_id, $sites[0]['pk_i_id'], 'Y', 'Y'));
                    }
                    else{
                        if(count($register_sites) > 0) update_row($pdo, $table_register, 
                            array('s_confirm'), array('N'),  
                            "`s_customer_id` = '".$customer_pk_id."' and `s_site_id` = '".$sites[0]['pk_i_id']."'");
                        else insert_row($pdo, $table_register, 
                            array('s_customer_id', 's_site_id', 's_registered', 's_confirm'), 
                            array($customer_pk_id, $sites[0]['pk_i_id'], 'Y', 'N'));

                        $contents = "<html><head></head><body>This Ads site is not possible to confirm once registered.</body></html>";
                    }
                }

                echo str_ireplace('</body>', $javascripts . '</body>', $contents['html']);

                exit();

            }
        }
    }

    redirect($next_url);

?>