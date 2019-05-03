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






 <?php 
$groupId=$_GET['id'];
 
$sql = "SELECT * from groups where idd=$groupId " ;
 
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
              { 

              
               } 

           }   
            ?>

  <?php 
 
 
$sql = "SELECT * from tblvehicles where vehiclesBrand=$groupId " ;
 
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $forImage)
              { 

              
               } 

           }   
            ?>
            
             
 
  
 

<div class="row m-2 p-2 text-dark" >
<div class="col-sm-4">
	<div class="card mb-2  sticky-top fixedCard text-dark " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
        <div class="card-header ">
          <h5 class=""> You are booking <?php 	echo htmlentities($result->name) ?>  </h5>
        </div>
        <div class="card-body">
                   <h5>From $ <?php echo htmlentities($result->price5); ?> per day </h5>
	                   <br>
	                   
<ul>
<li class="list-item"><i class="fa fa-user" aria-hidden="true"></i> Seats: <?php echo htmlentities($forImage->SeatingCapacity);?></li>
<li class="list-item"><i class="fa  fa-suitcase"></i></i> <?php echo htmlentities($forImage->smSuit);?> Small Suitcases</li>
<li class="list-item"><i class="fa 	 fa-suitcase-rolling"></i> <?php echo htmlentities($forImage->bgSuit);?> Big Suitcases</li>
<li class="list-item"><i class="fas fa-gas-pump"></i> <?php echo htmlentities($forImage->FuelType);?> <?php echo htmlentities($forImage->wva);?>L/100km </li>
<li class="list-item"><i class="fas fa-cogs"></i> <?php echo htmlentities($forImage->transmission);?>  </li>
 


</ul>
                     <img src="admin/img/vehicleimages/<?php echo htmlentities($forImage->Vimage1);?>" class="mh-100   img-responsive" alt="Image"> 
         </div>
                   
      </div>
</div>
<!-- end col-->

<div class="col-sm-4">
				<div class="card bg- 	 border  rounded" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					<div class="card-header"> <h5 class="">Make Your Rent</h5>
					</div>
					<div class="card-body">
						<form action="booktest2.php" method="post">
							 
								<label for="picklocation">Pick Up Location</label>
								<select class="form-control" required name="picklocation" id="picklocation">
									 
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
									 
									 
										<label for="droplocation">Drop Off Location</label>
										<select class="form-control" required name="droplocation" id="droplocation">
											 
											<?php $sql = "SELECT * from  locations ";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
												foreach($results as $result)
													{       ?>  
														<option value="<?php echo htmlentities($result->location);?>">
															<?php echo htmlentities($result->location);?>
														</option>
													<?php }} ?>
												</select>
									 



<br>

											<label for="" class="mt-3">Date & Time</label><br>
 
													<span>From</span>
											 
											<div class="input-group mb-3">
												
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

												<div class="input-group-prepend">
													<span class="input-group-text" id=""><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" autocomplete="off" placeholder="Date" class="form-control" required name="pickupdate" id="pickupdate"><div class="input-group-prepend">
													<span class="input-group-text" id=""><i class="far fa-clock"></i></span>
												</div>
												<select class="form-control" required name="pickuptime">
													<option value="">Time</option>
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


<span>To</span>
											<div class="input-group mb-3">
											
												 
												<div class="input-group-prepend">
													<span class="input-group-text" id=""><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" autocomplete="off" class="form-control" required name="dropdate" id="dropdate" placeholder="Date">
												<div class="input-group-prepend">
													<span class="input-group-text" id=""><i class="far fa-clock"></i></span>
												</div>
												<select class="form-control" required name="droptime">
													<option value="">Time</option>
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
  									</div>
								</div>
							</div> <!-- end col-->




							<div class="col-sm-4">
 
 
<div class="card mb-2  sticky-top fixedCard text-dark " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
        <div class="card-header ">
          <h5 class="">Choose Extras If needed</h5>
        </div>
        <div class="card-body">
                     <div class="">  
  <table   class="table" >
    <thead>
      <tr>
        
        <th scope="col">Extra</th>
        <th scope="col">Price Per Day $</th>

      </tr>
    </thead>
   <tbody >
      <?php
      $sql = "SELECT * FROM extras";
      $query = $dbh -> prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;

      if($query->rowCount() > 0)
      {
        foreach($results as $result)
        {  $cnt=$cnt+1;
          ?>

          <tr id="price<?php echo htmlentities($result->id);?>">
            
<!------- habnarm---->

<td class="getname">
<input type="checkbox"  data-priceid="<?php echo htmlentities($result->id);?>" class="extraname" name="extra<?php echo htmlentities($cnt);?>" value="<?php echo htmlentities($result->name);?>"><?php echo htmlentities($result->name);?>
</td>
          <?php switch ($day) {
            case '0':
              echo '<td class="getprice">', htmlentities($result->price),'</td>' ;
              break;
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            echo '<td class="getprice">', htmlentities($result->price*$day),'</td>' ;
              # code...
              break;
            default:
             echo '<td class="getprice">', htmlentities($result->price*7),'</td>' ;
              break;
          } ?>
     <!--     <td class="getprice"> <?php echo htmlentities($result->price*$day);?></td> -->

           
        </tr>

      <?php }  ?> <?php }?> 
    </tbody>

  </table> 
          </div>
<hr>  
 <div class="row no-gutters">  
  
  <div class="col-lg-9 font-weight-bold"> Total For Extra Services for one day: </div>
 
  <div class="col-lg-3 font-weight-bold">  <span class="showtotal">  </span></div>
</div>

<hr>  
<input type="text" name="carId"  hidden value="<?php echo htmlentities($groupId) ?>">  
<input type="submit"  class="btn-primary btn btn-block" value="Continue bootking" > 

 
 
        </div>

                   
      </div>
 
</div>


</div> <!-- end row-->














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
  <script type="text/javascript">
$(document).ready(function() {
  
  $('.extraname').on('click',function(){
    $('.choosenname').remove();
    $('.choosenprice').remove();
         $('.choosentotal').remove();    
      var total=0; turn=0;
        $('.extraname:checked').each(function(i, element) {
      
              var allnames=[] ; allprices=[]; 
            var id=$(this).attr('data-priceid');
            allnames.push($('#price'+id).find("td.getname").text());
            allprices.push($('#price'+id).find("td.getprice").text());
            
            $.each(allnames,function(i, val) {
            $(".showname").append("<div class='choosenname'>"+val+"</div>");
            });
            
            $.each(allprices,function(i, val) {
            $(".showprice").append("<div class='choosenprice'>"+val+"</div>");
  
           turn=parseInt(allprices[i],10);
             
               total=total + turn;
              
            $('.choosentotal').remove();
            });
          
      $(".showtotal").append("<span class='choosentotal'>"+total+"</sapn>");
          

          });
    })  
})


</script>
	</body>


	</html>