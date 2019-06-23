<?php 
    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 


    $flag_pass = true;
    if(!( isset($customer_id) && $customer_id > 0 )) $flag_pass = false;
    if((!(isset($adminer_id) && $adminer_id > 0) && ($customer_pk_id > 0) && ($customer_pk_id != $customer_id))) $flag_pass = false;

    if(!$flag_pass) redirect(WEB_PATH."index.php");


    // get customer & profiles
    if((isset($adminer_id) && $adminer_id > 0) && (!(isset($customer_pk_id) && $customer_pk_id > 0))){
        $customers = select_rows($pdo, $table_customer, "`pk_i_id` = " . $customer_id);
        $profiles = select_rows($pdo, $table_profile, " true order by `pk_i_id` asc limit " . PAGE_NUMBER * ($current_page - 1) . ", " . PAGE_NUMBER . " ");
        $paginations = get_pagination($pdo, $table_profile, $current_page, WEB_PATH."index.php?type=customer&customer=".$customer_pk_id);

        
    } 
    else{
        $customers = select_rows($pdo, $table_customer, "`pk_i_id` = " . $customer_pk_id);
        $profiles = select_rows($pdo, $table_profile, "`fk_i_customer_id` = " . $customer_pk_id . " order by `pk_i_id` asc limit " . PAGE_NUMBER * ($current_page - 1) . ", " . PAGE_NUMBER . " ");
        $paginations = get_pagination($pdo, $table_profile, $current_page, WEB_PATH."index.php?type=customer&customer=".$customer_pk_id, "`fk_i_customer_id` = " . $customer_pk_id);
    } 

    if($customers) $customer = $customers[0];

    // random profile
    $random_profile = get_random_value($profiles, "pk_i_id");

?>

<!--  Start of body  -->
<div class="row">

    <div id="item-content">
        <h1><strong><?php echo $customer['s_username'] . " - " . (($customer['s_flag_adminer'] == 'Y') ? "Adminer" : "Customer"); ?></strong></h1>
        <div class="item-header">
            <div>
                <strong class="publish">Created At</strong>
                <?php echo $customer['s_created_at']; ?>
            </div>
            <ul id="item_location"></ul>
        </div>
        <p id="edit_item_view">
            <strong><a href="<?php echo WEB_PATH . "index.php?type=customer_edit&customer=" . $customer['pk_i_id'] ?>" rel="nofollow">Edit Customer</a></strong>
            <span>|</span>
            <?php if(isset($adminer_id) && $adminer_id > 0){ ?>
            <strong><a href="<?php echo WEB_PATH . "index.php?type=customer_delete&customer=" . $customer['pk_i_id'] ?>" rel="nofollow" onclick="javascript:return confirm('Are you sure you want to delete?')">Delete Customer</a></strong>
            <span>|</span>
            <strong><a href="#" rel="nofollow" id="random_submit">Random Submit</a></strong>
            <span>|</span>
            <script>
                $(document).ready(function(){
                    $(document).on("click", "#random_submit", function(event){
                        event.preventDefault();
                        if(confirm('Are you sure you want to submit ads randomly?')){
                            let counts = prompt("Please input the number of profiles.");
                            if(counts > 0){
                                window.location = "<?php echo WEB_PATH . "index.php?type=edit_profile&profile=" . $random_profile['pk_i_id'] ?>&random_count=" + counts;
                            }
                        }
                    });
                });
            </script>
            <?php } ?>
            <strong><a href="<?php echo WEB_PATH . "index.php?type=profile&customer=".$customer['pk_i_id'] ?>" rel="nofollow">Add new Profile</a></strong>
        </p>
        <div id="description">
            <p><?php echo $customer['s_username']; ?></p>
        <div id="custom_fields">
            <br>
            <div class="meta_list">
                 <div class="meta">
                    <strong>User Name: </strong><?php echo $customer['s_username']; ?>
                </div>
                 <div class="meta">
                    <strong>User Password: </strong><?php echo $customer['s_password']; ?>
                </div>
                 <div class="meta">
                    <strong>User Email: </strong><?php echo $customer['s_email']; ?>
                </div>
                 <div class="meta">
                    <strong>Created At: </strong><?php echo $customer['s_created_at']; ?>
                </div>
                 <div class="meta">
                    <?php if($customer['s_flag_adminer'] == 'Y'){ ?>
                        <strong>This is adminer.</strong>
                    <?php } else { ?>
                        <strong>This is not adminer.</strong>
                    <?php } ?>
                </div>
            </div>
            <hr/>
            <ul class="listing-card-list" id="listing-card-list">

                <?php
                    if($profiles){
                        foreach($profiles as $profile){
                ?>
                <li class="listing-card">
                    <a class="listing-thumb" title="<?php echo $profile['s_title'] ?>" href="<?php echo WEB_PATH . "index.php?type=show_profile&profile=" . $profile['pk_i_id'] ?>">
                        <img src="<?php echo WEB_PATH1; ?>oc-content/themes/bender/images/no_photo.gif" alt="" width="140" height="100">
                    </a>
                    <div class="listing-detail">
                        <div class="listing-cell">
                            <div class="listing-data">
                                <div class="listing-basicinfo">
                                    <a href="<?php echo $profile['s_title'] ?>" href="<?php echo WEB_PATH . "index.php?type=show_profile&profile=" . $profile['pk_i_id'] ?>" class="title" title="<?php echo $profile['s_title'] ?>">
                                        <?php echo $profile['s_title']; ?>
                                    </a>
                                    <div class="listing-attributes">
                                        <span><?php echo $profile['s_campaign_email']; ?></span>
                                        <span class="currency-value">
                                            <?php echo (($profile['s_keywords'] != '') ? " keywords : " : "") . $profile['s_keywords']; ?>
                                        </span>
                                    </div>
                                    <p></p>
                                </div>
                                <span class="admin-options">
                                    <a href="<?php echo WEB_PATH . "index.php?type=edit_profile&profile=" . $profile['pk_i_id'] ?>" rel="nofollow">Edit & Submit Profile</a>
                                    <span>|</span>
                                    <!-- <a class="submit" onclick="javascript:return confirm('Are you sure you want to submit ads?')" href="<?php echo WEB_PATH . "index.php?type=submit_login&profile=" . $profile['pk_i_id'] ?>">Submit Profile</a> -->
                                    <!-- <span>|</span> -->
                                    <a class="delete" onclick="javascript:return confirm('Are you sure you want to delete?')" href="<?php echo WEB_PATH . "index.php?type=delete_profile&profile=" . $profile['pk_i_id'] ?>">Delete</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                        }
                    }
                ?>

            </ul>
            <div class="clear"></div>
            <ul class="footer-links">
            </ul>
            <div class="paginate">
                <?php echo $paginations; ?>
            </div>
        </div>
    </div>

</div>
<!--  End of body  -->