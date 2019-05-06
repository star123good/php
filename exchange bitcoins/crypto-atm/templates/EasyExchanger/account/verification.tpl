<div class="main-container">
        <div class="container">
			<div class="row">
				<div class="col-sm-3 page-sidebar">
                    <aside>
                        <div class="inner-box">
                            <div class="user-panel-sidebar">
                                <div class="collapse-box">
                                    <h5 class="collapse-title no-border"> [#lang_my_account] <a href="#MyAccount" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>

                                    <div class="panel-collapse collapse in" id="MyAccount">
                                        <ul class="acc-list">
                                            <li><a href="[@url]account/dashboard"><i class="fa fa-dashboard"></i> [#lang_menu_dashboard] </a></li>
											<li><a href="[@url]account/exchanges"><i class="fa fa-refresh"></i> [#lang_menu_exchanges] </a></li>
											<li><a href="[@url]account/settings"><i class="fa fa-cogs"></i> [#lang_menu_settings] </a></li>
											<li><a class="active" href="[@url]account/verification"><i class="fa fa-check"></i> [#lang_menu_account_verification] </a></li>
											<li><a href="[@url]logout"><i class="fa fa-sign-out"></i> [#lang_menu_logout] </a></li>
                                        </ul>
                                    </div>
                                </div>
               
                            </div>
                        </div>
                        <!-- /.inner-box  -->

                    </aside>
                </div>
                <!--/.page-sidebar-->

                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <div class="row">
                            <div class="col-md-5 col-xs-4 col-xxs-12">
                                <h3 class="no-padding text-center-480 useradmin"><a href=""><img class="userImg" src="[@url]templates/EasyExchanger/assets/images/user.jpg" alt="user"> [@U_FirstName] [@U_LastName] </a></h3>
                            </div>
                            <div class="col-md-7 col-xs-8 col-xxs-12">
                                <div class="header-data text-center-xs">


                                    <!-- revenue data -->
                                    <div class="hdata">
                                        <div class="mcol-left">
                                            <!-- Icon with blue background -->
                                            <i class="fa fa-refresh ln-shadow"></i></div>
                                        <div class="mcol-right">
                                            <!-- Number of visitors -->
                                            <p><a href="[@url]account/exchanges">[@U_TotalExchanges]</a> <em>[#lang_total_exchanges] </em></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<!-- <div class="alert alert-info alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Warning!</strong> Information from admin.
					</div>-->
					
                    <div class="inner-box">
                        <h2 class="title-2">[#lang_menu_account_verification]</h2>
                        [@results]
						
						[@Email_Verification]
						[@Document_Verification]
						[@Mobile_Verification]
                    </div>
                </div>
                <!--/.page-content-->
			</div>
        </div>
    </div>
    <!-- /.main-container -->
