<?php 
    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 

    if(!( isset($customer_id) && $customer_id > 0 && isset($adminer_id) && $adminer_id > 0 )) redirect(WEB_PATH."index.php?type=customer");

    $customers = select_rows($pdo, $table_customer, " true order by `pk_i_id` asc limit " . PAGE_NUMBER * ($current_page - 1) . ", " . PAGE_NUMBER . " ");
    
    $paginations = get_pagination($pdo, $table_customer, $current_page, WEB_PATH."index.php?type=customers");
?>

<!--  Start of body  -->
<div class="row">
    <div class="list-header">
        <h1>Customers List</h1>
    </div>
    <ul class="listing-card-list" id="listing-card-list">
        <?php
            foreach($customers as $customer){
        ?>
        <li class="listing-card">
            <a class="listing-thumb" title="<?php echo $customer['s_username'] ?>" href="<?php echo WEB_PATH . "index.php?type=customer&customer=" . $customer['pk_i_id'] ?>">
                <img src="<?php echo WEB_PATH1; ?>oc-content/themes/bender/images/no_photo.gif" alt="" width="140" height="100">
            </a>
            <div class="listing-detail">
                <div class="listing-cell">
                    <div class="listing-data">
                        <div class="listing-basicinfo">
                            <a href="<?php echo WEB_PATH . "index.php?type=customer&customer=" . $customer['pk_i_id'] ?>" class="title" title="<?php echo $customer['s_username'] ?>"><?php echo $customer['s_username'] ?></a>
                            <div class="listing-attributes">
                                <span><?php echo $customer['s_email']; ?></span>
                                <span class="currency-value">
                                    <?php echo ($customer['s_flag_adminer'] == 'Y') ? "This is adminer." : "This is customer." ?>
                                </span>
                            </div>
                            <p></p>
                        </div>
                        <span class="admin-options">
                            <a href="<?php echo WEB_PATH . "index.php?type=customer_edit&customer=" . $customer['pk_i_id'] ?>" rel="nofollow">Edit Customer</a>
                            <span>|</span>
                            <a class="delete" onclick="javascript:return confirm('Are you sure you want to delete?')" href="<?php echo WEB_PATH . "index.php?type=customer_delete&customer=" . $customer['pk_i_id'] ?>">Delete</a>
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