<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_gateways WHERE id='$id'");
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
							<li>Delete gateway</li>
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
				$delete = $db->query("DELETE FROM easyex_gateways WHERE id='$row[id]'");
				$delete = $db->query("DELETE FROM easyex_exchanges WHERE gateway_send='$row[id]'");
				$delete = $db->query("DELETE FROM easyex_exchanges WHERE gateway_receive='$row[id]'");
				$delete = $db->query("DELETE FROM easyex_rates WHERE gateway_from='$row[id]'");
				$delete = $db->query("DELETE FROM easyex_rates WHERE gateway_to='$row[id]'");
				$delete = $db->query("DELETE FROM easyex_gateways_directions WHERE gateway_id='$row[id]'");
				echo success("Gateway <b>$row[name] $row[currency]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete gateway <b>$row[name] $row[currency]</b>?");
				echo '<a href="./?a=gateways&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=gateways" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
			}
			?>
		</div>
	</div>
	</div>