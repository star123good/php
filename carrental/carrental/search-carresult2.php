<?php
session_start();
error_reporting(0);
include_once('includes/config.php');

$_SESSION['id']=$_POST['vhid'];
$_SESSION['picklocation']=$_POST['picklocation'];
$_SESSION['pickupdate']=$_POST['pickupdate'];
$_SESSION['pickuptime']=$_POST['pickuptime'];
$_SESSION['droplocation']=$_POST['droplocation'];
$_SESSION['dropdate']=$_POST['dropdate'];
$_SESSION['droptime']=$_POST['droptime'];







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

  $pickuplocation=$_POST['picklocation'];
  $pickupdate=$_POST['pickupdate'];
  $pickuptime=$_POST['pickuptime'];
  $droplocation=$_POST['droplocation'];
  $dropdate=$_POST['dropdate'];
  $droptime=$_POST['droptime'];
  $startdate=date_create($_POST['pickupdate']);
  $enddate=date_create($_POST['dropdate']);
  $days=date_diff($startdate, $enddate);
  $sql = "SELECT * from tblvehicles";
  $query = $dbh -> prepare($sql);
  $query -> bindParam(':pickuplocation',$pickuplocation, PDO::PARAM_STR);
  $query -> bindParam(':pickupdate',$pickupdate, PDO::PARAM_STR);
  $query -> bindParam(':pickuptime',$pickuptime, PDO::PARAM_STR);
  $query -> bindParam(':droplocation',$droplocation, PDO::PARAM_STR);
  $query -> bindParam(':dropdate',$dropdate, PDO::PARAM_STR);
  $query -> bindParam(':droptime',$droptime, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=$query->rowCount();



  ?>





  <section class="bg-secondary">
    <div class="bg-secondary">
      <form action="booktest.php" method="post">
        <div class="row mx-2">
          <div class="col-sm-12 px-2 pt-2">
            <div class="card mb-2  sticky-top fixedCard" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
        <div class="card-header bg-secondary">
          <h5 class="text-center  text-white"> You Choose To Book For 

  <?php
            $startdate1=date_create($_POST['pickupdate']);
            $enddate1=date_create($_POST['dropdate']);
            $daysss=date_diff($startdate1, $enddate1);
            $dayyy=$daysss->format('%a');
             
          
 
if ($dayyy<1) {
  $dayyy=1;
  # code...
}
 
            
           

// Create two new DateTime-objects...
 
$date111 = new DateTime($pickuptime);
$date222 = new DateTime($droptime);

// The diff-methods returns a new DateInterval-object...
$difff = $date222->diff($date111);

// Call the format method on the DateInterval-object
 
//add +1 day for 3 hours
if ($difff->format('%h')>=3) {
  $dayyy=$dayyy+1;

}
echo $dayyy;
?>

Day(s)


          </h5>
        </div>
        </div>
          </div>
        </div>
        <div class=" mx-2 row bg-secondary">
          <!--Side-Bar-------------------------> 

          <div class="col-lg-3 my-2 p-2"> 

            <div class="sticky-top fixedCard card bg-light text-dark " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 

<div class="card-header bg-secondary "> <h5 class="text-white">Your Booking info </h5> 
  
</div> 
              <div class="card-body">
                
                <h5>Pick Up Location</h5>
                <p class="card-text "><?php echo htmlentities($pickuplocation);?> </p>

                <h5>Pick Up Time</h5>
                <p class="card-text"><?php  

                $date1=date_create("$pickupdate");
                echo date_format($date1,"d F Y");

                ?> <?php echo htmlentities($pickuptime);?></p>
                         
<hr>

                <h5>Drop Off Location</h5>
                <p class="card-text"><?php echo htmlentities($droplocation);?></p>

                <h5>Drop Off Time</h5>
                <p class="card-text"><?php 
                $date2=date_create("$dropdate");
                echo date_format($date2,"d F Y");
                ?> <?php echo htmlentities($droptime);?></p>
 <hr><h5>Chosen Car</h5>
    <div class="row mt-1" >
          <div class="col-sm-5">

             <img src="https://via.placeholder.com/5" "   id="carimg" alt="CarImage" ><br>
               </div>

               <div class="col-sm-7">
              <span id="carname" >
                <h5>Select Desirable Car    <i class="fa fa-arrow-right"></i></h5>
                
                </span>
                <br><h5><span id="test" ></h5>
               
                
                </span>
</div>

                <div id="panel<?php echo htmlentities($result->id); ?>"> </div> 


 






 
        </div>
<!-- 



<h5>Chosen Extras </h5>
<div class="bg-warning"> 
Name:<span class="showname"></span><br /><br />


price:<span class="showprice"></span>


Total:<span class="showtotal"> </span>
 
</div>






 extra's space-->
              








<!-----

<div class="btn btn-primary btn-block"><a href="index.php" class="text-white">edit</a></div>

-->












</div>






</div>  
</div>


<!--Side-Bar-------------------------> 


<!-- days counter -->

<!-- /days counter -->


<!--Listing-->

<div class="col-lg-6 my-2 p-2">
  
  <div class="col-lg-12">  

    
            <?php
            $startdate=date_create($_POST['pickupdate']);
            $enddate=date_create($_POST['dropdate']);
            $days=date_diff($startdate, $enddate);
            $day=$days->format('%a');
            $daysToShow=$day;
            

            
           

// Create two new DateTime-objects...
 
$date1 = new DateTime($pickuptime);
$date2 = new DateTime($droptime);

// The diff-methods returns a new DateInterval-object...
$diff = $date2->diff($date1);

// Call the format method on the DateInterval-object
 
//add +1 day for 3 hours
if ($diff->format('%h')>=3) {
  $day=$day+1;

}
   $_SESSION['day']=$day;


            $sql = "SELECT   groups.*,tblvehicles.*from tblvehicles join groups on groups.idd=tblvehicles.VehiclesBrand order by price5 " ;
          
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
              {  


$stopSaleFrom=date_create($result->stopSaleFrom);
$stopSaleTo=date_create($result->stopSaleTo);

 

           

                ?>
                <div class="card  bg-light border border mb-2 p-4 text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
 

                  <div class="row no-gutters" id="panel<?php echo htmlentities($result->id);?>">



                    <div class="col-lg-3" > 
                      <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="mh-100   img-responsive" alt="Image"> 

                       
<?php if ($startdate>=$stopSaleFrom and $startdate<=$stopSaleTo) {
  echo '<div class="w-100 mt-4 radio btn btn-danger">
   <label class="my-0">Sold Out';
} else {
  
echo '<div class="w-100 mt-4 radio btn btn-primary">
   <label class="my-0"><input data-panelid="',htmlentities($result->id),'" class="choosecar" type="radio" name="vhid" value="',htmlentities($result->idd),'" required >  Book</label>';
}
 ?>





                    






                    </div> 
                  </div>

                  <div class="col-lg-5">
                    <div class="card-block px-2 m-2">
                      <h4 class="card-title"><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></a></h4>



                      <p class="card-text">

                        <p>
                          <ul>
<li class="list-inline-item"><i class="fa fa-user" aria-hidden="true"></i> Seats: <?php echo htmlentities($result->SeatingCapacity);?></li>
<li class="list-inline-item"><i class="fa  fa-suitcase"></i></i> <?php echo htmlentities($result->smSuit);?> Small Suitcases</li>
<li class="list-inline-item"><i class="fa   fa-suitcase-rolling"></i> <?php echo htmlentities($result->bgSuit);?> Big Suitcases</li>
<li class="list-inline-item"><i class="fas fa-gas-pump"></i> <?php echo htmlentities($result->FuelType);?> <?php echo htmlentities($result->wva);?>L/100km </li>
<li class="list-inline-item"><i class="fas fa-cogs"></i> <?php echo htmlentities($result->transmission);?>  </li>



</ul>
                        </p>
                      </p>  








                    </div>
                  </div>

                  <div class="col-lg-4 p-2">


<!-- price card-->
                    <div class="h-100 bg-secondary  p-2 rounded" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                      <?php  

                      $loc=$_POST['picklocation'];
                      $sql = "SELECT * FROM `locations` WHERE location='$loc'";
                   $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
           foreach ($results as $result2) {
             # code...
    


 
     
                    switch ($day) 
                    {
                      case "0":
                      case "1":
                 echo '<h5 class="pt-4 text-white"> $ ',htmlentities($result->price1),' Per Day</h5><h5 class="pt-4 text-white">$ ',htmlentities($result2->locationFee),' Pick Up Fee</h5><h5 class="pt-4 text-white"> $ ',htmlentities($result->price1+$result2->locationFee),' Total</h5>';
                      break;
                      
                      case "2":
                      echo '<h5 class="pt-4 text-white"> $ ',htmlentities($result->price1),' Per Day</h5><h5 class="pt-4 text-white">$ ',htmlentities($result2->locationFee),' Pick Up Fee</h5><h5 class="pt-4 text-white"> $ ',htmlentities($result->price1*$day+$result2->locationFee),' Total</h5>';
                     
                      break;
                      case "3":
                            echo '<h5 class="pt-4 text-white"> $ ',htmlentities($result->price2),' Per Day</h5><h5 class="pt-4 text-white">$ ',htmlentities($result2->locationFee),' Pick Up Fee</h5><h5 class="pt-4 text-white"> $ ',htmlentities($result->price2*$day+$result2->locationFee),' Total</h5>';
                      break;
                      case "4":
                      case "5":
                      case "6":
                         echo '<h5 class="pt-4 text-white"> $ ',htmlentities($result->price3),' Per Day</h5><h5 class="pt-4 text-white">$ ',htmlentities($result2->locationFee),' Pick Up Fee</h5><h5 class="pt-4 text-white"> $ ',htmlentities($result->price3*$day+$result2->locationFee),' Total</h5>';
                      break;
                      case "7":
                       echo '<h5 class="pt-4 text-white"> $ ',htmlentities($result->price4),' Per Day</h5><h5 class="pt-4 text-white">$ ',htmlentities($result2->locationFee),' Pick Up Fee</h5><h5 class="pt-4 text-white"> $ ',htmlentities($result->price4*$day+$result2->locationFee),' Total</h5>';
                      break;
                      case "8":
                      case "9":
                      case "10":
                      case "11":
                      case "12":
                      case "13":
                      case "14":
                      case "15":
                      case "16":
                      case "17":
                      case "18":
                      case "19":
                      case "20":
                      case "21":
                      case "22":
                      case "23":
                      case "24":
                      case "25":
                      case "26":
                      case "27":
                      case "28":
                      case "29":
                     echo '<h5 class="pt-4 text-white"> $ ',htmlentities($result->price5),' Per Day</h5><h5 class="pt-4 text-white">$ ',htmlentities($result2->locationFee),' Pick Up Fee</h5><h5 class="pt-4 text-white"> $ ',htmlentities($result->price5*$day+$result2->locationFee),' Total</h5>';
                      break;
                      default:
                      echo '<div class="bg-warning h-100 p-1 rounded">You Choos To Book More Than 30 Days. Please Contact Us To Get Your Price</div>';
                    }


}

                    ?>
                     </div> 
                  </div>
<!-- price card-->

                </div> 
              </div>           
            <?php }} ?>  



 
             
          </div>
        </div>        

