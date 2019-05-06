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
											<li><a class="active" href="[@url]account/settings"><i class="fa fa-cogs"></i> [#lang_menu_settings] </a></li>
											<li><a href="[@url]account/verification"><i class="fa fa-check"></i> [#lang_menu_account_verification] </a></li>
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
                        <h2 class="title-2">[#lang_menu_settings]</h2>
                        [@results]
						<form action="" method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>[#lang_field_5]</label>
										<input type="text" class="form-control" name="firstname" value="[@u_firstname]">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>[#lang_field_6]</label>
										<input type="text" class="form-control" name="lastname" value="[@u_lastname]">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>[#lang_field_7]</label>
										<input type="text" class="form-control" name="email" value="[@u_email]">
									</div>	
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>[#lang_field_8]</label>
										<input type="password" class="form-control" name="cpasswd" placeholder="[#lang_placeholder_1]">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>[#lang_field_9]</label>
										<input type="password" class="form-control" name="npasswd" placeholder="[#lang_placeholder_2]">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>[#lang_field_10]</label>
										<input type="password" class="form-control" name="cnpasswd">
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" name="eex_save">[#lang_btn_8]</button> <span class="pull-right"><button type="submit" class="btn btn-danger" name="eex_close">[#lang_btn_9]</button></span>
						</form>
                    </div>
                </div>
                <!--/.page-content-->
			</div>
        </div>
    </div>
    <!-- /.main-container -->
