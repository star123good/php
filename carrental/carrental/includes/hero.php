 <!-- hero area start -->
<section class="hero-area slideslow-bg" id="slideslow-bg">
	<div class="container">
		<div class="row "> 
			<div class="col-lg-4 no-gutter">
				<div class="card bg-dark border border-dark rounded" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					<div class="card-header"> <h5 class="text-light"><?=$languages[31][$lang_select]?></h5>
					</div>
					<div class="card-body">
						<form action="search-carresult2.php" method="post">
							 
								<label for="picklocation"><?=$languages[32][$lang_select]?></label>
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
									 
									 
										<label for="droplocation"><?=$languages[33][$lang_select]?></label>
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
									 





											<label for="" class="mt-3"><?=$languages[34][$lang_select]?> & <?=$languages[35][$lang_select]?></label><br>
 
													<span><?=$languages[36][$lang_select]?></span>
											 
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
													<option value=""><?=$languages[35][$lang_select]?></option>
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


<span><?=$languages[37][$lang_select]?></span>
											<div class="input-group mb-3">
												 
													
												 
												<div class="input-group-prepend">
													<span class="input-group-text" id=""><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" autocomplete="off" class="form-control" required name="dropdate" id="dropdate" placeholder="Date">
												<div class="input-group-prepend">
													<span class="input-group-text" id=""><i class="far fa-clock"></i></span>
												</div>
												<select class="form-control" required name="droptime">
													<option value=""><?=$languages[35][$lang_select]?></option>
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
												<button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> <?=$languages[38][$lang_select]?></button>
											</div> 


									</div>
								</div>
							</div>

<div class="col-lg-8  ">
	 
<div class="sp-container">
	




	<div class="sp-content">
		<div class="sp-globe"></div>
		<h2 class="frame-1" > </h2>
		<h2 class="frame-2" > </h2>
		<h2 class="frame-3" > </h2>
	 
		 
		 
	 
	</div>
</div>

</div>

						</div>
					</div>						 
				</section>
<!-- hero area end -->