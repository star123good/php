<?php
session_start();
error_reporting(0);
include_once('includes/config.php');

$_SESSION['test']=$_POST['test'];
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
      <form action="book.php" method="post">
        <div class="px-5 row bg-secondary">
          <!--Side-Bar-------------------------> 

          <div class="col-sm-3 my-2 p-2"> 

            <div class="card bg-light text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"> 


              <div class="card-body">
                <h3 class="card-title">Your Booking Info </h3> <hr>

                <h5 class="mb-1">Pick Up Location</h5>
                <p class="card-text mb-2"><?php echo htmlentities($pickuplocation);?> </p>
                <h5>Pick Up Time</h5>
                <p class="card-text"><?php  

                $date1=date_create("$pickupdate");
                echo date_format($date1,"d F Y");

                ?> <?php echo htmlentities($pickuptime);?></p>
                <p class="card-text"></p>
                <hr>


                <h5 class="mb-1">Drop Off Location</h5>
                <p class="card-text mb-2"><?php echo htmlentities($droplocation);?></p>

                <h5>Drop Off Time</h5>
                <p class="card-text"><?php 
                $date2=date_create("$dropdate");
                echo date_format($date2,"d F Y");
                ?> <?php echo htmlentities($droptime);?></p>

                <hr>
                <div class="bg-info">test: number of days <?php echo htmlentities($days->format('%a'));?> </div>
                <hr>

                <!--car space-->
                <h5>Yor Car</h5>





                <span id="carname">Please Select Car</span>
            <img src="https://via.placeholder.com/5"   class="mt-2" id="carimg" alt="CarImage"><br>


                <div id="panel<?php echo htmlentities($result->id); ?>"> </div> <hr>

<!--car space-->

<!--extra's space-->
<div class="bg-warning"> 
<h5>habnarm </h5>
Name:<span class="showname"></span><br /><br />


price:<span class="showprice"></span>

</div>


<span id="carname">Please Select Car</span>
<img src="https://via.placeholder.com/5" class="mt-2" id="carimg" alt="CarImage"><br>
<div id="panel<?php echo htmlentities($result->id); ?>"></div>
<hr>




<!--/extra's space-->
              





                <input type="submit" name="" class="btn-primary btn btn-block" value="Continue bootking" disabled="true">    



<!-----

<div class="btn btn-primary btn-block"><a href="index.php" class="text-white">edit</a></div>

-->












</div>






</div>
</div>


<!--Side-Bar-------------------------> 



<!--Listing-->

<div class="col-sm-6 my-2 p-2">
  <div class="col-sm-12">  
            <?php
            $startdate=date_create($_POST['pickupdate']);
            $enddate=date_create($_POST['dropdate']);
            $days=date_diff($startdate, $enddate);
            $day=$days->format('%a');

            $sql = "SELECT tblvehicles.*,groups.*,groups.name,groups.idd as bid  from tblvehicles join groups on groups.idd=tblvehicles.VehiclesBrand ORDER by price1 ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
              {  

                ?>
                <div class="card  bg-light border border mb-2 p-4 text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                  
                  <div class="row no-gutters bg" id="panel<?php echo htmlentities($result->id);?>">



                    <div class="col-sm-3" > <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="mh-100   img-responsive" alt="Image"> <div class="w-100 mt-1 radio btn btn-primary">

                      <label class="mb-0"> <input data-panelid="<?php echo htmlentities($result->id);?>" class="choosecar" type="radio" name="vhid" value="<?php echo htmlentities($result->id);?>" required >  Choose</label>

                    </div> 
                  </div>

                  <div class="col-sm-6">
                    <div class="card-block px-2 m-2">
                      <h4 class="card-title"><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h4>



                      <p class="card-text">

                        <p>
                          <ul>
                            <li class="list-inline-item"><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                            <li class="list-inline-item"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                            <li class="list-inline-item"><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                          </ul>
                        </p>
                      </p>  








                    </div>
                  </div>
<!-- price card-->
                  <div class="col-sm-3 p-2 text-center">



                    <div class="h-100 bg-info  rounded" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><?php 
                    switch ($day) {
                      case "1":
                      case "2":
                      echo '<h4 class="pt-4 text-white"> $',htmlentities($result->price1),'</h4><h4 class="text-white h-100 pt-3 rounded">Per Day</h4>';
                      break;
                      case "3":
                      echo '<h4 class="pt-4 text-white"> $',htmlentities($result->price2),'</h4><h4 class="text-white h-100 pt-3 rounded">Per Day</h4>';
                      break;
                      case "4":
                      case "5":
                      case "6":
                      echo '<h4 class="pt-4 text-white"> $',htmlentities($result->price3),'</h4><h4 class="text-white h-100 pt-3 rounded">Per Day</h4>';
                      break;
                      case "7":
                      echo '<h4 class="pt-4 text-white"> $',htmlentities($result->price4),'</h4><h4 class="text-white h-100 pt-3 rounded">Per Day</h4>';
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
                      echo '<h4 class="pt-4 text-white"> $',htmlentities($result->price5),'</h4><h4 class="text-white h-100 pt-3 rounded">Per Day</h4>';
                      break;
                      default:
                      echo '<div class="bg-warning h-100 p-1 rounded">You Choos To Book More Than 30 Days. Please Contact Us To Get Your Price</div>';
                    }?>
                     </div> 




                  </div>
                </div> 
              </div>           
            <?php }} ?> ?>
          </div>
        </div>        

