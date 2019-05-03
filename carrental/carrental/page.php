<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Super Car Rent</title>

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
	<!-- Icofont CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
	<!-- Slicknav CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css">
	<!-- Owl carousel CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
	<!-- Popup CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
	<!-- Vega CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/vegas.min.css">
	<!-- Main style CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
	<!-- Responsive CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<!--Header-->
		<?php include('includes/header.php');?>
		<!-- /Header -->





 <?php 
$pagetype=$_GET['type'];
$sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
$query = $dbh -> prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
   <!-- breadcrumb area   -->
<section class="breadcrumb-area <?php 	echo htmlentities($pagetype) ?>-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2><?php   echo htmlentities($result->PageName); ?></h2>
             
          </div>
        </div>
      </div>
    </section>

  <!-- breadcrumb area  end  -->
<section class="text-dark">
  <div class="container">
    <div class="csard m-2 p-2">


      <h2 class="mb-4"><?php   echo htmlentities($result->PageName); ?></h2>
      <p><?php  echo $result->detail; ?> </p>
    </div>
   <?php } }?>
  </div>
</section>



		<!-- footer --> 
		<?php include('includes/footer.php');?>
		<!-- /footer -->
 


	</body>


	</html>