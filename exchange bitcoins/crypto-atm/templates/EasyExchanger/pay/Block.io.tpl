
			<div class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2><span>[#lang_pay_exchange]</span> #[@exchange_id] </h2>
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
										<td colspan="2" style="padding-top:30px;"><b>[#lang_you_need_to_pay]<b></td>
									</tr>
									<tr>
										<td>[#lang_amount]:</td>
										<td><span class="pull-right">[@amount_send] [@gateway_send_currency]</span></td>
									</tr>
									<tr>
										<td>[@gateway_send] [#lang_transaction_fee]:</td>
										<td><span class="pull-right">[@extra_fee]</span></td>
									</tr>
									<tr>
										<td>[#lang_total]:</td>
										<td><span class="pull-right">[@amount_total] [@gateway_send_currency]</span></td>
									</td>
									<tr>
										<td>[#lang_payment_note]:</td>
										<td><span class="pull-right">Exchange #[@exchange_id] [@amount_send] [@gateway_send_currency] ([@amount_receive] [@gateway_receive_currency])</span></td>
									</td>
									<tr>
										<td colspan="2" style="padding-top:30px;padding-bottom:30px;">
											<span style="font-size:15px;"><center>[#lang_send] <b>[@amount_total] [@gateway_send_currency]</b> [#lang_to_address] <b>[@address]</b></center></span>
											<center>
												<br>
												<button type="button" onclick="eex_checkPayment('[@exchange_id]','[@gateway_send_id]','[@gateway_send]','[@gateway_send_currency]','[@amount_total]','[@address]','block.io');" class="btn btn-primary">[#lang_btn_15]</button>
											</center>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-top:30px;"><b>[#lang_you_will_receive]</b></td>
									</tr>
									<tr>
										<td>[#lang_amount]:</td>
										<td><span class="pull-right">[@amount_receive] [@gateway_receive_currency]</span></td>
									</tr>
									<tr>
										<td>[#lang_to] [@gateway_receive] [@acc_type]:</td>
										<td><span class="pull-right">[@u_acc]</span></td>
									</tr>
									<tr>
										<td colspan="2">
											[@additional_information]
										</td>
									</tr>
								</tbody>
							</table>
							<center>
								<a href="[@url]cancel/[@exchange_id]">[#lang_paypage_content_2]</a> [#lang_paypage_content_3].
							</center>
						</div>
						<div class="col-md-2"></div>
                </div>
            </div>