<div class="col-sm-3 my-3">
  <div class="card bg-light mb-2 text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
        <div class="card-header">
          <h5>Pick Esxtra Services</h5>
        </div>
        <div class="card-body">
          
           


<div class="">  
   <form action="#"> 
  
      <?php
      $sql = "SELECT * FROM extras";
      $query = $dbh -> prepare($sql);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query->rowCount() > 0)
      {
        foreach($results as $result)
        {  
          ?>
          <div class="form-row"> 
            <div class="from-group col-sm-8">
             <label> <input class="extra" data-priceid="<?php echo htmlentities($result->id);?>" type="checkbox" value="<?php echo htmlentities($result->name);?>" id="defaultCheck1">
          
                <?php echo htmlentities($result->name);?>
              </label></div>

              <div class="from-group col-sm-4">$ 
            <?php echo htmlentities($result->price);?>  </div>

            </div>

      <?php }  ?><?php }?> 
   </form>
          </div>







 
        </div>
      </div>


<div class="card bg-light mb-2 text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
        <div class="card-header bg-danger">
          <h5>HABNARM</h5>
        </div>
        <div class="card-body">
                     <div class="">  
  <table   class="table" >
    <thead>
      <tr>
        
        <th scope="col">Extra</th>
        <th scope="col">Price</th>

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
        {  
          ?>

          <tr id="price<?php echo htmlentities($result->id);?>">
            
<!------- habnarm---->

<td class="getname">
<input type="checkbox"  data-priceid="<?php echo htmlentities($result->id);?>" class="extraname" value="<?php echo htmlentities($result->name);?>"><?php echo htmlentities($result->name);?>
</td>
          
          <td class="getprice"> <?php echo htmlentities($result->price);?></td>

           
        </tr>

      <?php }  ?><?php }?> 
    </tbody>
  </table>

          </div>







 
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

<script> 
  $(document).ready(function() {

    $("input[type=radio]").removeAttr("checked");

    $("input[type=radio]").click(function () {  
      $("input[type=submit]").removeAttr("disabled");


    }) ;

  }) ;</script> 
  <script>
    $(document).ready(function(){

      $(".choosecar").on('click',function(){

        var id=$(this).attr('data-panelid');
        var value=$('#panel'+id).find("img").attr('src');
        var value2=$('#panel'+id).find("h4").filter(":first").text();
        $("#carimg").attr("src",value);
        $("#carname").text(value2);

      })



    })

  </script>
  <script type="text/javascript">
$(document).ready(function() {

  $('.extraname').on('click',function(){
    $('.choosenname').remove();
    $('.choosenprice').remove();
    
        $('.extraname:checked').each(function(i, element) {
              var allnames=[];
              var allprices=[];
              
            var id=$(this).attr('data-priceid');

            allnames.push($('#price'+id).find("td.getname").text());
            allprices.push($('#price'+id).find("td.getprice").text());
            
            $.each(allnames,function(i, val) {
            $(".showname").append("<div class='choosenname'>"+val+"</div>");
            });
            
            $.each(allprices,function(i, val) {
            $(".showprice").append("<div class='choosenprice'>"+val+"</div>");
            });
          
          });

    })  
})



</script>

</body>
</html>
