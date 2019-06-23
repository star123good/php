<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    // get customer & profile
    if($customer_pk_id > 0) $user_rows = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");
    else $user_rows = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_id."'");
    $user_row = $user_rows[0];
    // var_dump($user_row);
    $profile_rows = select_rows($pdo, $table_profile, "`pk_i_id` = '".$profile_id."'");
    $profile_row = $profile_rows[0];
    // var_dump($profile_row);

    // get submits from customer & profile
    $yesterday_time = date("Y-m-d H:i:s", time() - 60 * 60 * 24);
    $submits = select_rows($pdo, $table_submit, "`s_customer_id` = '".$customer_pk_id."' and `s_profile_id` = '".$profile_id."' and `s_submit_at` > '".$yesterday_time."' order by `s_submit_at` desc limit 0, 10 ");
    $url_id_olds = array();
    foreach($submits as $submitting){
        $url_id_olds[] = $submitting['s_site_id'];
    }
    // var_dump($url_id_olds);

    // get website url
    $url_rows = select_rows($pdo, $table_url_list, "`s_flag_enable` = 'Y'");


    // get website url
    $url_row = get_random_value($url_rows, "pk_i_id", $url_id_olds);
    // var_dump($url_row);

    $profiles = select_rows($pdo, $table_profile);
	$random_profile = get_random_value($profiles, "pk_i_id");

    // exit();
   
    // type
    switch($type){
        case 'submit':
            // remote url content
            $contents = get_remote_data($url_row['s_login_url']);
            // add javascript
            $javascripts = '<script type="text/javascript">
                                $(document).ready(function(){
                                    $(".resp-wrapper form").attr("action", "'.WEB_PATH.'index.php?type=submit_login");
                                    
                                    setTimeout(function(){ $(".resp-wrapper form input#email").val("'.$user_row['s_email'].'"); }, 1000);
                                    
                                    setTimeout(function(){ $(".resp-wrapper form input#password").val("'.$user_row['s_password'].'"); }, 2000);
                                    

                                    $(document).on("click", "button[type=\"submit\"]", function(event){
                                        // event.preventDefault();
                                    });

                                    // setTimeout(function(){ $("button[type=\"submit\"]").trigger("click"); }, 10000);
                                });
                            </script>';
            break;
        case 'submit_login':
            // vaildate csrf token
            $contents =  curl_bypass_csrf_validation(
                $url_row['s_login_url'],
                $url_row['s_default_url'],
                $url_row['s_create_url'], 
                "CSRFToken",
                array("email" => $user_row['s_email'], "password" => $user_row['s_password']));

            $contents = str_ireplace($url_row['s_default_url'], WEB_PATH1."index.php", $contents);

            // add javascript
            if(trim($contents) == ""){
                if(isset($submit_count) && $submit_count > 0){
                    $next_url = "&submit_count=".($submit_count);
                }
                else{
                    $next_url = "";
                }
                if(isset($random_submit_count) && $random_submit_count > 1){
                    $next_url = (WEB_PATH."index.php?type=edit_profile&profile=".$random_profile['pk_i_id']."&random_count=". ($random_submit_count - 1)) . $next_url;
                }
                else{
                    $next_url = (WEB_PATH."index.php?type=customer");
                }
                
                $contents="<html><head></head><body></body></html>";
                $javascripts = '<script type="text/javascript">
                                        confirm("Submitting Ads is not working.\nBecause account or profile is not correct.");
                                        window.location = "' . $next_url . '"; 
                                </script>';
            }
            else{
                $next_url = WEB_PATH.'index.php?type=submit_ads&customer='.$customer_pk_id.'&submit_count='.($submit_count).((isset($random_submit_count) && $random_submit_count > 0) ? "&random_count=".$random_submit_count : "");
                $javascripts = '<script type="text/javascript">
                                $(document).ready(function(){
                                    function getArrayFromSelect($selectOption){
                                        var list = [];
                                        $selectOption.each(function(){
                                            list.push($(this).val());
                                        });
                                        return list;
                                    }
                                    function getRandom(list){
                                        return list[Math.floor(Math.random() * list.length)];
                                    }
                                    function checkKeywordsElement(){
                                        if($("form#item-post input#meta_keywords").length){
                                            
                                            setTimeout(function(){ $("form#item-post input#meta_website-link").val("'.$profile_row['s_website'].'"); }, 10000);
                                            setTimeout(function(){ $("form#item-post input#meta_keywords").val("'.$profile_row['s_keywords'].'"); }, 11000);
                                            setTimeout(function(){ $("form#item-post input#meta_phone").val("'.$profile_row['s_phone'].'"); }, 12000);
                                            setTimeout(function(){ $("form#item-post input#meta_facebook").val("'.$profile_row['s_facebook_page'].'"); }, 13000);
                                            setTimeout(function(){ $("form#item-post input#meta_affiliate-link").val("'.$profile_row['s_affiliage_link'].'"); }, 14000);
                                            setTimeout(function(){ $("form#item-post input[name=s_youtube]").val("'.$profile_row['s_youtube_url'].'"); }, 15000);

                                            setTimeout(function(){ checkCityId(); }, 10000);

                                            return ;
                                        }
                                        setTimeout(function(){
                                            checkKeywordsElement();
                                        }, 1000);
                                    }
                                    function checkCityId(){
                                        if($("#cityId").val().length > 0 && $("#regionId").val().length > 0){
                                            setTimeout(function(){ $("button[type=submit]").trigger("click"); }, 18000);
                                            return ;
                                        }
                                        else{
                                            if($("#regionId").val().length > 0){
                                                var randomCity = getRandom(getArrayFromSelect($("#cityId option")));
                                                $("form#item-post select#cityId").val(randomCity).change();
                                            }
                                            else{
                                                var randomRegion = getRandom(getArrayFromSelect($("#regionId option")));
                                                $("form#item-post select#regionId").val(randomRegion).change();
                                            }
                                        }
                                        setTimeout(function(){
                                            checkCityId();
                                        }, 300);
                                    }

                                    $("form#item-post").prepend("<input type=\"hidden\" name=\"url_link\" id=\"url_link\" />");
                                    $("form#item-post input#url_link").val($("form#item-post").attr("action"));
                                    $("form#item-post").attr("action", "'. $next_url .'");

                                    setTimeout(function(){ $("form#item-post select#catId").val("'.$profile_row['s_category'].'").change(); }, 1000);

                                    setTimeout(function(){ $("form#item-post input#titleen_US").val("'.$profile_row['s_title'].'"); }, 2000);

                                    setTimeout(function(){ tinyMCE.get("descriptionen_US").setContent("'.$profile_row['s_description'].'"); }, 3000);

                                    // setTimeout(function(){ $("input[name=qqfile]").val("'.$profile_row['s_image_1'].'").change(); }, 4000);
                                    // $("input[name=qqfile]").change("file:///C:/Users/Administrator/Pictures/loading.gif");
                                    // $("#restricted-fine-uploader")
                                    // setTimeout(function(){ $("input[name=qqfile]").trigger("click"); }, 20000);

                                    
                                    setTimeout(function(){
                                        var randomRegion = getRandom(getArrayFromSelect($("#regionId option")));
                                        $("form#item-post select#regionId").val(randomRegion).change();
                                    }, 5000);

                                    
                                    setTimeout(function(){
                                        var randomCity = getRandom(getArrayFromSelect($("#cityId option")));
                                        $("form#item-post select#cityId").val(randomCity).change();
                                    }, 7000);

                                    setTimeout(function(){ $("form#item-post input#cityArea").val("'.$profile_row['s_city_area'].'"); }, 8000);
                                    setTimeout(function(){ $("form#item-post input#address").val("'.$profile_row['s_address'].'"); }, 9000);

                                    checkKeywordsElement();


                                    setTimeout(function(){
                                        // runtime out 30seconds
                                        window.location = "' . $next_url . '";
                                    }, 30000);

                                    
                                });
                            </script>';
                
            }
            break;
        case 'submit_ads':
            $params = array_flatten($_POST);
            $contents = curl_bypass_csrf_validation_submit(
                $url_row['s_login_url'],
                $url_row['s_default_url'],
                $url_row['s_create_url'],
                $url_row['s_default_url'],
                "CSRFToken",
                array("email" => $user_row['s_email'], "password" => $user_row['s_password']),
                $params);
            // $contents = get_url($url_row['s_default_url'], $_POST, $url_row['s_default_url'])['html'];
            $keys = array(
                's_customer_id',
                's_profile_id',
                's_site_id',
                's_city_id'
            );
            $submit_array = array(
                $customer_pk_id,
                $profile_id,
                $url_row['pk_i_id'],
                ((isset($params['cityId'])) ? $params['cityId'] : "")
            );
            insert_row($pdo, $table_submit, $keys, $submit_array);
            if($submit_count > 1){
                $next_url = WEB_PATH."index.php?type=submit_login&customer=".$customer_pk_id."&submit_count=".($submit_count-1).((isset($random_submit_count) && $random_submit_count > 0) ? "&random_count=".$random_submit_count : "");
            } 
            else{
                if(isset($random_submit_count) && $random_submit_count > 1){
                    $next_url = WEB_PATH."index.php?type=edit_profile&profile=".$random_profile['pk_i_id']."&random_count=". ($random_submit_count - 1);
                }
                else{
                    $next_url = WEB_PATH."index.php?type=customer";
                }
            } 
            $javascripts = '<script type="text/javascript">
                                $(document).ready(function(){
                                    setTimeout(function(){ window.location="'.$next_url.'" }, 10000);
                                });
                            </script>';
            break;
        default :
            $contents = "";
            $javascripts = "";
            break;
    }
    
    // show html
    // header("Access-Control-Allow-Origin: *");
    echo str_ireplace('</body>', $javascripts . '</body>', $contents);
?>