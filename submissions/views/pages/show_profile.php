<?php 
    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 

    $flag_pass = true;
    if(!( isset($customer_id) && $customer_id > 0 )) $flag_pass = false;
    

    // profiles
    $profiles = select_rows($pdo, $table_profile, "`pk_i_id` = " . $profile_pk_id);
    if($profiles) $profile = $profiles[0];
    else $flag_pass = false;

    if(isset($profile['fk_i_customer_id']) && $profile['fk_i_customer_id'] > 0){
        
        if((!(isset($adminer_id) && $adminer_id > 0)) && $customer_id != $profile['fk_i_customer_id']) $flag_pass = false;

        // customers
        $customers = select_rows($pdo, $table_customer, "`pk_i_id` = " . $profile['fk_i_customer_id']);
        if($customers) $customer = $customers[0]; else $customer = [];
    }
    else $flag_pass = false;

    if(!$flag_pass) redirect(WEB_PATH."index.php");


    // categories
	$categories = select_rows($pdo1, $table_category, "`fk_i_category_id` = ".$profile['s_category']);
    if($categories) $category = $categories[0];

?>

<!--  Start of body  -->
<div class="row">

    <div id="item-content">
        <h1><strong><?php echo $profile['s_title']; ?></strong></h1>
        <div class="item-header">
            <div>
                <strong class="publish">Customer : </strong>
                <?php echo $customer['s_username']; ?>
            </div>
            <ul id="item_location"></ul>
        </div>
        <p id="edit_item_view">
            <strong><a href="<?php echo WEB_PATH . "index.php?type=edit_profile&profile=" . $profile['pk_i_id'] ?>" rel="nofollow">Edit & Submit Profile</a></strong>
            <span>|</span>
            <!-- <strong><a class="submit" onclick="javascript:return confirm('Are you sure you want to submit ads?')" href="<?php echo WEB_PATH . "index.php?type=submit_login&profile=" . $profile['pk_i_id'] ?>">Submit Profile</a></strong> -->
            <!-- <span>|</span> -->
            <strong><a class="delete" onclick="javascript:return confirm('Are you sure you want to delete?')" href="<?php echo WEB_PATH . "index.php?type=delete_profile&profile=" . $profile['pk_i_id'] ?>">Delete</a></strong>
        </p>
        <div class="item-photos">
            <a href="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_1'] ?>" class="main-photo" title="<?php echo $profile['s_image_1'] ?>">
                <img src="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_1'] ?>" alt="<?php echo $profile['s_title'] ?>" title="<?php echo $profile['s_title'] ?>">
            </a>
            <?php if($profile['s_image_1'] != ""){ ?>
                <div class="thumbs">
                    <a href="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_1'] ?>" class="fancybox" data-fancybox-group="group" title="<?php echo $profile['s_image_1'] ?>">
                        <img src="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_1'] ?>" width="75" alt="<?php echo $profile['s_title'] ?>" title="<?php echo $profile['s_title'] ?>">
                    </a>
                </div>
            <?php } ?>
            <?php if($profile['s_image_2'] != ""){ ?>
                <div class="thumbs">
                    <a href="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_2'] ?>" class="fancybox" data-fancybox-group="group" title="<?php echo $profile['s_image_2'] ?>">
                        <img src="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_2'] ?>" width="75" alt="<?php echo $profile['s_title'] ?>" title="<?php echo $profile['s_title'] ?>">
                    </a>
                </div>
            <?php } ?>
            <?php if($profile['s_image_3'] != ""){ ?>
                <div class="thumbs">
                    <a href="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_3'] ?>" class="fancybox" data-fancybox-group="group" title="<?php echo $profile['s_image_3'] ?>">
                        <img src="<?php echo WEB_PATH.$profile['s_image_path'].$profile['s_image_3'] ?>" width="75" alt="<?php echo $profile['s_title'] ?>" title="<?php echo $profile['s_title'] ?>">
                    </a>
                </div>
            <?php } ?>
        </div>
        <div id="description">
            <p><?php echo $profile['s_title']; ?></p>
        <div id="custom_fields">
            <br>
            <div class="meta_list">
                <div class="meta">
                    <strong>Campaign Email: </strong><?php echo $profile['s_campaign_email']; ?>
                </div>
                <div class="meta">
                    <strong>Description: </strong><?php echo $profile['s_description']; ?>
                </div>
                <div class="meta">
                    <strong>Website: </strong><?php echo $profile['s_website']; ?>
                </div>
                <div class="meta">
                    <strong>Keywords: </strong><?php echo $profile['s_keywords']; ?>
                </div>
                <div class="meta">
                    <strong>Facebook Page: </strong><?php echo $profile['s_facebook_page']; ?>
                </div>
                <div class="meta">
                    <strong>Affiliate Link: </strong><?php echo $profile['s_affiliage_link']; ?>
                </div>
                <div class="meta">
                    <strong>YouTube Url: </strong><?php echo $profile['s_youtube_url']; ?>
                </div>
                <div class="meta">
                    <strong>Address: </strong><?php echo $profile['s_address']; ?>
                </div>
                <div class="meta">
                    <strong>Phone: </strong><?php echo $profile['s_phone']; ?>
                </div>
                <div class="meta">
                    <strong>City Area: </strong><?php echo $profile['s_city_area']; ?>
                </div>
                <div class="meta">
                    <strong>Category: </strong><?php echo $category['s_name']; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!--  End of body  -->