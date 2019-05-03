


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
  <title>Super Car Rent | Guides</title>

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
          <h2>Car Guides</h2>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="#">Car Guides</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- breadcrumb area end  -->











  <!--Listing-->

  <div class="container  p-3">          
    <div class="row">

      <!--Side-Bar  -->
      <div class="col-sm-3">  
        <div class="card m-2">
          <div class="card-block px-2 m-2">
            <div class="card-title"><h4> <i class="fa fa-filter" aria-hidden="true"></i> Find Your  Car </h4></div>
          </div>
          <div class="m-2">
            <form action="search-carresult.php" method="post">
              <div class="form-group select">
                <select class="form-control" name="brand">
                  <option>Select Group</option>

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

                  <div class="form-group select">
                    <select class="form-control" name="fueltype">
                      <option>Select Fuel Type</option>
                      <option value="Petrol">Petrol</option>
                      <option value="Diesel">Diesel</option>
                      <option value="CNG">CNG</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--Side-Bar--> 



          <!--listing-->                
          <div class="col-sm-9">  
            <?php $sql = "SELECT tblvehicles.*,groups.price5,groups.name,groups.idd as bid  from tblvehicles join groups on groups.idd=tblvehicles.VehiclesBrand";

            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
                {  ?>
                  <div class="card border border m-2 text-dark">
                    <div class="row no-gutters">
                      <div class="col-md-3" > <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="mh-100 p-2 img-responsive" alt="Image">
                      </div>
                      <div class="col-md-9">
                        <div class="card-block px-2 m-2">
                          <h4 class="card-title"><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?>, <?php echo htmlentities($result->VehiclesTitle);?></a></h4>
                          <p class="card-text">
                            <p>From $<?php echo htmlentities($result->price5);?> Per Day</p>
                            <p>
                              <ul>
                                <li class="list-inline-item"><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                                <li class="list-inline-item"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                                <li class="list-inline-item"><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                              </ul>
                            </p>
                          </p>
                          <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn btn-primary">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                        </div>
                      </div>
                    </div>
                  </div>            
                <?php }} ?>
              </div> 

            </div> <!--/row-->



          </div><!--container closing-->




          <!-- footer --> 
          <?php include('includes/footer.php');?>
          <!-- /footer -->



        </body>


        </html>