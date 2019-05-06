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
				<h3>You have new exchange order <b>#{@exchange_id}</b></h3>
				<h4>Exchange <b>{@from} {@from_c}</b> to <b>{@to} {@to_c}</b></h4>
				<h5>Amount: {@amount_s} {@from_c} ({@amount_r} {@to_c})</h5>
				<h5><a href="{@url}pay/{@exchange_id}">Click here to pay it.</a></h5>
				<br><br>
				Regards,
				{@site_name}
			</center>
		</td>
	</tr>
</tbody>
</table>