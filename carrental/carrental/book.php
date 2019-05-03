<?php 
session_start();
include_once('includes/config.php');
error_reporting(0);


if(isset($_POST['submit']))
  {
    

$firstName=5;
$LastName=5;
$email=5;
$telefoni=5;
$frena=5;
$frena2=5;
$car=5;
$extras=5;
$loc1=5;
$loc2=5;
$date1=5;
$date2=5;
$time1=5;
$time2=5;
$mes=5;
$carprice=5;
$extraprice=5;
$total=5;
$locfee=5;


    $sql="INSERT INTO `bookings`(`firstName`, `LastName`, `email`, `telefoni`, `frena`, `frena2`, `car`, `extras`, `loc1`, `loc2`, `date1`, `date2`, `time1`, `time2`, `mes`, `carprice`, `extraprice`, `total`, `locfee`) 

    VALUES (:firstName,:LastName,:email,:telefoni,:frena,:frena2,:car,:extras,:loc1,:loc2,:date1,:date2,:time1,:time2,:mes,:carprice,:extraprice,:total,:locfee) ";

    $query = $dbh->prepare($sql);
   $query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
   $query->bindParam(':LastName',$LastName,PDO::PARAM_STR);
   $query->bindParam(':email',$email,PDO::PARAM_STR);
   $query->bindParam(':telefoni',$telefoni,PDO::PARAM_STR);
   $query->bindParam(':frena',$frena,PDO::PARAM_STR);
   $query->bindParam(':frena2',$frena2,PDO::PARAM_STR);
   $query->bindParam(':car',$car,PDO::PARAM_STR);
   $query->bindParam(':extras',$extras,PDO::PARAM_STR);
   $query->bindParam(':loc1',$loc1,PDO::PARAM_STR);
   $query->bindParam(':loc2',$loc2,PDO::PARAM_STR);
   $query->bindParam(':date1',$date1,PDO::PARAM_STR);
   $query->bindParam(':date2',$date2,PDO::PARAM_STR);
   $query->bindParam(':time1',$time1,PDO::PARAM_STR);
   $query->bindParam(':time2',$time2,PDO::PARAM_STR);
   $query->bindParam(':mes',$mes,PDO::PARAM_STR);
   $query->bindParam(':carprice',$carprice,PDO::PARAM_STR);
   $query->bindParam(':extraprice',$extraprice,PDO::PARAM_STR);
   $query->bindParam(':total',$total,PDO::PARAM_STR);
   $query->bindParam(':locfee',$locfee,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      $msg="Extra Added successfully";
    }
    else  
    {
      $error="Something went wrong. Please try again";
    }

  }
 
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

  <?php include('includes/header.php');?>
  <!--Header-->
  <!-------- page --->

  <div class=" bg-dark  ">
    <div class="px-5 row bg-secondary">
<!--      <div class="col-md-3 p-2"> 
        <div class="card bg-light text-dark mb-2" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
          <div class="card-header bg-primary"><h5>Your Booking Info</h5></div>
          <div class="card-body"> 
            <h5 class="card-title">Pick Up Location</h5>
            <p class="card-text"><?php echo $_SESSION['picklocation']; ?></p> <br>
            
            <h5 class="card-title">Drop Off Location</h5>
            <p class="card-text"><?php echo $_SESSION['droplocation']; ?></p> <hr>
            
            <h5 class="card-title">Pick Up Date</h5>
            <p class="card-text"><?php echo $_SESSION['pickupdate']; ?> <?php echo $_SESSION['pickuptime']; ?></p> <br>

            <h5 class="card-title">Drop Off Date</h5>
            <p class="card-text"><?php echo $_SESSION['dropdate']; ?> <?php echo $_SESSION['dropptime']; ?></p> 
            <hr>
              <h5 class="card-title">Car</h5>
            <p class="card-text"><?php 




$vv=$_POST['vhid'];
  
$sql = "SELECT * from groups where idd=$vv" ;
          
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
           
              foreach($results as $ww);
                print_r($ww->name);
                $_POST['carname']=$ww->name; ?></p> 
             
  
                    
                
     

 


          </div>
        </div>
         
      </div> -->
      <div class="col-md-6 p-2 pb-3">  
        <div class="card h-100  bg-light text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
          <div class="card-header bg-primary"><h5>Please Enter You Personal Information</h5></div>
          <div class="card-body">
<h5><?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                  else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?></h5>
                  <input type="submit" name="">
<form  method="post">

 
   


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inpNam">First Name*</label>
      <input type="text" class="form-control" id="inpNam" placeholder="First name" required="true" name="fname">
    </div>
    <div class="form-group col-md-6">
      <label for="inpLasNam">Last Name*</label>
      <input type="text" class="form-control" id="inpLasNam" placeholder="Last name" required="true" name="lname">
    </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputEmail4">Email*</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" required="true" name="email">
  </div>
  <div class="form-group col-md-6">
    <label for="inputNum">Phone Number*</label>
    <input type="text" class="form-control" id="inputNum" placeholder="contact number" required="true" name="num">
  </div>
