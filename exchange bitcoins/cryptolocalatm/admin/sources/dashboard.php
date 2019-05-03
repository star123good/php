<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>		<br>
		<br><div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
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

            <div class="col-sm-12">
				<?php
				if(isset($_GET['Check4Updates'])) {
					$check = CheckEEXVer($version);
					if($check['status'] == "success") {
						echo info($check['msg']);
					} else {
						echo success($check['msg']);
					}
				} else { 
				?>
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">GREAT</span> Current version of your EasyExchanger is <b><?php echo $version;?></b>. <a href="./?Check4Updates=1"><b>Click here</b></a> to check for new updates.</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<?php } ?>
            </div>

           <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <i class="fa fa-users"></i>
                        </div>
                        <h4 class="mb-0">
                            <span class="count"><?php $query = $db->query("SELECT * FROM easyex_users"); echo $query->num_rows; ?></span>
                        </h4>
                        <p class="text-light">Users</p>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
							<i class="fa fa-refresh"></i>
						</div>
                        <h4 class="mb-0">
                             <span class="count"><?php $query = $db->query("SELECT * FROM easyex_exchanges"); echo $query->num_rows; ?></span>
                        </h4>
                        <p class="text-light">Exchanges</p>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <i class="fa fa-comments-o"></i>
                        </div>
                        <h4 class="mb-0">
                            <span class="count"><?php $query = $db->query("SELECT * FROM easyex_feedbacks"); echo $query->num_rows; ?></span>
                        </h4>
                        <p class="text-light">Feedbacks</p>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-lg-12 col-md-12">
                <p>Here you can add some Widget to see your website visitors.</p>
            </div><!--/.col-->

            <div class="col-md-12">
				<div class="card">
                        <div class="card-header">
                            <strong class="card-title">Pending <b>Exchanges</b> <span class="badge badge-success" id="pending_exchanges_num"><?php $query = $db->query("SELECT * FROM easyex_exchanges WHERE status='2' ORDER BY id"); echo $query->num_rows; ?> </span></strong>
                        </div>
                        <div class="card-body">
								<?php
								$i=1;
								$query = $db->query("SELECT * FROM easyex_exchanges WHERE status='2' ORDER BY id");
								if($query->num_rows>0) {
									while($row = $query->fetch_assoc()) {
										?>
											<div class="alert alert-warning" id="pending_exchange_<?php echo $row['id']; ?>">
												<table class="table table-striped">
													<tbody>
														<tr>
															<td width="50%">From gateway: <span class="pull-right"><?php echo gatewayinfo($row['gateway_send'],"name"); ?> <?php echo gatewayinfo($row['gateway_send'],"currency"); ?></span></td>
															<td width="50%">To gateway: <span class="pull-right"><?php echo gatewayinfo($row['gateway_receive'],"name"); ?> <?php echo gatewayinfo($row['gateway_receive'],"currency"); ?></span></td>
														</tr>
														<tr>
															<td>Amount send: <span class="pull-right"><?php echo $row['amount_send']; ?> <?php echo gatewayinfo($row['gateway_send'],"currency"); ?></span></td>
															<td>Amount receive: <span class="pull-right"><?php echo $row['amount_receive']; ?> <?php echo gatewayinfo($row['gateway_receive'],"currency"); ?></span></td>
														</tr>
														<tr>
															<td>Exchange ID: <span class="pull-right"><?php echo $row['exchange_id']; ?></span></td>
															<td>Status: <span class="pull-right"><?php echo getStatus($row['status'],0); ?></span></td>
														</tr>
														<tr>
															<td>Created on: <span class="pull-right"><?php echo date("d/m/Y H:i",$row['created']); ?></span></td>
															<td>From user: <span class="pull-right"><?php if($row['uid']>0) { echo idinfo($row['uid'],"email"); } else { echo $row['ip']; } ?></span></td>
														</tr>
													</tbody>
												</table>
												<a href="javascript:void(0);" onclick="EEXAdmin_CreateModal('explore','<?php echo $row['id']; ?>');" class="btn btn-primary btn-sm">Explore</a>
												</div>
										<?php
									}
								} else {
									echo info("No have new exchange requests.");
								}
								?>
                        </div>
                    </div>
			</div>
			
			
			<?php
			$query = $db->query("SELECT * FROM easyex_users WHERE document_1 != '' and document_verified='0' ORDER BY id");
			if($query->num_rows>0) {
			?>
			<div class="col-md-12">
				<div class="card">
                        <div class="card-header">
                            <strong class="card-title">Pending documents for approval</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
							  <thead>
								<tr>
									<th width="5%">ID</th>
									<th width="15%">Username</th>
									<th width="15%">Email address</th>
									<th width="15%">Document 1</th>
									<th width="15%">Document 2</th>
									<th width="15%">Registered on</th>
									<th width="10%">Action</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php
								while($row = $query->fetch_assoc()) {
								?>
										<tr>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['username']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><a href="<?php echo $settings['url'].$row['document_1']; ?>" target="_blank"><?php echo basename($row['document_1']); ?></a></td>
											<td><a href="<?php echo $settings['url'].$row['document_2']; ?>" target="_blank"><?php echo basename($row['document_2']); ?></a></td>
											<td><span class="label label-primary"><?php echo date("d/m/Y H:i:s",$row['signup_time']); ?></span></td>
											<td>
												<a href="./?a=users&b=edit&id=<?php echo $row['id']; ?>" title="Approve"><i class="fa fa-check"></i></a>
											</td>
										</tr>
								<?php 
								$i++;
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
			
			<?php
			$query = $db->query("SELECT * FROM easyex_feedbacks WHERE status='0' ORDER BY id");
			if($query->num_rows>0) {
			?>
			<div class="col-md-12">
				<div class="card">
                        <div class="card-header">
                            <strong class="card-title">Pending feedbacks</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
							  <thead>
								<tr>
									<th width="65%">Feedback</th>
									<th width="15%">User</th>
									<th width="15%">Exchange ID</th>
									<th width="5%">Action</th>
								</tr>
							  </thead>
							  <tbody>
							  <?php
								while($row = $query->fetch_assoc()) {
								?>
										<tr>
											<td><?php echo $row['content']; ?></td>
											<td><?php if(is_numeric($row['uid'])) { ?><a href="./?a=users&b=edit&id=<?php echo $row['uid']; ?>"><?php echo idinfo($row['uid'],"username"); ?> (<?php echo $row['first_name']." ".$row['last_name']; ?>)</a><?php } else { echo $row['ip']; ?> (<?php echo $row['first_name']." ".$row['last_name']; ?>)<?php } ?></td>
											<td><a href="javascript:void(0);" onclick="EEXAdmin_CreateModal('explore','<?php echo $row['exchange_id']; ?>');"><?php echo exchangeinfo($row['exchange_id'],"exchange_id"); ?></a></td>
											<td>
												<a href="./?a=feedbacks&b=approve&id=<?php echo $row['id']; ?>" title="Approve"><i class="fa fa-check"></i></a>
											</td>
										</tr>
								<?php 
								$i++;
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
			
			
                        </div>
                    </div>
			</div>
        </div> <!-- .content -->