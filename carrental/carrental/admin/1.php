<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else{
	if($_POST['submit']=="Update")
	{

		$id=$_POST['id'];
		$st =$_POST['from'];
		$ss=date_create($st);	
		$start= date_format($ss,"Y-m-d");
		$en =$_POST['to'];
		$ee=date_create($en);
		$end= date_format($ee,"Y-m-d");
		$sql="update groups set (stopSaleFrom,stopSaleTo) VALUES (:start,:end) where idd=:id";      
		$query = $dbh->prepare($sql);
		$query -> bindParam(':id',$id, PDO::PARAM_STR);
		$query -> bindParam(':start',$start, PDO::PARAM_STR);
		$query -> bindParam(':end',$end, PDO::PARAM_STR);
		$query -> execute();
		$msg="stopsale updated  successfully";

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

		<title>Manage Stopsale</title>

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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			$( function() {
				var dateFormat = "mm/dd/yy",
				from = $( "#from" )
				.datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 1
				})
				.on( "change", function() {
					to.datepicker( "option", "minDate", getDate( this ) );
				}),
				to = $( "#to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 1
				})
				.on( "change", function() {
					from.datepicker( "option", "maxDate", getDate( this ) );
				});

				function getDate( element ) {
					var date;
					try {
						date = $.datepicker.parseDate( dateFormat, element.value );
					} catch( error ) {
						date = null;
					}

					return date;
				}
			} );
		</script>
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


	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Manage stopsale</h2>

	<?php include('includes/header.php');?>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Listed  Groups</div>
							<div class="panel-body">
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
								else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>  


								<form action="" method="post">
									<div class="form-row">

										<div class="col-sm-3">
											<label for="picklocation">Select group</label>
											<select class="form-control" required name="id" id="picklocation">

												<?php $sql = "SELECT * from  groups ";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
													foreach($results as $result)
														{       ?>  
															<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></option>
														<?php }} ?>
													</select>
												</div>
												<div class="col-sm-3">

													<div class="form-group">									 
														<label for="from">From</label>
														<input class="form-control" type="text" id="from" name="from" placeholder="date" value="<?php echo htmlentities($result->stopSaleFrom) ?>">
													</div>

												</div>
												<div class="col-sm-3">
													<div class="form-group"> <label for="to">to</label>
														<input class="form-control" type="text" id="to" name="to" placeholder="date">	</div>
													</div>
<?php print_r($result) ?>
												</div>
	<div class="form-row">
												<div class="col-sm-3">
													<div class="form-group">
														<div>
															<label> Stopsale</label>
															<div class="form-control"  >


																<label><input type="radio" name="optradio" checked>Enable</label>


																<label><input type="radio" name="optradio">Disable</label>



															</div>
														</div>
													</div>
												</div>

											</div>
											</div>
										

<input type="submit" name="">
											</form>




										</div>
									</div>

								</div>
							</div>
						</div>

						<!-- Loading Scripts -->

						<script src="js/bootstrap-select.min.js"></script>
						<script src="js/bootstrap.min.js"></script>

						<script src="js/dataTables.bootstrap.min.js"></script>
						<script src="js/Chart.min.js"></script>
						<script src="js/fileinput.js"></script>
						<script src="js/chartData.js"></script>
						<script src="js/main.js"></script>
					</body>
					</html>
				<?php } ?>
