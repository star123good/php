<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$b = protect($_GET['b']);

if($b == "edit") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_users WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=users"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit user</li>
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
				$username = protect($_POST['username']);
				$email = protect($_POST['email']);
				$newpass = protect($_POST['newpass']);
				$status = protect($_POST['status']);
				$mobile_number = protect($_POST['mobile_number']);
				if(isset($_POST['email_verified'])) { $email_verified = '1'; } else { $email_verified = '0'; }
				if(isset($_POST['document_verified'])) { $document_verified = '1'; } else { $document_verified = '0'; }
				if(isset($_POST['mobile_verified'])) { $mobile_verified = '1'; } else { $mobile_verified = '0'; } 
				$check_u = $db->query("SELECT * FROM easyex_users WHERE username='$username'");
				$check_e = $db->query("SELECT * FROM easyex_users WHERE email='$email'");
				if(empty($username) or empty($email) or empty($status)) { echo error("Please enter username,email and status."); }
				elseif($row['username'] !== $username && $check_u->num_rows>0) { echo error("This username is already used. Please choose another."); }
				elseif($row['email'] !== $email && $check_e->num_rows>0) { echo errro("This email address is already used. Please choose another."); }
				else {
					if($newpass) { $npass = md5($newpass); } else { $npass = $row['password']; } 
					$update = $db->query("UPDATE easyex_users SET username='$username',email='$email',password='$npass',status='$status',mobile_number='$mobile_number',email_verified='$email_verified',document_verified='$document_verified',mobile_verified='$mobile_verified' WHERE id='$row[id]'");
					echo success("Your changes was saved successfully.");
					$query = $db->query("SELECT * FROM easyex_users WHERE id='$id'");
					$row = $query->fetch_assoc();
				}
			}
			
			$c = protect($_GET['c']);
			if($c == "delete_document_1") {
				$file = '../'.$row[document_1];
				$update = $db->query("UPDATE easyex_users SET document_1='' WHERE id='$row[id]'");
				@unlink($file);
				echo success("Document 1 was deleted successfully.");
				echo '<meta http-equiv="refresh" content="3; url=./?a=users&b=edit&id='.$row[id].'" />';
				$query = $db->query("SELECT * FROM easyex_users WHERE id='$id'");
				$row = $query->fetch_assoc();
			}
			
			if($c == "delete_document_2") {
				$file = '../'.$row[document_2];
				$update = $db->query("UPDATE easyex_users SET document_2='' WHERE id='$row[id]'");
				@unlink($file);
				echo success("Document 2 was deleted successfully.");
				echo '<meta http-equiv="refresh" content="3; url=./?a=users&b=edit&id='.$row[id].'" />';
				$query = $db->query("SELECT * FROM easyex_users WHERE id='$id'");
				$row = $query->fetch_assoc();
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
				</div>
				<div class="form-group">
					<label>Email address</label>
					<input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
				</div>
				<div class="form-group">
					<label>New password</label>
					<input type="text" class="form-control" name="newpass" placeholder="Leave empty if do not want to change it.">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
						<option value="1" <?php if($row['status'] == "1") { echo 'selected'; } ?>>Not verified</option>
						<option value="2" <?php if($row['status'] == "2") { echo 'selected'; } ?>>Banned</option>
						<option value="3" <?php if($row['status'] == "3") { echo 'selected'; } ?>>Verified</option>
						<option value="666" <?php if($row['status'] == "666") { echo 'selected'; } ?>>Administrator</option>
						<option value="777" <?php if($row['status'] == "777") { echo 'selected'; } ?>>Operator</option>
					</select>
				</div>
				<div class="form-group">
					<label>Mobile number</label>
					<input type="text" class="form-control" name="mobile_number" value="<?php echo $row['mobile_number']; ?>">
				</div>
				<div class="checkbox">
					<label>
					  <input type="checkbox" name="email_verified" value="yes" <?php if($row['email_verified'] == "1") { echo 'checked'; }?>> Email verified
					</label>
				  </div>
				 <div class="checkbox">
					<label>
					  <input type="checkbox" name="document_verified" value="yes" <?php if($row['document_verified'] == "1") { echo 'checked'; }?>> Document verified
					</label>
				  </div>
				 <?php if($row['document_1'] or $row['document_2']) { ?>
				 <table class="table table-striped">
					<thead>
						<tr><th colspan="2"><b>Attached files:</b></th></tr>
						<tr>
							<th>Filename</th>
							<th>Filesize</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if($row['document_1']) { ?>
						<tr>
							<td><a href="<?php echo $settings['url'].$row['document_1']; ?>" target="_blank"><?php echo basename($row['document_1']); ?></a></td>
							<td><?php $filepath = '../'.$row[document_1]; $filesize = filesize($filepath); echo formatBytes($filesize); ?> </td>
							<td><a href="./?a=users&b=edit&id=<?php echo $row['id']; ?>&c=delete_document_1"><i class="fa fa-times"></i> Delete</a></td>
						</tr>
						<?php } ?>
						<?php if($row['document_2']) { ?>
						<tr>
							<td><a href="<?php echo $settings['url'].$row['document_2']; ?>" target="_blank"><?php echo basename($row['document_2']); ?></a></td>
							<td><?php $filepath = '../'.$row[document_2]; $filesize = filesize($filepath); echo formatBytes($filesize); ?> </td>
							<td><a href="./?a=users&b=edit&id=<?php echo $row['id']; ?>&c=delete_document_2"><i class="fa fa-times"></i> Delete</a></td>
						</tr>
						<?php } ?>
					</tbody>
				 </table>
				 <?php } ?>
				 <div class="checkbox">
					<label>
					  <input type="checkbox" name="mobile_verified" value="yes" <?php if($row['mobile_verified'] == "1") { echo 'checked'; }?>> Mobile verified
					</label>
				  </div>
				<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
			</form>
		</div>
		</div>
	</div>
	<?php
} elseif($b == "delete") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_users WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=users"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Delete user</li>
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
			if(isset($_GET['confirm'])) {
				$delete = $db->query("DELETE FROM easyex_users WHERE id='$row[id]'");
				$delete = $db->query("DELETE FROM easyex_exchanges WHERE uid='$row[id]'");
				echo success("User <b>$row[username]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete user <b>$row[username]</b>?");
				echo '<a href="./?a=users&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=users" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
			}
			?>
		</div>
	</div>
	</div>
	<?php
} else {
?>
<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <span class="pull-right" style="margin-top:5px;margin-bottom:-10px;">
							<form action="" method="POST">
								<input type="text" class="form-control" name="qry" placeholder="Search...">
							</form>
						</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="15%">Username</th>
					<th width="15%">Email</th>
					<th width="12%">Status</th>
					<th width="10%">Email verified</th>
					<th width="13%">Document verified</th>
					<th width="10%">Mobile verified</th>
					<th width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$searching=0;
				if(isset($_POST['qry'])) {
					$searching=1;
					$qry = protect($_POST['qry']);
				}
				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				$limit = 20;
				$startpoint = ($page * $limit) - $limit;
				if($page == 1) {
					$i = 1;
				} else {
					$i = $page * $limit;
				}
				$statement = "easyex_users";
				if($searching==1) {
					if(empty($qry)) {
						$qry = 'empty query';
					}
					$query = $db->query("SELECT * FROM {$statement} WHERE id LIKE '%$qry%' or username LIKE '%$qry%' or email LIKE '%$qry%' ORDER BY id");
				} else {
					$query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
				}
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td>
								<?php
								if($row['status'] == "1") {
									echo '<span class="label label-warning">Not verified</span>';
								} elseif($row['status'] == "2") {
									echo '<span class="label label-danger">Banned</span>';
								} elseif($row['status'] == "3") {
									echo '<span class="label label-success">Verified</span>';
								} elseif($row['status'] == "666") {
									echo '<span class="label label-info">Administrator</label>';
								} elseif($row['status'] == "777") {
									echo '<span class="label label-primary">Operator</label>';
								} else {
									echo '<span class="label label-default">Unknown</span>';
								}
								?>
							</td>
							<td>
								<?php
								if($row['email_verified'] == "1") {
									echo '<span class="label label-success"><i class="fa fa-check"></i> Yes</span>';
								} else {
									echo '<span class="label label-danger"><i class="fa fa-times"></i> No</span>';
								}
								?>
							</td><td>
								<?php
								if($row['document_verified'] == "1") {
									echo '<span class="label label-success"><i class="fa fa-check"></i> Yes</span>';
								} else {
									if($row['document_1']) {
										echo '<span class="label label-info"><i class="fa fa-clock-o"></i> Awaiting approval</span>'; 
									} else {
										echo '<span class="label label-danger"><i class="fa fa-times"></i> No</span>';
									}
								}
								?>
							</td>
							<td>
								<?php
								if($row['mobile_verified'] == "1") {
									echo '<span class="label label-success"><i class="fa fa-check"></i> Yes</span>';
								} else {
									echo '<span class="label label-danger"><i class="fa fa-times"></i> No</span>';
								}
								?>
							</td>
							<td>
								<a href="./?a=users&b=edit&id=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a> 
								<a href="./?a=users&b=delete&id=<?php echo $row['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php
					}
				} else {
					if($searching == "1") {
						echo '<tr><td colspan="8">No found results for <b>'.$qry.'</b>.</td></tr>';
					} else {
						echo '<tr><td colspan="8">Still no have users.</td></tr>';
					}
				}
				?>
			</tbody>
		</table>
		<?php
		if($searching == "0") {
			$ver = "./?a=users";
			if(admin_pagination($statement,$ver,$limit,$page)) {
				echo admin_pagination($statement,$ver,$limit,$page);
			}
		}
		?>
	</div>
</div>
</div>
<?php
}
?>