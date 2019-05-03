<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_gateways_directions WHERE gateway_id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=gateways"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Gateways</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit exchange direction</li>
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
			if(isset($_POST['btn_update'])) {
				$imp = implode(",",$_POST['directions']);
				$update = $db->query("UPDATE easyex_gateways_directions SET directions='$imp' WHERE id='$row[id]'");
				$query = $db->query("SELECT * FROM easyex_gateways_directions WHERE id='$row[id]'");
				$row = $query->fetch_assoc();
				echo success("Your changes was saved successfully.");
			}
			?>
			<form action="" method="POST">
			<div class="row">
				<div class="col-md-4">
					<h3>Send</h3>
					<div><span style="font-size:26px;"><?php echo gatewayinfo($row['gateway_id'],"name")." ".gatewayinfo($row['gateway_id'],"currency"); ?></span></div>
				</div>
				<div class="col-md-4">
					<br><br><br>
					<center>
						<i class="fa fa-arrow-right fa-3x"></i>
					</center>
				</div>
				<div class="col-md-4">
					<h3>Receive</h3>
					<?php
					$arr = explode(",",$row['directions']);
					$getquery = $db->query("SELECT * FROM easyex_gateways ORDER BY id");
					if($getquery->num_rows>0) {
						while($get = $getquery->fetch_assoc()) {
							if(in_array($get['id'],$arr)) { $ch = 'checked="checked"'; } else { $ch = ''; }
							?>
							<div class="checkbox" style="font-size:18px;">
							<label>
							  <input type="checkbox" name="directions[]" value="<?php echo $get['id']; ?>" <?php echo $ch; ?>> <?php echo $get['name']." ".$get['currency']; ?>
							</label>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<button type="submit" class="btn btn-primary" name="btn_update"><i class="fa fa-check"></i> Update list</button>
			</form>
		</div>
	</div>
	</div>
