<div style="clear:both;"></div>
<div class="col-md-2"></div>
	<div class="col-md-8">	
		<br>
		<div class="form-group">
			<label>[#lang_you_will_give]</label>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="0.0000000" id="eex_amount_send" name="eex_amount_send" value="[@default_send]" onkeyup="EasyExCalculator();" onkeydown="EasyExCalculator();">
				<span class="input-group-addon" id="basic-addon2">[@currency_from]</span>
			</div>
		</div>
		<div class="form-group">
			<span class="pull-left">[#lang_exchange_rate]: [@rate_from] [@currency_from] = [@rate_to] [@currency_to] [@extra_fee]</span>
			<span class="pull-right hidden-sm hidden-xs">[#lang_reserve]: [@reserve] [@currency_to]</span>
		</div><br><br>
		<div class="form-group">
			<h1><center><small>[#lang_you_will_get]</small><br/><b><span id="dam" style="color: #339966;">[@default_receive]</span> [@currency_to]</b></center></h1>
		</div>
		<input type="hidden" id="eex_rate_from" name="eex_rate_from" value="[@rate_from]">
		<input type="hidden" id="eex_rate_to" name="eex_rate_to" value="[@rate_to]">
		<input type="hidden" id="eex_currency_from" name="eex_currency_from" value="[@currency_from]">
		<input type="hidden" id="eex_currency_to" name="eex_currency_to" value="[@currency_to]">
		<input type="hidden" id="eex_amount_receive" name="eex_amount_receive" value="[@default_receive]">
		<input type="hidden" id="eex_sic1" name="eex_sic1" value="[@sic1]">
		<input type="hidden" id="eex_sic2" name="eex_sic2" value="[@sic2]">
</div>
<div class="col-md-2"></div>