</div>
  <hr>  
   <h5>Please Enter You Flight Information</h5> <br> 
  <div class="form-row">
      <div class="form-group col-md-6">
      <label for="fNum">Airline or Train Service</label>
      <input type="text" class="form-control" id="fNum" name="airl">
      
    </div>
    <div class="form-group col-md-6">
      <label for="fNum">Flight Number</label>
      <input type="text" class="form-control" id="fNum" name="flnum">
      
    </div>
      
  </div>
  <div class="form-group">
    <label for="userMes">Comment</label>
    <textarea class="form-control" id="userMes" rows="3" name="com"></textarea>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" required="" id="gridCheck"> 
      <label class="form-check-label" for="gridCheck">
        I agree for <a href="#"><span class="text-info">terms end conditions</span></a>
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" ">Book</button>
</form>

<p> results <br>
<?php 

 

$vv=$_POST['vhid'];
  
$sql = "SELECT * from groups where idd=$vv" ;
          
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
           
              foreach($results as $groups);
                print_r($groups); ?>
  <br>post<br>
<?php
 
 
print_r($_POST);






 ?> 
 <br>sesion<br>
 <?php print_r($_SESSION) ?>



           </p> 

          </div>
        </div>
      </div>
      <div class="col-md-3 p-2">  

<div class="card text-dark mb-2">
  <h5 class="card-header bg-primary">Price Lists</h5>



<?php 
$loc=$_SESSION['picklocation'] ;
                     
                      $sql = "SELECT * FROM `locations` WHERE location='$loc'";
                   $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
           foreach ($results as $result2)
 
  

 ?>

  <div class="card-body">
<br>
<div class="row">
  <div class="col-sm-8">
    <h5>Car price</h5>
  </div>
  <div class="col-sm-4">

<h5>
    <?php 
   $day= $_SESSION['day'];



switch ($day) {
                      case "0":
                      case "1":
                      $carprice=$groups->price1*$day;
                     echo  htmlentities($carprice);
                      break;
                      
                      case "2":
                      $carprice=$groups->price2*$day;
                     echo  htmlentities($carprice);
                      break;
                      case "3":
                      $carprice=$groups->price3*$day;
                     echo  htmlentities($carprice);
                      break;
                      case "4":
                      case "5":
                      case "6":
                      $carprice=$groups->price4*$day;
                     echo  htmlentities($carprice);
                      break;
                      case "7":
                      $carprice=$groups->price5*$day;
                     echo  htmlentities($carprice);
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
                      $carprice=$groups->pricee6*$day;
                     echo  htmlentities($carprice);
                      break;
                      default:
                      echo '<div class="bg-warning h-100 p-1 rounded">You Choos To Book More Than 30 Days. Please Contact Us To Get Your Price</div>';
                    }


    ?>
</h5>



  </div>
</div>
<br>
<div class="row">
  <div class="col-sm-8">
    <h5>Pick up fee</h5>
  </div>
  <div class="col-sm-4">
    <h5><?php echo $result2->locationFee;
    $locfee=$result2->locationFee; ?></h5>

  </div>
  
</div>
<br>
<div class="row">
  <div class="col-sm-8">
    <h5>extras                                  </h5>
    <?php 
$extra2=$_POST['extra2'];
$extra3=$_POST['extra3'];
$extra4=$_POST['extra4'];
$extra5=$_POST['extra5'];
$extra6=$_POST['extra6'];
$extra7=$_POST['extra7'];
$extra8=$_POST['extra8'];

     ?>
       <p> <?php  print_r($_POST['extra2']) ?></p>
         <p><?php  print_r($_POST['extra3']) ?></p>
         <p><?php  print_r($_POST['extra4']) ?></p>
         <p><?php  print_r($_POST['extra5']) ?></p>
         <p><?php  print_r($_POST['extra6']) ?></p>
         <p><?php  print_r($_POST['extra7']) ?></p>
         <p><?php  print_r($_POST['extra8']) ?></p>
  </div>
  <div class="col-sm-4">
    <h5> <br></h5>
    <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra2'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee2=$ressss->price*$day;
  }
    ?></p>
 <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra3'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee3=$ressss->price*$day;
  }
    ?></p>
 <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra4'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee4=$ressss->price*$day;
  }
    ?></p>

     <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra5'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee5=$ressss->price*$day;
  }
    ?></p>
 <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra6'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee6=$ressss->price*$day;
  }
    ?></p>
     <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra6'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee7=$ressss->price*$day;
  }
    ?></p>

     <p> <?php    
    $sql = " SELECT * FROM extras where name ='$extra8'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$day);
    $pricee8=$ressss->price*$day;
  }
    ?></p>
 

  </div>
</div>

     <hr>
     

  <div class="row">
   <div class="col-sm-8"> <h5 class="text-right">total</h5></div>
   <div class="col-sm-4"> <h5>$
     <?php print_r($carprice+$result2->locationFee+$pricee2+$pricee3+$pricee4+$pricee5+$pricee6+$pricee7+$pricee8) ?>
   </h5><span>sasas <?php 
 
  $extras = array( $extra2,$extra3,$extra4,$extra5,$extra7,$extra8 );
  
    ?></span></div>
  
<input type="text" name="totalPrice" value="<?php print_r($carprice+$result2->locationFee+$pricee2+$pricee3+$pricee4+$pricee5+$pricee6+$pricee7+$pricee8) ?> add hdden atrr" disabled  >  <button class="btn btn-primary" name="submit" type="submit">Save</button>
  </div>

 </div>
</div>








        
    </div>
  </div>
</div>  
  <!-- footer --> 
  <?php include('includes/footer.php');?>
  <!-- /footer -->
</body>
</html>