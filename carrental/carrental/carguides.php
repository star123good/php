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
	 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
		 
		<link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css" media="all" />

   
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<!--[if lt IE 9]>



		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

<body>
	<!--Header-->
	<?php include('includes/header.php');?>
	<!-- /Header -->

	<!-- breadcrumb area   -->
	<section class="breadcrumb-area guide-bg">
		<div class="container">
			 <h1 class="text-white">Vehicle Guide</h1>
		</div>
	</section>

	<!-- breadcrumb area end  -->











	<!--Listing-->
 
	<div class="container   ">					
		 
<div class="row   my-2   ">	



		 
						<?php $sql = "SELECT tblvehicles.*,groups.price5,groups.name,groups.idd from tblvehicles join groups on groups.idd=tblvehicles.VehiclesBrand order by price5 ";

						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount() > 0)
						{
							foreach($results as $result)
								{  ?>

<div class="col-sm-3  my-2">	
<div class="card bg-light text-dark h-100" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
  <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class=" p-2 img-responsive" alt="Image" style	="height: 10rem">
  <div class="card-body">
    <h5 class="card-title"><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></a></h5>  


    
<p>From $<?php echo htmlentities($result->price5);?> Per Day</p>
<ul>
<li class="list-item"><i class="fa fa-user" aria-hidden="true"></i> Seats: <?php echo htmlentities($result->SeatingCapacity);?></li>
<li class="list-item"><i class="fa  fa-suitcase"></i></i> <?php echo htmlentities($result->smSuit);?> Small Suitcases</li>
<li class="list-item"><i class="fa 	 fa-suitcase-rolling"></i> <?php echo htmlentities($result->bgSuit);?> Big Suitcases</li>
<li class="list-item"><i class="fas fa-gas-pump"></i> <?php echo htmlentities($result->FuelType);?> <?php echo htmlentities($result->wva);?>L/100km </li>
<li class="list-item"><i class="fas fa-cogs"></i> <?php echo htmlentities($result->transmission);?>  </li>



</ul> <hr>  
    

 <div class="text-center">

<div class="btn btn-primary"><a class="text-white"  href="bookst.php?id=<?php echo htmlentities($result->idd); ?>">   Book</a></div> 	</div>
 
<!-- Modal -->

 		 
   </div>
</div>   <!-- card --> 
</div> <!--col-->

									 					
								<?php }} 

								 ?>
							</div> 

					 


 
					</div><!--container closing-->
 

<!-- footer --> 
	<?php include('includes/footer.php');?>
<!-- /footer -->

<script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#pickupdate" )
        .datepicker({
        
       		       
           showOtherMonths: true,
      selectOtherMonths: true,
          numberOfMonths: 1,
          minDate: -0
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#dropdate" ).datepicker({
         
        showOtherMonths: true,
      selectOtherMonths: true,
        numberOfMonths: 1,
        minDate: -0
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
				</body>


				</html>