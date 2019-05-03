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

<!-- hero --> 
	<?php include('includes/hero.php');?>
<!-- /hero --> 

<!-- hero --> 
	<?php include('includes/about.php');?>
<!-- /hero -->

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