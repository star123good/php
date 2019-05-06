	<form id="eex_exchanger_form">
	<div class="main-container">
        <div class="container">
            <div class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category" id="from_gateways">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2>[#lang_homepage_content_1]</h2>
                        </div>
                    </div>

                    [@ExchangeFromList]

                </div>


            </div>

            <div style="clear: both"></div>

			
			<div id="box_exchange_to" class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category" id="to_gateways">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2>[#lang_homepage_content_2]</h2>
                        </div>
                    </div>
					
					<span id="box_exchange_to_content">
                    
					</span>

                </div>


            </div>
			
			 <div style="clear: both"></div>

			
			<div id="box_exchange_amount" class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2>[#lang_homepage_content_3]</h2>
                        </div>
                    </div>
						<span id="box_exchange_amount_content">
					
						</span>
                </div>
            </div>
			
			<div id="box_exchange_account" class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2>[#lang_homepage_content_4]</h2>
                        </div>
                    </div>
						<span id="box_exchange_account_content">
						
						</span>
                </div>
            </div>
			
			<div id="box_important_information" class="col-lg-12 content-box ">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner"><h2>[#lang_homepage_content_5]</h2>
                        </div>
                    </div>
						<span id="box_important_information_content">
				
						</span>
                </div>
            </div>
			
			<input type="hidden" id="eex_gateway_send" name="eex_gateway_send">
			<input type="hidden" id="eex_gateway_receive" name="eex_gateway_receive">
			<input type="hidden" id="eex_require_login" name="eex_require_login">
			<input type="hidden" id="eex_require_email_verify" name="eex_require_email_verify">
			<input type="hidden" id="eex_require_mobile_verify" name="eex_require_mobile_verify">
			<input type="hidden" id="eex_require_document_verify" name="eex_require_document_verify">
			<button type="button" class="btn btn-primary btn-lg btn-block" id="btn_exchange" onclick="MakeExchange();"><i id="btn_exchange_i" class="fa fa-refresh"></i> [#lang_btn_12]</button>

		</div>
	</div>
	</form>
	