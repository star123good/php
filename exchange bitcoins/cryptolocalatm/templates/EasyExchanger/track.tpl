<div class="main-container">
        <div class="container">
            <div class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2><span>[#lang_track_exchange] #[@exchange_id]</span></h2>
                        </div>
                    </div>
						<div style="clear:both;"></div>
						<div class="col-md-2"></div>
						<div class="col-md-8" style="padding-top:20px;padding-bottom:20px;" id="eex_exchange_box">
							<table class="table table-striped table-responsive">
								<tbody>
									<tr>
										<td colspan="2" style="padding-top:30px;padding-bottom:20px;">
											<center>
												<h3><img src="[@gateway_send_icon]" class="img-circle" width="30px"> [@gateway_send] [@gateway_send_currency] <i class="fa fa-arrow-right"></i> <img src="[@gateway_receive_icon]" class="img-circle" width="30px"> [@gateway_receive] [@gateway_receive_currency]</h3>
											</center>
										</td>
									</tr>
									<tr>
										<td>
											<table class="table table-striped table-responsive">
												<thead>
												<tr>
													<th colspan="2" style="padding-top:30px;"><b>[#lang_send]<b></th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td>[#lang_amount]:</td>
													<td><span class="pull-right">[@amount_send] [@gateway_send_currency]</span></td>
												</tr>
												<tr>
													<td colspan="2" style="padding-top:30px;"><b>[#lang_receive]</b></td>
												</tr>
												<tr>
													<td>[#lang_amount]:</td>
													<td><span class="pull-right">[@amount_receive] [@gateway_receive_currency]</span></td>
												</tr>
												<tr>
													<td>[#lang_to] [@gateway_receive] [@acc_type]:</td>
													<td><span class="pull-right">[@u_acc]</span></td>
												</tr>
												</tbody>
											</table>
											<br>
											<table class="table table-striped table-responsive">
												<tbody>
													<tr>
														<td>[#lang_created_on]:</td>
														<td><span class="pull-right">[@created_on]</span></td>
													</tr>
													[@updated_on]
													[@expired_on]
													<tr>
														<td>[#lang_status]:</td>
														<td><span class="pull-right">[@status]</span></td>
													</tr>
												</tbody>
											</table>	
											<br>
											<table class="table table-striped table-responsive">
												<thead>
													<tr>
														<th colspan="2">[#lang_activity]</th>
													</tr>
												</thead>
												<tbody>
													[@activity]
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.main-container -->
