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
        <a class="ui-button ui-button-middle ui-button-main" style="float: right;" href="<?php echo WEB_PATH ?>index.php?type=multiple_register&customer=all" onclick="javascript:multipleRegisterBtnClickHandle(event)">Multiple Register</a>
        <a class="ui-button ui-button-middle ui-button-main" style="float: right;" href="<?php echo WEB_PATH ?>index.php?type=multiple_confirm&customer=all" onclick="javascript:multipleConfirmBtnClickHandle(event)">Multiple Confirm</a>
    </div>
    <ul class="listing-card-list" id="listing-card-list">
        <?php
            foreach($customers as $customer){
        ?>
        <li class="listing-card">
            <a class="listing-thumb" title="<?php echo $customer['s_username'] ?>" href="<?php echo WEB_PATH . "index.php?type=customer&customer=" . $customer['pk_i_id'] ?>">
                <img src="<?php echo WEB_PATH; ?>oc-content/themes/bender/images/user_default.gif" alt="" width="140" height="100">
            </a>
            <div class="listing-detail">
                <div class="listing-cell">
                    <div class="listing-data">
                        <div class="listing-basicinfo">
                            <a href="<?php echo WEB_PATH . "index.php?type=customer&customer=" . $customer['pk_i_id'] ?>" class="title" title="<?php echo $customer['s_username'] ?>"><?php echo $customer['s_username'] ?></a>
                            <input type="checkbox" class="checkbox_customer_select" id="customer_check_<?php echo $customer['pk_i_id'] ?>" />
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
                            <span>|</span>
                            <a onclick="javascript:return confirm('Are you sure you want to regiter on Ads sites?')" href="<?php echo WEB_PATH . "index.php?type=register_ads_show&customer=" . $customer['pk_i_id'] ?>">Register</a>
                            <span>|</span>
                            <a onclick="javascript:confirmBtnClickHandle(event)" href="<?php echo WEB_PATH . "index.php?type=confirm_ads&customer=" . $customer['pk_i_id'] ?>">Confirm</a>
                            <?php if($customer['s_flag_verify'] == "N"){ ?>
                            <span>|</span>
                            <a onclick="javascript:return confirm('Are you sure you want to email verify?')" href="<?php echo WEB_PATH . "index.php?type=email_verify&customer=" . $customer['pk_i_id'] ?>">Email Verify</a>
                            <?php } ?>
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

    <script>
        function getCheckBoxCustomerSelect(){
            let checkBoxs = document.getElementsByClassName('checkbox_customer_select');
            let results = [];
            let temp;
            for(let i = 0; i < checkBoxs.length; i++){
                if(checkBoxs[i].type == "checkbox"){
                    temp = checkBoxs[i].id;
                    temp = parseInt(temp.replace('customer_check_', ''));
                    if(checkBoxs[i].checked) results.push((temp));
                }
            }
            return results;
        }

        function multipleRegisterBtnClickHandle(e){
            e.preventDefault();
            
            let checkedValues = getCheckBoxCustomerSelect();
			
            if(checkedValues.length > 0){
                if(confirm('Are you sure you want to register selected customers on Ads sites?')){
                    window.location = e.target.href+"&checkedCustomers="+checkedValues.join('*');
                }
            }
            else{
                alert("You must check more than one customer.");
            }
        }
        
        function multipleConfirmBtnClickHandle(e){
            e.preventDefault();
            
            let checkedValues = getCheckBoxCustomerSelect();
			
            if(checkedValues.length > 0){
                if(confirm('Are you sure you want to confirm selected customers on Ads sites?')){
                    let server = prompt('What\'s the email server name?');
                    let port = prompt('What\'s the email server port?');
                    let type = 'pop_ssl';
                    if(confirm('Is the Connection Type POP3 with SSL?')) type = 'pop_ssl';
                    else type = 'pop';

                    window.location = e.target.href+"&checkedCustomers="+checkedValues.join('*')+"&email_server="+server+"&email_port="+port+"&email_type="+type;
                }
            }
            else{
                alert("You must check more than one customer.");
            }
		}
    </script>
</div>
<!--  End of body  -->