<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

$b = protect($_GET['b']);

if($b == "approve") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_feedbacks WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=feedbacks"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Feedbacks</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Approve feedback</li>
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
			$update = $db->query("UPDATE easyex_feedbacks SET status='1' WHERE id='$row[id]'");
			echo success("Feedback was approved.");
			echo '<meta http-equiv="refresh" content="3; url=./?a=feedbacks" />';
			?>
		</div>
	</div>
	</div>
	<?php
} elseif($b == "delete") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_feedbacks WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=feedbacks"); }
	$row = $query->fetch_assoc();
	$user = idinfo($row['uid'],"username");
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Feedbacks</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Delete feedback</li>
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
				$delete = $db->query("DELETE FROM easyex_feedbacks WHERE id='$row[id]'");
				echo success("Feedback was deleted.");
			} else {
				echo info("Are you sure you want to delete feedback <b>$row[content]</b> from <b>$user</b>?");
				echo '<a href="./?a=feedbacks&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=feedbacks" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
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
                        <h1>Feedbacks</h1>
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
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="50%">Feedback</th>
					<th width="15%">User</th>
					<th width="25%">Exchange ID</th>
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
				$statement = "easyex_feedbacks";
				$query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['content']; ?></td>
							<td><?php if(is_numeric($row['uid'])) { ?><a href="./?a=users&b=edit&id=<?php echo $row['uid']; ?>"><?php echo idinfo($row['uid'],"username"); ?> (<?php echo $row['first_name']." ".$row['last_name']; ?>)</a><?php } else { echo $row['ip']; ?> (<?php echo $row['first_name']." ".$row['last_name']; ?>)<?php } ?></td>
							<td><a href="javascript:void(0);" onclick="EEXAdmin_CreateModal('explore','<?php echo $row['exchange_id']; ?>');"><?php echo exchangeinfo($row['exchange_id'],"exchange_id"); ?></a></td>
							<td>
								<?php if($row['status'] == "0") { ?><a href="./?a=feedbacks&b=approve&id=<?php echo $row['id']; ?>" title="Approve"><i class="fa fa-check"></i></a><?php } ?> 
								<a href="./?a=feedbacks&b=delete&id=<?php echo $row['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php
					}
				} else {
					echo '<tr><td colspan="4">Still no have testimonials.</td></tr>';
				}
				?>
			</tbody>
		</table>
		<?php
		$ver = "./?a=feedbacks";
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