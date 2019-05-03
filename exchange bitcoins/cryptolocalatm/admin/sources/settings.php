<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Web Settings</h1>
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
			$title = protect($_POST['title']);
			$description = protect($_POST['description']);
			$keywords = protect($_POST['keywords']);
			$name = protect($_POST['name']);
			$url = protect($_POST['url']);
			$infoemail = protect($_POST['infoemail']);
			$supportemail = protect($_POST['supportemail']);
			if(isset($_POST['document_verification'])) { $document_verification = '1'; } else { $document_verification = '0'; }
			if(isset($_POST['email_verification'])) { $email_verification = '1'; } else { $email_verification = '0'; }
			if(isset($_POST['phone_verification'])) { $phone_verification = '1'; } else { $phone_verification = '0'; }
			if(empty($title) or empty($description) or empty($keywords) or empty($name) or empty($url) or empty($infoemail) or empty($supportemail)) {
				echo error("All fields are required."); 
			} elseif(!isValidURL($url)) { 
				echo error("Please enter valid site url address.");
			} elseif(!isValidEmail($infoemail)) { 
				echo error("Please enter valid info email address.");
			} elseif(!isValidEmail($supportemail)) { 
				echo error("Please enter valid support email address.");
			} else {
				$update = $db->query("UPDATE easyex_settings SET title='$title',description='$description',keywords='$keywords',name='$name',url='$url',infoemail='$infoemail',supportemail='$supportemail',document_verification='$document_verification',email_verification='$email_verification',phone_verification='$phone_verification'");
				$settingsQuery = $db->query("SELECT * FROM easyex_settings ORDER BY id DESC LIMIT 1");
				$settings = $settingsQuery->fetch_assoc();
				echo success("Your changes was saved successfully.");
			}
		}
		?>
		<form action="" method="POST">
			<div class="form-group">
				<label>Title</label>
				<input type="text" class="form-control" name="title" value="<?php echo $settings['title']; ?>">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea class="form-control" name="description" rows="2"><?php echo $settings['description']; ?></textarea>
			</div>
			<div class="form-group">
				<label>Keywords</label>
				<textarea class="form-control" name="keywords" rows="2"><?php echo $settings['keywords']; ?></textarea>
			</div>
			<div class="form-group">
				<label>Site name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $settings['name']; ?>">
			</div>
			<div class="form-group">
				<label>Site url address</label>
				<input type="text" class="form-control" name="url" value="<?php echo $settings['url']; ?>">
			</div>
			<div class="form-group">
				<label>Info email address</label>
				<input type="text" class="form-control" name="infoemail" value="<?php echo $settings['infoemail']; ?>">
			</div>
			<div class="form-group">
				<label>Support email address</label>
				<input type="text" class="form-control" name="supportemail" value="<?php echo $settings['supportemail']; ?>">
			</div>
			<div class="checkbox">
					<label>
					  <input type="checkbox" name="document_verification" value="yes" <?php if($settings['document_verification'] == "1") { echo 'checked'; }?>> Document verification
					</label>
			</div>
			<div class="checkbox">
					<label>
					  <input type="checkbox" name="email_verification" value="yes" <?php if($settings['email_verification'] == "1") { echo 'checked'; }?>> Email verification
					</label>
			</div>
			<div class="checkbox">
					<label>
					  <input type="checkbox" name="phone_verification" value="yes" <?php if($settings['phone_verification'] == "1") { echo 'checked'; }?>> Mobile verification
					</label>
			</div>
			<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
		</form>
	</div>
</div>
</div>