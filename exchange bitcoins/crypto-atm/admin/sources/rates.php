<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
$b = protect($_GET['b']);

if($b == "add") {
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Exchange Rates</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Add exchange rate</li>
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
			if(isset($_POST['btn_add'])) {
				$gateway_from = protect($_POST['gateway_from']);
				$gateway_to = protect($_POST['gateway_to']);
				$rate_from = protect($_POST['rate_from']);
				$rate_to = protect($_POST['rate_to']);
				$check = $db->query("SELECT * FROM easyex_rates WHERE gateway_from='$gateway_from' and gateway_to='$gateway_to'");
				if(empty($gateway_from) or empty($gateway_to) or empty($rate_from) or empty($rate_to)) { echo error("All fields are required."); }
				elseif($check->num_rows>0) { echo error("This exchange rate already exists."); }
				elseif(!is_numeric($rate_from)) { echo error("Please enter rate from with numbers."); }
				elseif(!is_numeric($rate_to)) { echo error("Please enter rate to with numbers."); }
				else {
					$insert = $db->query("INSERT easyex_rates (gateway_from,gateway_to,rate_from,rate_to) VALUES ('$gateway_from','$gateway_to','$rate_from','$rate_to')");
					echo success("Exchange rate was added successfully.");
				}
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
					<label>Gateway from</label>
					<select class="form-control" name="gateway_from">
						<?php
						$list = $db->query("SELECT * FROM easyex_gateways WHERE status='1' ORDER BY id");
						if($list->num_rows>0) {
							while($l = $list->fetch_assoc()) {
								echo '<option value="'.$l[id].'">'.$l[name].' '.$l[currency].'</option>';
							}
						} else {
							echo '<option>No have gateways.</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Gateway to</label>
					<select class="form-control" name="gateway_to">
						<?php
						$list = $db->query("SELECT * FROM easyex_gateways WHERE status='1' ORDER BY id");
						if($list->num_rows>0) {
							while($l = $list->fetch_assoc()) {
								echo '<option value="'.$l[id].'">'.$l[name].' '.$l[currency].'</option>';
							}
						} else {
							echo '<option>No have gateways.</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Rate from</span>
						<input type="text" class="form-control" name="rate_from" placeholder="1" aria-describedby="basic-addon1">
						<span class="input-group-addon" id="basic-addon1">=&nbsp;&nbsp; Rate to</span>
						<input type="text" class="form-control" name="rate_to" placeholder="0.95" aria-describedby="basic-addon1">
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="btn_add"><i class="fa fa-plus"></i> Add</button>
			</form>		
		</div>
		</div>
	</div>
	<?php
} elseif($b == "edit") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_rates WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=rates"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Exchange Rates</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit exchange rate</li>
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
				$gateway_from = protect($_POST['gateway_from']);
				$gateway_to = protect($_POST['gateway_to']);
				$rate_from = protect($_POST['rate_from']);
				$rate_to = protect($_POST['rate_to']);
				if(empty($rate_from) or empty($rate_to)) { echo error("All fields are required."); }
				elseif(!is_numeric($rate_from)) { echo error("Please enter rate from with numbers."); }
				elseif(!is_numeric($rate_to)) { echo error("Please enter rate to with numbers."); }
				else {
					$update = $db->query("UPDATE easyex_rates SET rate_from='$rate_from',rate_to='$rate_to' WHERE id='$row[id]'");
					$query = $db->query("SELECT * FROM easyex_rates WHERE id='$id'");
					$row = $query->fetch_assoc();
					echo success("Your changes was saved successfully.");
				}
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
					<label>Gateway from</label>
					<select class="form-control" name="gateway_from" disabled>
						<?php
						$list = $db->query("SELECT * FROM easyex_gateways WHERE allow_send='1' and status='1' ORDER BY id");
						if($list->num_rows>0) {
							while($l = $list->fetch_assoc()) {
								if($row['gateway_from'] == $l['id']) { $sel = 'selected'; } else { $sel = ''; }
								echo '<option value="'.$l[id].'" '.$sel.'>'.$l[name].' '.$l[currency].'</option>';
							}
						} else {
							echo '<option>No have gateways.</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Gateway to</label>
					<select class="form-control" name="gateway_to" disabled>
						<?php
						$list = $db->query("SELECT * FROM easyex_gateways WHERE allow_receive='1' and status='1' ORDER BY id");
						if($list->num_rows>0) {
							while($l = $list->fetch_assoc()) {
								if($row['gateway_to'] == $l['id']) { $sel = 'selected'; } else { $sel = ''; } 
								echo '<option value="'.$l[id].'" '.$sel.'>'.$l[name].' '.$l[currency].'</option>';
							}
						} else {
							echo '<option>No have gateways.</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Rate from</span>
						<input type="text" class="form-control" name="rate_from" value="<?php echo $row['rate_from']; ?>" placeholder="1" aria-describedby="basic-addon1">
						<span class="input-group-addon" id="basic-addon1">=&nbsp;&nbsp; Rate to</span>
						<input type="text" class="form-control" name="rate_to" value="<?php echo $row['rate_to']; ?>" placeholder="0.95" aria-describedby="basic-addon1">
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
			</form>
		</div>
	</div>
	<?php
} elseif($b == "delete") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_rates WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=rates"); }
	$row = $query->fetch_assoc();
	$rate_from = $row['rate_from'];
	$rate_to =$row['rate_to'];
	$currency_from = gatewayinfo($row['gateway_from'],"currency");
	$currency_to = gatewayinfo($row['gateway_to'],"currency");
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Exchange Rates</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Delete exchange rate</li>
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
				$delete = $db->query("DELETE FROM easyex_rates WHERE id='$row[id]'");
				echo success("Exchange rate <b>$rate_from $currency_from = $rate_to $currency_to</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete exchange rate <b>$rate_from $currency_from = $rate_to $currency_to</b>?");
				echo '<a href="./?a=rates&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=rates" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
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
                        <h1>Exchange Rates</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li><a href="./?a=rates&b=add"><i class="fa fa-plus"></i> New</a></li>
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
		echo info("NOTE! Script used mconvert.net Currency Convertor API to take real exchange rate of all international currencies, so you only enter your fee in the gateuey and do not have to constantly update the exchange rate. Also take and the market of all cryptocurrencies from coinmarketcap and convert it by your fee. If the exchange rate is not shown automatically, you can use this page to add fixed rate.");
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="30%">Gateway from</th>
					<th width="30%">Gateway to</th>
					<th width="30%">Exchange rate</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				$limit = 20;
				$startpoint = ($page * $limit) - $limit;
				if($page == 1) {
					$i = 1;
				} else {
					$i = $page * $limit;
				}
				$statement = "easyex_rates";
				$query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo gatewayinfo($row['gateway_from'],"name"); ?> <?php echo gatewayinfo($row['gateway_from'],"currency"); ?></td>
							<td><?php echo gatewayinfo($row['gateway_to'],"name"); ?> <?php echo gatewayinfo($row['gateway_to'],"currency"); ?></td>
							<td><?php echo $row['rate_from']; ?> <?php echo gatewayinfo($row['gateway_from'],"currency"); ?> = <?php echo $row['rate_to']; ?> <?php echo gatewayinfo($row['gateway_to'],"currency"); ?></td>
							<td>
								<a href="./?a=rates&b=edit&id=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a> 
								<a href="./?a=rates&b=delete&id=<?php echo $row['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php
					}
				} else {
					echo '<tr><td colspan="4">Still no have rates. <a href="./?a=rates&b=add">Click here</a> to add.</td></tr>';
				}
				?>
			</tbody>
		</table>
		<?php
		$ver = "./?a=rates";
		if(admin_pagination($statement,$ver,$limit,$page)) {
			echo admin_pagination($statement,$ver,$limit,$page);
		}
		?>
	</div>
</div>
</div>
<?php
}
?>