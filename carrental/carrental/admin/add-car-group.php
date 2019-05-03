<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else{ 

	if(isset($_POST['submit']))
	{
		$name=$_POST['name'];
		$price1=$_POST['price1'];
		$price2=$_POST['price2'];
		$price3=$_POST['price3'];
		$price4=$_POST['price4'];
		$price5=$_POST['price5'];



		$sql="INSERT INTO groups(name,price1,price2,price3,price4,price5) VALUES(:name,:price1,:price2,:price3,:price4,:price5)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':name',$name,PDO::PARAM_STR);
		$query->bindParam(':price1',$price1,PDO::PARAM_STR);
		$query->bindParam(':price2',$price2,PDO::PARAM_STR);
		$query->bindParam(':price3',$price3,PDO::PARAM_STR);
		$query->bindParam(':price4',$price4,PDO::PARAM_STR);
		$query->bindParam(':price5',$price5,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			$msg="Group Added successfully";
		}
		else 
		{
			$error="Something went wrong. Please try again";
		}

	}


	?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Add Extras</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		.succWrap{
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
	</style>

</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">	
						<h2 class="page-title">Add group</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">

									<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
									else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-group">

												<div class="col-md-12 mb">
													<label>Group name</label>
													<input type="text" placeholder="enter group name" name="name" class="form-control" required>
												</div>
											 
 <div class="content-box">
												<h4> <strong>Prices $</strong></h4></div>
												<div class="col-md-2">
												
													<input type="text" placeholder="1-2 days" name="price1" class="form-control" required>
												</div>
<div class="col-md-2">
													
													<input type="text" placeholder="3 days" name="price2" class="form-control" required>
												</div>
<div class="col-md-2">
													<input type="text" placeholder="4-6 days" name="price3" class="form-control" required>
												</div>
<div class="col-md-2">
													<input type="text" placeholder="7 days" name="price4" class="form-control" required>
												</div>
<div class="col-md-2">
												<input type="text" placeholder="8-29 days" name="price5" class="form-control" required>
												</div>


												<div class="col-md-2 mt-2">
												<button class="btn btn-primary" name="submit" type="submit">Save</button>
												<button class="btn btn-default" type="reset">Cancel</button>
											</div>
											</div>
											
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>