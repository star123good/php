<?php

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
	
	$data = select_rows($pdo, $table_film, "`is_checked` = 1");

	if(isset($_POST['download']) && $_POST['download'] == "start"){
		// the other db connection
		$dsn1 = "mysql:host=".DB_HOST1.";dbname=".DB_NAME1.";charset=".CHARSET;
		$options1 = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try{
			$pdo1 = new PDO($dsn1, DB_USER1, DB_PASSWORD1, $options1);
		}
		catch(PDOException $e){
			die('the other database connect error.');
		}
		
		// download ajax
		$count = 0;
		update_row($pdo, $table_film, array('is_checked', 'status'), array(0, 'downloading'), "`is_checked` = 1");
		foreach($data as $row){
			if($row['download_url'] != ""){
				// $output = shell_exec('/usr/bin/wget --user ' . LOG_IN_USERNAME . ' --password ' . LOG_IN_PASSWORD . ' ' . $row['download_url'] . ' 2>&1');
				// $output = shell_exec('/usr/bin/wget --user ' . LOG_IN_USERNAME . ' --password ' . LOG_IN_PASSWORD . ' ' . $row['download_url'] . ' > /dev/null 2>&1 &');
				$output = shell_exec('/usr/bin/wget --user ' . LOG_IN_USERNAME . ' --password ' . LOG_IN_PASSWORD . ' ' . $row['download_url'] . ' > /dev/null 2>/dev/null &');
				
				update_row($pdo, $table_film, array('status', 'download_at'), array('finished', date('Y-m-d H:i:s')), "`id` = " . $row['id']);
				
				// insert streams & streams_options
				insert_streams($pdo1, $table_stream, $table_stream_option, array('url' => $row['download_url'], 'title' => $row['title']));
				
				$count++;
			}
			else update_row($pdo, $table_film, array('status'), array('ready'), "`id` = " . $row['id']);
		}
		if($count > 0) echo json_encode(array('status' => 'success', 'data' => $count));
		else  echo json_encode(array('status' => 'fail'));
		die();
	}
?>
	<section class="probootstrap-cover overflow-hidden relative"  style="background-image: url('assets/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row align-items-center text-center">
          <div class="col-md">
            <h2 class="heading mb-2 display-4 font-light probootstrap-animate">Download Selected Films from Yerli Filmler</h2>
            <p class="lead mb-5 probootstrap-animate">You can start downloading now by clicking the follow button.</p>
            <p class="probootstrap-animate">
              	<button role="button" id="btn-download-start" class="btn btn-primary p-3 mr-3 pl-5 pr-5 text-uppercase d-lg-inline d-md-inline d-sm-block d-block mb-3">
                	Start Downloading Now
				</button> 
            </p>
          </div> 
        </div>
      </div>
    </section>
	<!-- END section -->

	<section class="probootstrap_section" id="section-city-guides">
      	<div class="container">
		  <div class="row text-center mb-5 probootstrap-animate fadeInUp probootstrap-animated">
			<div class="col-md-12">
				<h2 class="display-4 border-bottom probootstrap-section-heading">Downloading Films List</h2>
			</div>
		  </div>

		  	<?php
				$i = 0;
				foreach($data as $row){
					if($i % 2 == 0) echo '<div class="row mb-3">';
			?>
				<div class="col-md-6" id="custom-download-<?php echo $row['id']; ?>">
					<div class="media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate <?php echo ($i % 2 == 0)?'fadeInLeft':'fadeInRight' ?> probootstrap-animated">
						<div class="probootstrap-media-image" style="background-image: url(<?php echo ($row['thumbnail'])?$row['thumbnail']:"assets/images/sq_img_1.jpg" ?>)">
						</div>
						<div class="media-body">
							<h5 class="mb-3"><?php echo $row['title'] ?></h5>
							<p><?php echo $row['url'] ?></p>
							<p class="custom-download-status">ready</p>
						</div>
					</div>
				</div>
			<?php
					if($i % 2 == 1) echo '</div>';
					$i++;
				}
				if($i %2 == 1) echo '</div>';
			?>

		</div>
    </section>
	<!-- END section -->