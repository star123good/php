<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if(isset($_POST['send']))
{
  $name=$_POST['fullname'];
  $email=$_POST['email'];
  $contactno=$_POST['contactno'];
  $message=$_POST['message'];
  $sql="INSERT INTO  tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':name',$name,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
  $query->bindParam(':message',$message,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId)
  {
    $msg="Query Sent. We will contact you shortly";
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
  <title>Super Car Rent | Contact Us</title>
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

</head>
<body>
  <!--Header-->
  <?php include('includes/header.php');?>
  <!-- /Header -->
  <!-- breadcrumb area   -->
  <section class="breadcrumb-area contactus-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Contact Us</h2>
           
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb area end -->

  <!--Contact-us-->


  <div class="container contact">
      <style type="text/css">
      .contact{
        padding: 4%;
      }
      .contact .col-md-4{
        background: #ff9b00;
        padding: 2%;
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
      }
      .contact-info{
        margin-top:5%;
      }
      .contact-info img{
        margin-bottom: 3%;
      }
      .contact-info h2, h5 {
        margin-bottom:4%;
        color: black !important;
      }

      .contact .col-md-8{
        background: #fff;
        padding: 3%;
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
      }
      .contact-form label{
        font-weight:600;
      }
      .contact-form button{
        background: #25274d;
        color: #fff;
        font-weight: 600;
        width: 25%;
      }
      .contact-form button:focus{
        box-shadow:none;
      }
    </style>


  <div class="row">
    <div class="col-md-4">
      <div class="contact-info">
        <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
        <h2>Contact Us</h2>
        <h5>We would love to hear from you !</h5><hr> 
        <?php if($error){?>
          <div class="errorWrap">
            <strong>ERROR</strong>:
            <?php echo htmlentities($error); ?>
            </div><?php } 
            else if($msg)
              {?>  <div class="succWrap"> </div>

            <script type='text/javascript'>alert('<?php echo htmlentities($msg); ?>')</script>

          <?php }?>



        </div>
        <div class="contact-info">
          <?php 
          $pagetype=$_GET['type'];
          $sql = "SELECT workingHours,Address,EmailId,ContactNo from tblcontactusinfo";
          $query = $dbh -> prepare($sql);
          $query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
            foreach($results as $result)
              { ?>

                <ul>
                  <h5><li><i class="icofont icofont-clock-time"> </i><?php   echo htmlentities($result->workingHours); ?></li></h5>
                  <h5><li><i class="icofont icofont-globe"></i> <?php   echo htmlentities($result->Address); ?></li></h5> 
                  <h5><li><a style="color: black !important" href="tel:<?php   echo htmlentities($result->ContactNo); ?>"><i class="icofont icofont-telephone"> </i><?php   echo htmlentities($result->ContactNo); ?></a></li></h5> 
                  <h5><li><a style="color: black !important" href="mailto:<?php   echo htmlentities($result->EmailId); ?>"><i class="icofont icofont-envelope"> </i><?php   echo htmlentities($result->EmailId); ?></a></li></h5>
                </ul>
              <?php }} ?>
            </div>
          </div>

          <div class="col-md-8">
            <div class="contact-form">
              <form  method="post">

               
                <div class="form-group">

                  <div class="col-sm-10">  
                    <input type="text" class="form-control" placeholder="Enter Full Name" name="fullname" required="">
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="email" class="form-control"  placeholder="Enter Email Address" name="email" required>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text" name="contactno" class="form-control" placeholder="Enter Phone Number" required>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="5"  name="message" placeholder="Type Message" required></textarea>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-10"><button class="btn" type="submit" name="send" type="submit">Send</button></div>

                </div>
 </form>
              </div>
            </div>
          </div>



        </div>
     
   









    <!-- /Contact-us--> 
    <!-- footer --> 
    <?php include('includes/footer.php');?>
    <!-- /footer -->
  </body>
  </html>