<style type="text/css">
	.tab_emailtemplate {
		border:1px solid #c1c1c1;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		padding:10px;
	}
	.tab_emailtemplate tbody {
		padding:20px;
	}
	.tab_emailtemplate tbody > tr {
		padding:20px;
	}
</style>
<table width="600px" align="center" class="tab_emailtemplate">
<tbody style="padding:20px;">
	<tr>
		<td><img src="{@url}templates/Email_Templates/logo.png" alt="{@site_name}"><br><br></td>
	</tr>
	<tr>
		<td>
			<center>
				<h3>We receive your payment for order <b>#{@exchange_id}</b></h3>
				<h5>Amount: {@amount_s} {@from_c}</h5>
				<h5>The transaction will be terminated shortly when the transaction is confirmed manually by an operator. It takes a few minutes depending on whether it is a business day.</h5>
				<br><br>
				Regards,
				{@site_name}
			</center>
		</td>
	</tr>
</tbody>
</table>