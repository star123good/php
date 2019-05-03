 <?php  
session_start();
include_once('includes/config.php');

error_reporting(0);


if(isset($_POST['submit']))
  {
    

$firstName=$_POST['fname'];
$LastName=$_POST['lname'];
$email=$_POST['email'];
$telefoni=$_POST['num'];
$frena=$_POST['airl'];
$frena2=$_POST['flnum'];
$car=$_POST['carname'];
$extras=$_POST['extrass'];
$loc1=$_POST['picklocation'];
$loc2=$_POST['droplocation'];
$date1=$_POST['pickupdate'];
$date2=$_POST['dropdate'];
$time1=$_POST['pickuptime'];
$time2=$_POST['droptime'];
$mes=$_POST['com'];
$carprice=$_POST['carpr'];
$extraprice=$_POST['exTot'];
$total=$_POST['totalP'];
$locfee=$_POST['lcofeE'];
 

    $sql="INSERT INTO`bookings`(`firstName`,`LastName`,`email`,`telefoni`,`frena`,`frena2`,`car`,`extras`,`loc1`,`loc2`,`date1`,`date2`,`time1`,`time2`,`mes`,`carprice`,`extraprice`,`total`,`locfee`)VALUES(:firstName,:LastName,:email,:telefoni,:frena,:frena2,:car,:extras,:loc1,:loc2,:date1,:date2,:time1,:time2,:mes,:carprice,:extraprice,:total,:locfee)";

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
      $msg="Requset sent successfully. We will contact you within 24 hours";



$to =  $email; 
$subject = "Book Requset";

$message = ' 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
</head>

<body>
    <div class="es-wrapper-color">
        <!--[if gte mso 9]>
      <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#cccccc"></v:fill>
      </v:background>
    <![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table class="es-content es-preheader esd-header-popover" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="es-adaptive esd-stripe" align="center">
                                        <table class="es-content-body" style="background-color: rgb(239, 239, 239);" width="600" cellspacing="0" cellpadding="0" bgcolor="#efefef" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p10t es-p10b es-p40r es-p40l" esd-general-paddings-checked="true" align="left">
                                                        <!--[if mso]><table width="520" cellpadding="0" cellspacing="0"><tr><td width="250" valign="top"><![endif]-->
                                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="250" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-empty-container" style="display: none;"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="20"></td><td width="250" valign="top"><![endif]-->
                                                        <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="250" align="left">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-empty-container" style="display: none;"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-header" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="es-adaptive esd-stripe" align="center">
                                        <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20b es-p40r es-p40l" esd-general-paddings-checked="true" align="left">
                                                        
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="3109" align="center">
                                        <table class="es-content-body" style="background-color: rgb(255, 255, 255);" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20b es-p40r es-p40l" esd-general-paddings-checked="true" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="520" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-text" align="left">
                                                                                        <h1 style="color: #4a7eb0;">Your Book Request Submited</h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-spacer es-p5t es-p20b" align="left">
                                                                                        <table width="5%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-bottom: 2px solid rgb(153, 153, 153); background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text es-p10b" align="left">
<p><span style="font-size: 16px; line-height: 150%;">Hi, '.$firstName.' '.$LastName.',</span></p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text" align="left">
                                                                                        <p>We Received Your Order. We Are Takeing Action. You will be notified about result as soon as possible.</p>
                                                                                        <h2>Order Number: SCR'.$lastInsertId.'</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-text" align="left">
                                                                                        <p>  <br></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-spacer es-p20">
                                                                                        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-bottom: 1px solid #cccccc; background:none; height:1px; width:100%; margin:0px 0px 0px 0px;"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                

                                                                                <th colspan="2"><h2>Order Details</h2> </th><tr>
                                                                                    <td align="left" class="esd-block-text">

<h3>Car: '.$car.' <h3/>
<h3>Locations<h3/> <p>
Pick up: '.$loc1.' <br>
Drop off: '.$loc2.'

 </p>

                                                                                    </td>
<h3>Dates<h3/>
'.$date1.' '.$time1.' - '.$date2.' '.$time2.' 

<h3>Extras: <h3/>
'.$extras.'

                                                                                    <td align="left" class="esd-block-text">


                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
<td>
<h3> Prices: <h3/>
<p>car price: '.$carprice.' <br> 
pick up fee: '.$locfee.'<br>
extras: '.$extraprice.' <br>
<h3>TOTAL: $'.$total.' <h3>
</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-spacer es-p20">
                                                                                        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-bottom: 1px solid #cccccc; background:none; height:1px; width:100%; margin:0px 0px 0px 0px;"></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr> </tr>
                                <tr>
                                    <td class="esd-stripe" esd-custom-block-id="3104" align="center">
                                        <table class="es-footer-body" style="background-color: rgb(239, 239, 239);" width="600" cellspacing="0" cellpadding="0" bgcolor="#efefef" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20" align="left">
                                                        <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="194"><![endif]-->
                                                        <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b esd-container-frame" width="174" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-block-image es-m-p0l es-p10b" align="left">
                                                                                        <a href="" target="_blank"><img src="http://supercarrent.ge/assets/img/logo.png" alt="" width="153" style="display: block;"> </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden" width="20"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="173"><![endif]-->
                                                         
                                                        <!--[if mso]></td><td width="20"></td><td width="173"><![endif]-->
                                                        <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b esd-container-frame" width="173" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="es-m-txt-с esd-block-text es-p10b es-m-txt-l" esdev-links-color="#333333" align="left">
                                                                                        <p style="color: #333333; font-size: 20px; line-height: 150%;">+995 599 188 481</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="es-m-txt-с esd-block-text es-p10b" esdev-links-color="#333333" align="left">
                                                                                        <div style="color: #333333;"> <span style="font-size:14px;">info@supercarrent.ge</span> </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p15b es-p20r es-p20l" esd-general-paddings-checked="false" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-empty-container" style="display: none;"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@supercarrent.ge>' . "\r\n";
$headers .= 'Cc: info@supercarrent.ge' . "\r\n";

mail($to,$subject,$message,$headers);
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
<div class="container"> 
  
 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php ?> </div><?php } 
                else if($msg){  
  ?>
                  <!-- confirm wrap  -->











<div class="ttt  p-5">
<div class=" bg-light p-4 rounded  tt  text-dark mb-2" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
<h5 class="text-center mb-1">Your Request Sent Successfully</h5>
<p class="text-center">We will contact you within 24 hours</p> <hr>
<div class="carsd bg-light text-dark mb-2"  >    
           
          <div class="card-body"> 
            <h5 class="card-title">Pick Up</h5>
            <p class="card-text"><?php echo $_POST['picklocation']; ?> | <?php echo $_POST['pickupdate']; ?> <?php echo $_POST['pickuptime']; ?></p> <br>
            
            <h5 class="card-title">Drop Off </h5>
            <p class="card-text"><?php echo $_POST['droplocation']; ?> | <?php echo $_POST['dropdate']; ?> <?php echo $_POST['droptime']; ?></p>  
             
             
 
           
          <br>
          <div class="row">
            <div  class="col-md-6">
              <h5 class="card-title">Car</h5>
            <p class="card-text"><?php 
 
                print_r($car);
             
               ?></p> </div>
            <div  class="col-md-6">
                     <h5 class="card-title">Order N</h5>
                     <p class="card-text"><?php 
 
                 
                echo "SCR";print_r($lastInsertId);
               ?></p> 
            </div>
          </div>
              
             
    <hr>
<h5 class="text-center "><button class=" btn btn-primary"><a class="text-white" href="index.php">OK</a></button></h5>  
 


          </div>
        </div></div>
 </div>
    <!-- /confirm wrap  -->
                    <div class="succWrap"><strong>SUCCEssssssssssSS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
   <!--day counter-->
    <div class="row">

<div class="col-sm-12 p-2"> <div class="card mb-2" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
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
 $wq1=$_POST['pickuptime'];
 $wq2=$_POST['droptime'];
 

$date111 = new DateTime($wq1);
$date222 = new DateTime($wq2);

// The diff-methods returns a new DateInterval-object...
$difff = $date222->diff($date111);
 
print_r($diff);
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
        </div></div>

    </div>
   <!--/day counter-->
    <div class="row no-gutter">

      <!-- booking info-->
     <div class="col-md-3 p-2 pb-3">  
<div class="card bg-light text-dark mb-2" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
          <div class="card-header bg-secondary"><h5 class="text-white">Your Booking Info</h5></div>
          <div class="card-body"> 
            <h5 class="card-title">Pick Up Location</h5>
            <p class="card-text"><?php echo $_POST['picklocation']; ?></p> <br>
            
            <h5 class="card-title">Drop Off Location</h5>
            <p class="card-text"><?php echo $_POST['droplocation']; ?></p> <hr>
            
            <h5 class="card-title">Pick Up Date</h5>
            <p class="card-text"><?php echo $_POST['pickupdate']; ?> <?php echo $_POST['pickuptime']; ?></p> <br>

            <h5 class="card-title">Drop Off Date</h5>
            <p class="card-text"><?php echo $_POST['dropdate']; ?> <?php echo $_POST['droptime']; ?></p> 
            <hr>
              <h5 class="card-title">Car</h5>
            <p class="card-text"><?php 




$vv=$_POST['carId'];
  
$sql = "SELECT * from groups where idd=$vv" ;
          
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
           
              foreach($results as $groups);
                print_r($groups->name);
               ?></p> 
             
  
                    
                
     

 


          </div>
        </div>

     </div>
<!--- personaluri informacia-->
      <div class="col-md-6 p-2 pb-3">  
       
        <div class="card  bg-light text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">    
          <div class="card-header bg-secondary"><h5 class="text-white">Please Enter You Personal Information</h5></div>
          <div class="card-body">

                 
<form  method="post">

 
   


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inpNam">First Name*</label>
      
      <input type="text" class="form-control"  placeholder="First name"  required name="fname">
    </div>
    <div class="form-group col-md-6">
      <label for="inpLasNam">Last Name*</label>
      <input type="text" class="form-control"  placeholder="Last name" required  name="lname">
    </div>
  </div>
<input type="text" name="carname" value="<?php print_r($groups->name); ?>" required hidden>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputEmail4">Email*</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" required  name="email">
  </div>
  <div class="form-group col-md-6">
    <label for="inputNum">Phone Number*</label>
    <input type="text" class="form-control" id="inputNum" placeholder="contact number" required  name="num">
  </div>
</div>
  <hr>  
   <h5>Please Enter You Flight Information</h5>  <label>optional</label>
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
      <input class="form-check-input" type="checkbox"   required id="gridCheck"> 
      <label class="form-check-label" for="gridCheck">
        I agree for <a href="page?type=terms" target="_blank"><span class="text-info">terms end conditions</span></a>
        <input type="text" hidden name="picklocation" value="<?php echo htmlentities($_POST['picklocation']) ?>">
<input type="text" hidden name="pickupdate" value="<?php print_r($_POST['pickupdate']) ?>">
<input type="text" hidden name="pickuptime" value="<?php print_r($_POST['pickuptime']) ?>">
<input type="text" hidden name="droplocation" value="<?php print_r($_POST['droplocation']) ?>">
<input type="text" hidden name="dropdate" value="<?php print_r($_POST['dropdate']) ?>">
<input type="text" hidden name="droptime" value="<?php print_r($_POST['droptime']) ?>">
      </label> <button class="btn btn-primary" name="submit" type="submit">Book</button>
    </div>
  </div>


          

  
  </div>
</div>  

</div>

<!-- pricelist-->

<div class="col-md-3 p-2">  

<div class="card    bg-light text-dark" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">   
  <h5 class="card-header bg-secondary text-white">Price Lists</h5>



<?php 
$loc=$_POST['picklocation'] ;
                     
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
   $day=$dayyy;

 

switch ($day) {
                      case "0":
                      case "1":
                      case "2":
                      $carprice=$groups->price1*$day;
                     echo  htmlentities($carprice);
                      break;
                      
                      case "3":
                      $carprice=$groups->price2*$day;
                     echo  htmlentities($carprice);
                      break;
                      
                      case "4":
                      case "5":
                      case "6":
                      $carprice=$groups->price3*$day;
                     echo  htmlentities($carprice);
                      break;
                      case "7":
                      $carprice=$groups->price4*$day;
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
                      $carprice=$groups->price5*$day;
                     echo  htmlentities($carprice);
                      break;
                      default:
                      echo '<div class="bg-warning h-100 p-1 rounded">You Choos To Book More Than 30 Days. Please Contact Us To Get Your Price</div>';
                    }


    ?>
</h5> 
<input type="text" name="carpr" value="<?php echo  htmlentities($carprice); ?>" hidden >



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
    $da=$day;
    if ($da>7) {
         $da=7;
       } ;
          
    $sql = " SELECT * FROM extras where name ='$extra2'";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
    foreach($results as $ressss); 
    print_r($ressss->price*$da);
    $pricee2=$ressss->price*$da;
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
    print_r($ressss->price*$da);
    $pricee3=$ressss->price*$da;
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
    print_r($ressss->price*$da);
    $pricee4=$ressss->price*$da;
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
    print_r($ressss->price*$da);
    $pricee5=$ressss->price*$da;
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
    print_r($ressss->price*$da);
    $pricee6=$ressss->price*$da;
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
    print_r($ressss->price*$da);
    $pricee7=$ressss->price*$da;
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
    print_r($ressss->price*$da);
    $pricee8=$ressss->price*$da;
  }
    ?></p>
 

  </div>
</div>

     <hr>
     

  <div class="row">
   <div class="col-sm-8"> <h5 class="text-right">total</h5></div>
   <div class="col-sm-4"> <h5>$
     <?php print_r($carprice+$result2->locationFee+$pricee2+$pricee3+$pricee4+$pricee5+$pricee6+$pricee7+$pricee8);
     $exTot=$pricee2+$pricee3+$pricee4+$pricee5+$pricee6+$pricee7+$pricee8; ?>
   </h5>

<input type="text" name="exTot" value="<?php print_r($exTot) ?>" hidden>
<input type="text" name="lcofeE" value="<?php print_r($locfee) ?>" hidden>
 <input type="text" name="totalP" value="<?php echo $exTot+$locfee+$carprice?>" hidden>   <span>  <?php 
 
  $extras = array( $extra2,$extra3,$extra4,$extra5,$extra7,$extra8);
   
    ?></span></div>
 
 
   <input type="text" name="extrass" value="<?php echo $extras['0'],$extras['1'],$extras['2'],$extras['3'],$extras['4'],$extras['5'],$extras['6'],$extras['7'] ; ?>" hidden>
</form>
  </div>

 </div>
</div>








        
    </div>



</div> </div> 
  <!-- footer --> 
   <!-- footer --> 
  <?php include('includes/footer.php');?>
  <!-- /footer -->
  <!-- /footer -->
</body>
</html>