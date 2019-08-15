<?php

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

  // total page from sites table
  $sites_from_table = select_rows($pdo, $table_site, "1 ORDER BY `id` DESC");
  if(count($sites_from_table) > 0){
	$total_pages = $sites_from_table[0]['total_page_orignal'];
	$total_page_id = $sites_from_table[0]['id'];
	$total_pages_dist = $sites_from_table[0]['total_page_dist'];
  }
  else{
	$total_pages = 0;
	$total_page_id = 1;
	$total_pages_dist = 0;
  }
  
  // scrape total page
	if(isset($_POST['totalpage']) && $_POST['totalpage'] != ""){
		while(true){
			$url = SERVICE_URL_TWO . "page/" . $total_pages;
			$headers = url_get_contents($url, 'cURL', 'headers only');
			if($headers['info']['http_code'] != 200){
				$total_pages = $total_pages - 1;
				update_row($pdo, $table_site, array('total_page_orignal'), array($total_pages), "`id` = ".$total_page_id);
				break;
			}
			$total_pages ++;
		}
		echo json_encode(array('status' => 'success', 'totalPage' => $total_pages));
		die();
	}
	
  // curl
	if(isset($_POST['pagenumber']) && $_POST['pagenumber'] >= 0 && $_POST['pagenumber'] <= $total_pages){
		$page_number = $total_pages - $_POST['pagenumber'];
		$data = getTagsDataWithCookie(SERVICE_URL_TWO . "page/" . $page_number);
		$count_update = 0;
		$count_insert = 0;
		foreach($data as $row){
		  $old_row = select_rows($pdo, $table_film, "`url` like '".$row['href']."'");
		  
		  if($old_row && count($old_row) > 0){
			// update
			$keys = array('created_at');
			$values = array(date("Y-m-d h:i:s"));
			if($row['title'] != ""){
			  $keys[] = 'title';
			  $values[] = $row['title'];
			}
			if($row['href'] != ""){
			  $keys[] = 'url';
			  $values[] = $row['href'];
			}
			if($row['download'] != ""){
			  $keys[] = 'download_url';
			  $values[] = $row['download'];
			}
			if($row['image'] != ""){
			  $keys[] = 'thumbnail';
			  $values[] = $row['image'];
			}

			$result = update_row($pdo, $table_film, $keys, $values, "`url` like '".$row['href']."'");
			if($result) $count_update ++;
		  }
		  else{
			// insert
			$keys = array(
			  'title',
			  'url',
			  'download_url',
			  'status',
			  'thumbnail',
			  'created_at'
			);
			$values = array(
			  $row['title'],
			  $row['href'],
			  $row['download'],
			  'ready',
			  $row['image'],
			  date("Y-m-d h:i:s")
			);

			$result = insert_row($pdo, $table_film, $keys, $values);
			if($result) $count_insert ++;
		  }
		  
		}
		if($count_insert > 0 || $count_update > 0){
		  // success
		  update_row($pdo, $table_site, array('total_page_dist'), array($_POST['pagenumber']), "`id` = ".$total_page_id);
		  echo json_encode(array('status' => 'success', 'insert' => $count_insert, 'update' => $count_update));
		}
		else{
		  // fail
		  echo json_encode(array('status' => 'fail', 'insert' => 0, 'update' => 0));
		}
    die();
	}
?>
	<section class="probootstrap-cover overflow-hidden relative"  style="background-image: url('assets/images/bg_1.jpg');" data-stellar-background-ratio="0.5" id="section-home">
      <div class="overlay"></div>
      <div class="container">
        <div class="row align-items-center text-center">
          <div class="col-md">
            <h2 class="heading mb-2 display-4 font-light probootstrap-animate">Scan All Films from Yerli Filmler</h2>
            <p class="lead mb-5 probootstrap-animate">You can start scanning now by clicking the follow button.</p>
            <p class="probootstrap-animate">
              <button role="button" id="btn-scan-start" class="btn btn-primary p-3 mr-3 pl-5 pr-5 text-uppercase d-lg-inline d-md-inline d-sm-block d-block mb-3">
                Start Scanning Now
              </button> 
            </p>
          </div> 
        </div>
      </div>
    </section>
	<!-- END section -->
	
	<section class="probootstrap_section" id="section-city-guides">
      <div class="container">
        <div class="row text-center mb-5 probootstrap-animate">
          <div class="col-md-12">
            <h2 class="display-4 border-bottom probootstrap-section-heading">Current Scanning State</h2>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-lg-12 col-md-12 probootstrap-animate mb-3">
            <h4>Total Progress</h4>
            <div class="progress">
              <div class="progress-bar progress-bar-animated" id="progress-bar-total" role="progressbar" style="" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div> 
        </div>
        <div class="row mb-5">
          <div class="col-lg-12 col-md-12 probootstrap-animate mb-3">
            <h4>Current Page is <span id="page-current-show"></span></h4>
            <!-- <div class="progress">
              <div class="progress-bar progress-bar-animated bg-success" id="progress-bar-page" role="progressbar" style="" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
            </div> -->
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-4 col-sm-12 probootstrap-animate mb-3" data-animate-effect="fadeInLeft">
            <div class="card">
              <div class="card-body">
                <div class="header-title">
                  Total Count
                  <h3 class="float-right text-warning" id="count-total-show">0</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 probootstrap-animate mb-3" data-animate-effect="fadeIn">
            <div class="card">
              <div class="card-body">
                <div class="header-title">
                  New Count
                  <h3 class="float-right text-success" id="count-new-show">0</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 probootstrap-animate mb-3" data-animate-effect="fadeInRight">
            <div class="card">
              <div class="card-body">
                <div class="header-title">
                  Updated Count
                  <h3 class="float-right text-danger" id="count-update-show">0</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- END section -->
  <script>
    var totalPage = parseInt('<?php echo $total_pages; ?>');
    var totalPageDist = parseInt('<?php echo $total_pages_dist; ?>');
  </script>
