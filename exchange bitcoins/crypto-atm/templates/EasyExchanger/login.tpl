<div class="main-container">
        <div class="container">
			<div class="row">
				<div class="col-sm-5 login-box">
                    <div class="panel panel-default">
                        <div class="panel-body">
							[@results]
                            <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">[#lang_field_7]:</label>
                                    <div class="input-icon"><i class="icon-user fa"></i>
                                        <input id="sender-email" type="text" name="email" placeholder="[#lang_field_7]" class="form-control email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user-pass" class="control-label">[#lang_field_17]:</label>
                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" class="form-control" name="password" placeholder="[#lang_field_17]" id="user-pass">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="eex_login" class="btn btn-primary  btn-block">[#lang_btn_20]</button>
                                </div>
                           
                        </div>
                        <div class="panel-footer">

                            <div class="checkbox pull-left">
                                <label> <input type="checkbox" value="yes" name="remember" id="remember"> [#lang_keep_me_logged_in]</label>
                            </div>

 </form>
                            <p class="text-center pull-right"><a href="[@url]password/reset"> [#lang_forgot_password] </a></p>

                            <div style=" clear:both"></div>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p> [#lang_do_not_have_an_account] <br>
                            <a href="[@url]register"><strong>[#lang_sign_up]</strong> </a></p>
                    </div>
                </div>
			</div>
        </div>
    </div>
    <!-- /.main-container -->
