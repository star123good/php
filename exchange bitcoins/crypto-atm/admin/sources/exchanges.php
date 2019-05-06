<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>

<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Exchanges</h1>
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
					<th width="10%">From</th>
					<th width="10%">To</th>
					<th width="20%">Amount send (receive)</th>
					<th width="20%">Exchange ID</th>
					<th width="10%">Status</th>
					<th width="10%">Action</th>
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
				$statement = "easyex_exchanges";
				if($searching==1) {
					if(empty($qry)) {
						$qry = 'empty query';
					}
					$query = $db->query("SELECT * FROM {$statement} WHERE id LIKE '%$qry%' or exchange_id LIKE '%$qry%' ORDER BY id");
				} else {
					$query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
				}
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php if($row['wid']>0) { echo 'Wallet '.walletinfo($row['wid'],"currency"); } else { echo gatewayinfo($row['gateway_send'],"name"); ?> <?php echo gatewayinfo($row['gateway_send'],"currency"); } ?></td>
							<td><?php echo gatewayinfo($row['gateway_receive'],"name"); ?> <?php echo gatewayinfo($row['gateway_receive'],"currency"); ?></td>
							<td><?php echo $row['amount_send']; ?> <?php echo gatewayinfo($row['gateway_send'],"currency"); ?> (<?php echo $row['amount_receive']; ?> <?php echo gatewayinfo($row['gateway_receive'],"currency"); ?>)</td>
							<td><span class="label label-default"><?php echo $row['exchange_id']; ?></span></td>
							<td>
								<?php
										echo getStatus($row['status'],2);
										?>
							</td>
							<td>
								<a href="javascript:void(0);" onclick="EEXAdmin_CreateModal('explore','<?php echo $row['id']; ?>');" title="Explore"><i class="fa fa-search"></i> Explore</a>
							</td>
						</tr>
						<?php
					}
				} else {
					if($searching == "1") {
						echo '<tr><td colspan="8">No found results for <b>'.$qry.'</b>.</td></tr>';
					} else {
						echo '<tr><td colspan="8">Still no have exchanges.</td></tr>';
					}
				}
				?>
			</tbody>
		</table>
		<?php
		if($searching == "0") {
			$ver = "./?a=exchanges";
			if(admin_pagination($statement,$ver,$limit,$page)) {
				echo admin_pagination($statement,$ver,$limit,$page);
			}
		}
		?>
	</div>
	</div>
</div>