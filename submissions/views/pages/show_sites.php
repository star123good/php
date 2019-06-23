<?php 
    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 

    if(!( isset($customer_id) && $customer_id > 0 && isset($adminer_id) && $adminer_id > 0 )) redirect(WEB_PATH."index.php?type=customer");

    $sites = select_rows($pdo, $table_url_list, "`s_flag_enable` = 'Y' order by `pk_i_id` asc limit " . PAGE_NUMBER * ($current_page - 1) . ", " . PAGE_NUMBER . " ");
    
    $paginations = get_pagination($pdo, $table_url_list, $current_page, WEB_PATH."index.php?type=show_sites", "`s_flag_enable` = 'Y'");
?>

<!--  Start of body  -->
<div class="row">
    <div class="list-header">
        <h1>Sites List</h1>
        <a class="ui-button ui-button-middle ui-button-main" style="float: right;" href="<?php echo WEB_PATH ?>index.php?type=add_site" >ADD A NEW SITE</a>
    </div>
    <ul class="listing-card-list" id="listing-card-list">
        <?php
            foreach($sites as $site){
        ?>
        <li class="listing-card">
            <div class="listing-detail">
                <div class="listing-cell">
                    <div class="listing-data">
                        <div class="listing-basicinfo">
                            <p><?php echo $site['s_web_url'] ?></p>
                        </div>
                        <span class="admin-options">
                            <a href="<?php echo WEB_PATH . "index.php?type=edit_site&site=" . $site['pk_i_id'] ?>" rel="nofollow">Edit Site</a>
                            <span>|</span>
                            <a class="delete" onclick="javascript:return confirm('Are you sure you want to delete?')" href="<?php echo WEB_PATH . "index.php?type=delete_site&site=" . $site['pk_i_id'] ?>">Delete</a>
                        </span>
                    </div>
                </div>
            </div>
        </li>
        <?php
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
<!--  End of body  -->