<?php 
    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); 

    $next_url = WEB_PATH."index.php?type=customer";
    $flag_reg = false;

    if(!( isset($customer_id) && $customer_id > 0 && isset($adminer_id) && $adminer_id > 0 )) redirect($next_url);
   

    if($type == "register_ads_show"){
        // customer register on ads sites
        $next_url = WEB_PATH."index.php?type=customers";
        if(isset($customer_pk_id) && $customer_pk_id > 0){
            // show register ads sites
            $customers = select_rows($pdo, $table_customer, "`pk_i_id` = '".$customer_pk_id."'");
            if(count($customers) > 0){
                $customer = $customers[0];
                $flag_reg = true;
                
                $checked_sites = select_rows($pdo, $table_register, "`s_customer_id` = '".$customer_pk_id."'");
                $registered_sites = array();

                if($checked_sites && is_array($checked_sites) && count($checked_sites) > 0){
                    foreach($checked_sites as $site){
                        if($site['s_registered'] == 'Y') $registered_sites[] = $site['pk_i_id'];
                    }
                }
            }
        }
        if(!$flag_reg) redirect($next_url);
    }

    $sites = select_rows($pdo, $table_url_list, "`s_flag_enable` = 'Y' order by `pk_i_id` asc limit " . PAGE_NUMBER * ($current_page - 1) . ", " . PAGE_NUMBER . " ");

    if($flag_reg) $paginations = get_pagination($pdo, $table_url_list, $current_page, WEB_PATH."index.php?type=register_ads_show&customer=".$customer_pk_id, "`s_flag_enable` = 'Y'");
    else $paginations = get_pagination($pdo, $table_url_list, $current_page, WEB_PATH."index.php?type=show_sites", "`s_flag_enable` = 'Y'");

?>

<!--  Start of body  -->
<div class="row">
    <div class="list-header">
        <h1>Sites List <?php echo ($flag_reg) ? "- ".$customer['s_username']." :register" : "" ?></h1>
        <?php if($flag_reg){ ?>
            <a class="ui-button ui-button-middle ui-button-main" style="float: right;" href='<?php echo WEB_PATH."index.php?type=register_ads&customer=".$customer['pk_i_id']; ?>' onclick="javascript:registerBtnClickHandle(event)" >REGISTER ON ADS SITES</a>
        <?php }else{ ?>
            <a class="ui-button ui-button-middle ui-button-main" style="float: right;" href="<?php echo WEB_PATH ?>index.php?type=add_site" >ADD A NEW SITE</a>
        <?php } ?>
    </div>
    <ul class="listing-card-list" id="listing-card-list">
        <?php
            if($flag_reg){
        ?>
        <li class="listing-card">
            <div class="listing-thumb" style="margin-top:15px; margin-left:40px;">
                <input 
                    type="checkbox" 
                    name="admin_check" 
                    onclick="javascript:checkSiteClickHandle(event, 0)" 
                    title="Select All Sites" 
                />
            </div>
            <div class="listing-detail">
                <div class="listing-cell">
                    <div class="listing-data">
                        <div class="listing-basicinfo">
                            <p>Select All Ads Sites</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php
            }
            foreach($sites as $site){
        ?>
        <li class="listing-card">
            <?php if($flag_reg){ ?>
                <div class="listing-thumb" style="margin-top:15px; margin-left:40px;">
                    <input 
                        type="checkbox" 
                        name="admin_check" 
                        <?php  if(in_array($site['pk_i_id'], $registered_sites)) echo "checked disabled"; ?> 
                        onclick="javascript:checkSiteClickHandle(event, <?php echo $site['pk_i_id'] ?>)" 
                        title="<?php if(in_array($site['pk_i_id'], $registered_sites)) echo "Already Registerd"; else echo "Check to register"; ?>" 
                        value="<?php echo $site['pk_i_id'] ?>"
                    />
                </div>
            <?php }else{ ?>
                <a class="listing-thumb" title="<?php echo $site['s_web_url'] ?>" href="<?php echo WEB_PATH . "index.php?type=edit_site&site=" . $site['pk_i_id'] ?>">
                    <img src="<?php echo WEB_PATH; ?>oc-content/themes/bender/images/comments_quotes.gif" alt="" width="140" height="100">
                </a>
            <?php } ?>
            <div class="listing-detail">
                <div class="listing-cell">
                    <div class="listing-data">
                        <div class="listing-basicinfo">
                            <p><?php echo $site['s_web_url'] ?></p>
                        </div>
                        <?php if(!$flag_reg){ ?>
                            <span class="admin-options">
                                <a href="<?php echo WEB_PATH . "index.php?type=edit_site&site=" . $site['pk_i_id'] ?>" rel="nofollow">Edit Site</a>
                                <span>|</span>
                                <a class="delete" onclick="javascript:return confirm('Are you sure you want to delete?')" href="<?php echo WEB_PATH . "index.php?type=delete_site&site=" . $site['pk_i_id'] ?>">Delete</a>
                            </span>
                        <?php } ?>
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
        var checkedSites = [];

        function checkSiteClickHandle(e, index){
            if(index === 0){
                // select all
                checkedSites = [];
                let checkBoxs = document.getElementsByTagName('input');
                for(let i = 0; i < checkBoxs.length; i++){
                    if(checkBoxs[i].type == "checkbox"){
                        checkBoxs[i].checked = e.target.checked;
                        if(e.target.checked == true && parseInt(checkBoxs[i].value)){
                            checkedSites.push(parseInt(checkBoxs[i].value));
                        }
                    }
                }
            }
            else{
                if(e.target.checked == true){
                    if(checkedSites.indexOf(index) < 0) checkedSites.push(index);
                }
                else{
                    if(checkedSites.indexOf(index) >= 0) checkedSites.splice(checkedSites.indexOf(index), 1);
                }
            }
            // console.log(checkedSites);
        }

		function registerBtnClickHandle(e){
			e.preventDefault();
			
            if(checkedSites.length > 0){
                if(confirm('Are you sure you want to register account on Ads sites?')){
                    // console.log(e.target.href+"&register_sites="+checkedSites.join('*'));
                    window.location = e.target.href+"&register_sites="+checkedSites.join('*');
                }
            }
            else{
                alert("You must check more than one site.");
            }
		}
	</script>
</div>
<!--  End of body  -->