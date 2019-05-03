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
  <title>Search REsult</title>
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
  <link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css" media="all" />
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
  
  <!-- breadcrumb area end  -->
<div class="container text-dark m-5 p-5">
  <?php print_r($_POST) ?>
  <hr>
  <?php print_r($_session) ?>

</div>
  
  <section class="listing-page">
     <div class="container">
<form action="vehical-details.php" method="post">
      <div class="row">
     <!--Side-Bar-------------------------> 
        <div class="col-sm-3">  
          <div class="card mt-1">
            <div class="card-block px-2 m-2">
              <div class="card-title"><h4> <i class="fa fa-filter" aria-hidden="true"></i> Your Booking </h4></div>
            </div>


            


              <div class="form-group select">
                <select class="form-control" name="pickuplocation">
                  <option value="<?php echo htmlentities($pickuplocation);?>"><?php echo htmlentities($pickuplocation);?></option>
                  <?php $sql = "SELECT * from  locations where location <> '$pickuplocation' ";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                      {       ?>  
                        <option value="<?php echo htmlentities($result->location);?>"><?php echo htmlentities($result->location);?></option>
                      <?php }} ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" autocomplete="off" value="<?php echo htmlentities($pickupdate);?>" placeholder="Pick Up Date" class="border border-info rounded" name="pickupdate" id="pickupdate">
                  </div>
                  <div class="form-group">
                    <select class="border border-info rounded" name="pickuptime">
                      <option value="<?php echo htmlentities($pickuptime);?>"><?php echo htmlentities($pickuptime);?></option>
                      <option value="00:00">00:00</option>
                      <option value="00:30">00:30</option>
                      <option value="01:00">01:00</option>
                      <option value="01:30">01:30</option>
                      <option value="02:00">02:00</option>
                      <option value="02:30">02:30</option>
                      <option value="03:00">03:00</option>
                      <option value="03:30">03:30</option>
                      <option value="04:00">04:00</option>
                      <option value="04:30">04:30</option>
                      <option value="05:00">05:00</option>
                      <option value="05:30">05:30</option>
                      <option value="06:00">06:00</option>
                      <option value="06:30">06:30</option>
                      <option value="07:00">07:00</option>
                      <option value="07:30">07:30</option>
                      <option value="08:00">08:00</option>
                      <option value="08:30">08:30</option>
                      <option value="09:00">09:00</option>
                      <option value="09:30">09:30</option>
                      <option value="10:00">10:00</option>
                      <option value="10:30">10:30</option>
                      <option value="11:00">11:00</option>
                      <option value="11:30">11:30</option>
                      <option value="12:00">12:00</option>
                      <option value="12:30">12:30</option>
                      <option value="13:00">13:00</option>
                      <option value="13:30">13:30</option>
                      <option value="14:00">14:00</option>
                      <option value="14:30">14:30</option>
                      <option value="15:00">15:00</option>
                      <option value="15:30">15:30</option>
                      <option value="16:00">16:00</option>
                      <option value="16:30">16:30</option>
                      <option value="17:00">17:00</option>
                      <option value="17:30">17:30</option>
                      <option value="18:00">18:00</option>
                      <option value="18:30">18:30</option>
                      <option value="19:00">19:00</option>
                      <option value="19:30">19:30</option>
                      <option value="20:00">20:00</option>
                      <option value="20:30">20:30</option>
                      <option value="21:00">21:00</option>
                      <option value="21:30">21:30</option>
                      <option value="22:00">22:00</option>
                      <option value="22:30">22:30</option>
                      <option value="23:00">23:00</option>
                      <option value="23:30">23:30</option>
                      <option value="24:00">24:00</option>
                    </select>
                  </div>
                  <div class="form-group select">
                    <select class="form-control" name="droplocation">
                      <option value="<?php echo htmlentities($droplocation);?>"><?php echo htmlentities($droplocation);?></option>
                      <?php $sql = "SELECT * from  locations ";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $result)
                          {       ?>  
                            <option value="<?php echo htmlentities($result->location);?>"><?php echo htmlentities($result->location);?></option>
                          <?php }} ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <input type="text" autocomplete="off" value="<?php echo htmlentities($dropdate);?>" class="border border-info rounded" name="dropdate" id="dropdate">
                      </div>
                      <div class="form-group">
                        <select class="border border-info rounded" name="droptime">
                          <option value="<?php echo htmlentities($droptime);?>"><?php echo htmlentities($droptime);?></option>
                          <option value="00:00">00:00</option>
                          <option value="00:30">00:30</option>
                          <option value="01:00">01:00</option>
                          <option value="01:30">01:30</option>
                          <option value="02:00">02:00</option>
                          <option value="02:30">02:30</option>
                          <option value="03:00">03:00</option>
                          <option value="03:30">03:30</option>
                          <option value="04:00">04:00</option>
                          <option value="04:30">04:30</option>
                          <option value="05:00">05:00</option>
                          <option value="05:30">05:30</option>
                          <option value="06:00">06:00</option>
                          <option value="06:30">06:30</option>
                          <option value="07:00">07:00</option>
                          <option value="07:30">07:30</option>
                          <option value="08:00">08:00</option>
                          <option value="08:30">08:30</option>
                          <option value="09:00">09:00</option>
                          <option value="09:30">09:30</option>
                          <option value="10:00">10:00</option>
                          <option value="10:30">10:30</option>
                          <option value="11:00">11:00</option>
                          <option value="11:30">11:30</option>
                          <option value="12:00">12:00</option>
                          <option value="12:30">12:30</option>
                          <option value="13:00">13:00</option>
                          <option value="13:30">13:30</option>
                          <option value="14:00">14:00</option>
                          <option value="14:30">14:30</option>
                          <option value="15:00">15:00</option>
                          <option value="15:30">15:30</option>
                          <option value="16:00">16:00</option>
                          <option value="16:30">16:30</option>
                          <option value="17:00">17:00</option>
                          <option value="17:30">17:30</option>
                          <option value="18:00">18:00</option>
                          <option value="18:30">18:30</option>
                          <option value="19:00">19:00</option>
                          <option value="19:30">19:30</option>
                          <option value="20:00">20:00</option>
                          <option value="20:30">20:30</option>
                          <option value="21:00">21:00</option>
                          <option value="21:30">21:30</option>
                          <option value="22:00">22:00</option>
                          <option value="22:30">22:30</option>
                          <option value="23:00">23:00</option>
                          <option value="23:30">23:30</option>
                          <option value="24:00">24:00</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Continue Booking</button>
                      </div>
                   
                  </div>
                </div>


               <!--Side-Bar-------------------------> 



               <!--Listing-->

                <div class="col-md-9">
                  <?php 
                  $startdate=date_create($_POST['pickupdate']);
                  $enddate=date_create($_POST['dropdate']);
                  $days=date_diff($startdate, $enddate);
                  $sql = "SELECT tblvehicles.*,groups.price5,groups.name,groups.idd as bid  from tblvehicles join groups on groups.idd=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:brand and tblvehicles.FuelType=:fueltype";
                  $query = $dbh -> prepare($sql);
                  $query -> bindParam(':brand',$brand, PDO::PARAM_STR);
                  $query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                      {  ?>
                        <div class="card border m-2 text-dark">
                          <div class="row">
                            <div class="col-md-3" > <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="mh-100 p-2 img-responsive" alt="Image">
                            </div>
                            <div class="col-md-9">
                              <div class="card-block px-2 m-2">
                                <h4 class="card-title"><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h4>
                                <p class="card-text">
                                  <p> $ $<?php 
                                  switch ($day) {
                                    case "1":
                                    case "2":
                                    echo htmlentities($result->price1*$day);
                                    break;
                                    case "3":
                                    echo htmlentities($result->price2*$day);
                                    break;
                                    case "4":
                                    case "5":
                                    case "6":
                                    echo htmlentities($result->price3*$day);
                                    break;
                                    case "7":
                                    echo htmlentities($result->price4*$day);
                                    break;
                                    default:
                                    echo htmlentities($result->price5*$day);
                                  }
                                  ?> For  <?php echo htmlentities($days->format('%a'));?>  Days </p>
                                  <p>
                                    <p>
                                      <ul>
                                        <li class="list-inline-item"><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                                        <li class="list-inline-item"><i class="fa fa-calendar" aria-hidden="true$days->format('%a')"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                                        <li class="list-inline-item"><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                                      </ul>
                                    </p>
                                  </p>
                                  <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn btn-primary">Choose </a>
                                </div>
                              </div>
                            </div> 
                          </div>  
                        <?php }} 
                        else 
                          {?>          <div class="col-sm-12">  
                            <?php
                            $startdate=date_create($_POST['pickupdate']);
                            $enddate=date_create($_POST['dropdate']);
                            $days=date_diff($startdate, $enddate);
                            $day=$days->format('%a');
                            $sql = "SELECT tblvehicles.*,groups.*,groups.price5,groups.name,groups.idd as bid  from tblvehicles join groups on groups.idd=tblvehicles.VehiclesBrand";
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
                                          <h4 class="card-title"><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h4>
                                          <p class="card-text">
                                            <p> $<?php 
                                            switch ($day) {
                                              case "1":
                                              case "2":
                                              echo htmlentities($result->price1*$day);
                                              break;
                                              case "3":
                                              echo htmlentities($result->price2*$day);
                                              break;
                                              case "4":
                                              case "5":
                                              case "6":
                                              echo htmlentities($result->price3*$day);
                                              break;
                                              case "7":
                                              echo htmlentities($result->price4*$day);
                                              break;
                                              default:
                                              echo htmlentities($result->price5*$day);
                                            }
                                            ?> For  <?php echo htmlentities($days->format('%a'));?>  Days </p>
                                            <p>
                                              <ul>
                                                <li class="list-inline-item"><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                                                <li class="list-inline-item"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                                                <li class="list-inline-item"><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                                              </ul>
                                            </p>
                                          </p>

                                          <div class="radio btn btn-primary">
                                            <label><input type="radio" name="vhid" value="<?php echo htmlentities($result->id);?>" required >choose </label>

                                          </div> 
                                          <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> Continue Booking</button>

    
                                        </div>
                                      </div>
                                    </div>
                                  </div>            
                                <?php }} ?><?php }?>
                              </div>
                            </div>

                            <!-- /Listing--> 

      



</div>
</form>
</div>
                          </section>
                          
                          <!--Footer -->
                          <?php include('includes/footer.php');?>
                          <!-- /Footer--> 
                          <script>
                            $( function() {
                              var dateFormat = "mm/dd/yy",
                              from = $( "#pickupdate" )
                              .datepicker({
                                changeMonth: true,
                                numberOfMonths: 1,
                                minDate: -0
                              })
                              .on( "change", function() {
                                to.datepicker( "option", "minDate", getDate( this ) );
                              }),
                              to = $( "#dropdate" ).datepicker({
                                changeMonth: true,
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
