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
	<title>Super Car Rent | page</title>

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
		
 <!-- breadcrumb area   -->
<section class="breadcrumb-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2><?=$languages[9][$lang_select]?></h2>
            <ul>
              <li><a href="index.php"><?=$languages[0][$lang_select]?></a></li>
              <li class="active"><a href="#"><?=$languages[9][$lang_select]?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- breadcrumb area end -->


<div class="container m-5">
	<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</p>
</div>



		<!-- footer --> 
		<?php include('includes/footer.php');?>
		<!-- /footer -->



	</body>


	</html>