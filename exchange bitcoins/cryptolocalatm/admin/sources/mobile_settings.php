<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Mobile Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
		<?php
		if(isset($_POST['btn_save'])) {
			$nexmo_api_key = protect($_POST['nexmo_api_key']);
			$nexmo_api_secret = protect($_POST['nexmo_api_secret']);
			if(empty($nexmo_api_key)) {
				echo error("Please enter Nexmo API Key."); 
			} elseif(empty($nexmo_api_secret)) {
				echo error("Please enter Nexmo API Secret.");
			} else {
				$update = $db->query("UPDATE easyex_settings SET nexmo_api_key='$nexmo_api_key',nexmo_api_secret='$nexmo_api_secret'");
				$settingsQuery = $db->query("SELECT * FROM easyex_settings ORDER BY id DESC LIMIT 1");
				$settings = $settingsQuery->fetch_assoc();
				echo success("Your changes was saved successfully.");
			}
		}
		?>
		<form action="" method="POST">
			<div class="form-group">
				<label>Here enter your NEXMO details if enable in some gateway mobile verification.</label>
			</div>
			<div class="form-group">
				<label>Nexmo API Key</label>
				<input type="text" class="form-control" name="nexmo_api_key" value="<?php echo $settings['nexmo_api_key']; ?>">
				<small>Type Nexmo API Key if you turned on mobile verification. Get api key form <a href="http://nexmo.com" target="_blank">www.nexmo.com</a></small>
			</div>
			<div class="form-group">
				<label>Nexmo API Secret</label>
				<input type="text" class="form-control" name="nexmo_api_secret" value="<?php echo $settings['nexmo_api_secret']; ?>">
				<small>Type Nexmo API Secret if you turned on mobile verification. Get api key form <a href="http://nexmo.com" target="_blank">www.nexmo.com</a></small>
			</div>
			<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
		</form>
	</div>
</div>
</div>