<div class="col-lg-3 my-3 ">
 
 
<div class="card mb-2  sticky-top fixedCard text-dark " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
        <div class="card-header bg-secondary">
          <h5 class="text-white">Choose Extras If needed</h5>
        </div>
        <div class="card-body">
                     <div class="">  
  <table   class="table" >
    <thead>
      <tr>
        
        <th scope="col">Extra</th>
        <th scope="col">Price $</th>

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
  
  <div class="col-lg-9 font-weight-bold"> Total For Extra Services: </div>
 
  <div class="col-lg-3 font-weight-bold">  <span class="showtotal">  </span></div>
</div>

<hr>  
<input type="submit"  class="btn-primary btn btn-block" value="Continue bootking" disabled="true"> 


 
        </div>

                   
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
 <!---------  date piker
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
----------- /date picker ------------>
<script> 
  $(document).ready(function() {

    $("input[type=radio]").removeAttr("checked");

    $("input[type=radio]").click(function () {  
      $("input[type=submit]").removeAttr("disabled");


    }) ;

  }) ;
</script> 

  <script>
    $(document).ready(function(){

      $(".choosecar").on('click',function(){

        var id=$(this).attr('data-panelid');
        var value=$('#panel'+id).find("img").attr('src');
        var value2=$('#panel'+id).find("h4").filter(":first").text();
        var value3=$('#panel'+id).find("h5").filter(":last").text();
        $("#carimg").attr("src",value);
        $("#carname").text(value2);
        $("#test").text(value3);

      })



    })

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
