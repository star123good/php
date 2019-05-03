<!-- footer section start -->
		<footer class="footer">
			<div class="container">
				
				<div class="row mt-30">
                    <div class="col-md-4">
                        <div class="widget">
							<a href="index.php"><img alt="footer-logo" src="assets/img/footer-logo.png"></a>
							 
						
						</div>
                    </div>
                    <div class="col-md-2">
                        <div class="widget">
							<h4 class="widget-title"><?=$languages[28][$lang_select]?></h4>
							<ul>
								 <li class=" ">
          <a class=" " href="index.php"><i class="icofont icofont-curved-double-right"></i> <?=$languages[0][$lang_select]?></a>
        </li>
        <li class="nav-item">
          <a class=" " href="carguides.php"><i class="icofont icofont-curved-double-right"></i> <?=$languages[2][$lang_select]?></a>
        </li>
        
        <li class=" ">
          <a class=" " href="page.php?type=aboutus"><i class="icofont icofont-curved-double-right"></i> <?=$languages[9][$lang_select]?></a>
        </li>
        <li class=" ">
          <a class=" " href="page.php?type=contactus"><i class="icofont icofont-curved-double-right"></i> <?=$languages[11][$lang_select]?></a>
        </li>
         <li class=" ">
          <a class=" " href="page.php?type=faqs"><i class="icofont icofont-curved-double-right"></i> <?=$languages[10][$lang_select]?></a>
        </li>
								
							</ul>
						</div>
                    </div>
                    

   <div class="col-md-3">
                        <div class="widget">
							<h4 class="widget-title"><?=$languages[3][$lang_select]?></h4>
							<ul>
								 <li class=" ">
          <a class=" " href="page.php?type=str"><i class="icofont icofont-curved-double-right"></i> <?=$languages[4][$lang_select]?></a>
        </li>
        <li class="nav-item">
          <a class=" " href="page.php?type=ltr"><i class="icofont icofont-curved-double-right"></i> <?=$languages[5][$lang_select]?></a>
        </li>
        <li class="nav-item">
          <a class=" " href="page.php?type=cr"><i class="icofont icofont-curved-double-right"></i> <?=$languages[6][$lang_select]?></a>
        </li>
         <li class="nav-item">
          <a class=" " href="page.php?type=cs"><i class="icofont icofont-curved-double-right"></i> <?=$languages[7][$lang_select]?></a>
        </li>
         <li class="nav-item">
          <a class=" " href="page.php?type=ts"><i class="icofont icofont-curved-double-right"></i> <?=$languages[8][$lang_select]?></a>
        </li>
					
					
								
							</ul>
						</div>
                    </div>
                    




                    <div class="col-lg-3">
                        <div class="widget widget-get-in-touch">
							<h4 class="widget-title"><?=$languages[29][$lang_select]?></h4>
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
													<li><i class="icofont icofont-clock-time"></i><?php   echo htmlentities($result->workingHours); ?></li>
													 
													<li><a href="tel:<?php   echo htmlentities($result->ContactNo); ?>"><i class="icofont icofont-telephone"></i><?php   echo htmlentities($result->ContactNo); ?></a></li>
													<li><a href="mailto:<?php   echo htmlentities($result->EmailId); ?>"><i class="icofont icofont-envelope"></i><?php   echo htmlentities($result->EmailId); ?></a></li>
												</ul>
												<?php }} ?>
						</div>	<div class="widget-social-icons">
								<a href="#"><i class="icofont icofont-social-facebook"></i></a>
								<a href="#"><i class="icofont icofont-social-twitter"></i></a>
								<a href="#"><i class="icofont icofont-social-skype"></i></a>
								<a href="#"><i class="icofont icofont-social-pinterest"></i></a>
								<a href="#"><i class="icofont icofont-social-google-plus"></i></a>
							</div>
                    </div>

				</div>	 
						<div class="text-center pb-5"><hr class="bg-info">
							<p><?=$languages[30][$lang_select]?></p>
						</div>
					 
			</div>
			</div>
		
		</footer>
		<!-- footer section end -->
		<a href="#" class="scrollToTop">
			<i class="icofont icofont-arrow-up"></i>
		</a>

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

		
		<!-- jquery main JS -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
		<!-- Bootstrap JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Slicknav JS -->
		<script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- owl carousel JS -->
		<script src="assets/js/owl.carousel.min.js"></script>
		<!-- Popup JS -->
		<script src="assets/js/jquery.magnific-popup.min.js"></script>
		<!-- Counterup JS -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<!-- Counterup waypoints JS -->
		<script src="assets/js/waypoints.min.js"></script>
		<!-- Isotope JS -->
		<script src="assets/js/isotope.pkgd.min.js"></script>
		<!-- Vega JS -->
		<script src="assets/js/vegas.min.js"></script>
		<!-- main JS -->
		<script src="assets/js/main.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>