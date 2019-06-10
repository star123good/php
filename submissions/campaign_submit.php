<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    // get customer & profile
    $user_rows = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_id."'");
    $user_row = $user_rows[0];
    $profile_rows = select_rows($pdo, $table_profile, "`pk_i_id` = '".$profile_id."'");
    $profile_row = $profile_rows[0];
    
    // type
    switch($type){
        case 'submit':
            // remote url content
            $contents = get_remote_data(WEB_PATH1 . 'user/login');
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
                WEB_PATH1.'user/login',
                WEB_PATH1.'index.php',
                WEB_PATH1.'item/new', 
                "CSRFToken",
                array("email" => $user_row['s_email'], "password" => $user_row['s_password']));

            // add javascript
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

                                    $("form#item-post").prepend("<input type=\"hidden\" name=\"url_link\" id=\"url_link\" />");
                                    $("form#item-post input#url_link").val($("form#item-post").attr("action"));
                                    $("form#item-post").attr("action", "'.WEB_PATH.'index.php?type=submit_ads");

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
                                    setTimeout(function(){ $("form#item-post input#meta_website-link").val("'.$profile_row['s_website'].'"); }, 10000);
                                    setTimeout(function(){ $("form#item-post input#meta_keywords").val("'.$profile_row['s_keywords'].'"); }, 11000);
                                    setTimeout(function(){ $("form#item-post input#meta_phone").val("'.$profile_row['s_phone'].'"); }, 12000);
                                    setTimeout(function(){ $("form#item-post input#meta_facebook").val("'.$profile_row['s_facebook_page'].'"); }, 13000);
                                    setTimeout(function(){ $("form#item-post input#meta_affiliate-link").val("'.$profile_row['s_affiliage_link'].'"); }, 14000);
                                    setTimeout(function(){ $("form#item-post input[name=s_youtube]").val("'.$profile_row['s_youtube_url'].'"); }, 15000);

                                    setTimeout(function(){ $("button[type=submit]").trigger("click"); }, 18000);
                                });
                            </script>';
            break;
        case 'submit_ads':
            $params = array_flatten($_POST);
            $contents = curl_bypass_csrf_validation_submit(
                WEB_PATH1.'user/login',
                WEB_PATH1.'index.php',
                WEB_PATH1.'item/new',
                WEB_PATH1.'index.php',
                "CSRFToken",
                array("email" => $user_row['s_email'], "password" => $user_row['s_password']),
                $params);
            // $contents = get_url(WEB_PATH1.'index.php', $_POST, WEB_PATH1.'index.php')['html'];
            $javascripts = "";
            break;
        default :
            $contents = "";
            $javascripts = "";
            break;
    }
    
    // show html
    echo str_ireplace('</body>', $javascripts . '</body>', $contents);
?>