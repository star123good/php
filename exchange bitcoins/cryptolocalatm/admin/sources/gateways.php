<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$b = protect($_GET['b']);

if($b == "add_merchant") {
	include("gateways/add_merchant.php");
} elseif($b == "add_crypto") {
	include("gateways/add_crypto.php");
} elseif($b == "add_manual") {
	include("gateways/add_manual.php");
} elseif($b == "edit_merchant") {
	include("gateways/edit_merchant.php");
} elseif($b == "edit_crypto") {
	include("gateways/edit_crypto.php");
} elseif($b == "edit_manual") {
	include("gateways/edit_manual.php");
} elseif($b == "delete") {
	include("gateways/delete.php");
} elseif($b == "directions") {
	include("gateways/directions.php");
} elseif($b == "rates") {
	include("gateways/rates.php");
} else {
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
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
							
						<a href="./?a=gateways&b=add_merchant" class="btn btn-primary">Add merchant</a> 
						<a href="./?a=gateways&b=add_crypto" class="btn btn-primary">Add cryptocurrency</a>
						<a href="./?a=gateways&b=add_manual" class="btn btn-primary">Add manual payment</a>
						<br><br>
						
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="40%">Gateway</th>
									<th width="20%">Min/Max Amount</th>
									<th width="20%">Reserve</th>
									<th width="5%">Fee</th>
									<th width="15%">Allow send</th>
									<th width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query = $db->query("SELECT * FROM easyex_gateways ORDER BY id");
								if($query->num_rows>0) { 
									while($row = $query->fetch_assoc()) {
									?>
									<tr>
										<td>
											<?php 
											if($row['exchange_type'] == "2") { 
												echo '<span class="badge badge-primary">merchant</span> ';
											} elseif($row['exchange_type'] == "3") {
												echo '<span class="badge badge-danger">manually</span> ';
											} elseif($row['exchange_type'] == "4") {
												echo '<span class="badge badge-warning">crypto</span> ';
											} else { } ?>
											<?php echo $row['name']." ".$row['currency']; ?>
										</td>
										<td><?php echo $row['min_amount']." ".$row['currency']; ?>/<?php echo $row['max_amount']." ".$row['currency']; ?></td>
										<td><?php echo $row['reserve']." ".$row['currency']; ?></td>
										<td><?php echo $row['fee']; ?>%</td>
										<td><i class="fa fa-check"></i></td>
										<td>
											<div class="btn-group">
												<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-sm btn-primary">Action</button>
												<div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
												  <button type="button" onclick="window.location.href='./?a=gateways&b=directions&id=<?php echo $row['id']; ?>';" tabindex="0" class="dropdown-item">Manage directions</button>
												  <button type="button" onclick="window.location.href='./?a=rates';" tabindex="0" class="dropdown-item">Manage exchange rates</button>
												  <?php if($row['exchange_type'] == "2") { ?>
												  <button type="button" onclick="window.location.href='./?a=gateways&b=edit_merchant&id=<?php echo $row['id']; ?>';" tabindex="0" class="dropdown-item">Edit gateway</button>
												  <?php } elseif($row['exchange_type'] == "3") { ?>
												  <button type="button" onclick="window.location.href='./?a=gateways&b=edit_manual&id=<?php echo $row['id']; ?>';" tabindex="0" class="dropdown-item">Edit gateway</button>
												  <?php } elseif($row['exchange_type'] == "4") { ?>
												  <button type="button" onclick="window.location.href='./?a=gateways&b=edit_crypto&id=<?php echo $row['id']; ?>';" tabindex="0" class="dropdown-item">Edit gateway</button>
												  <?php } else { } ?>
												  <div tabindex="-1" class="dropdown-divider"></div>
												  <button type="button" onclick="window.location.href='./?a=gateways&b=delete&id=<?php echo $row['id']; ?>';" tabindex="0" class="dropdown-item">Delete gateway</button>
												</div>
											  </div>
										</td>
									</tr>
									<?php
									}
								} else {
									echo '<tr><td colspan="6">Still no have gateways.</td></tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
<?php
}
?>