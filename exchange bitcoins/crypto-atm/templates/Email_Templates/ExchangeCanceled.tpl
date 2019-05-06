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
				<h3>Your exchange <b>#{@exchange_id}</b> was canceled.</h3>
				<h5>If you have any questions please contact with {@supportemail}.</h5>
				<br><br>
				Regards,
				{@site_name}
			</center>
		</td>
	</tr>
</tbody>
</table>