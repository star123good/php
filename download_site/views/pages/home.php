<?php

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
  
  
  $page_count = 12;
  $all_data = select_rows($pdo, $table_film, "`status` like 'ready'");
  if(count($all_data) > 0){
    $total_pages = (int)((count($all_data) - 1)/ $page_count + 1);
  }
  
  if(isset($_POST['pagenumber']) && $_POST['pagenumber'] > 0){
    // pagination ajax
    $pagenumber = $_POST['pagenumber'];
    $data = select_rows($pdo, $table_film, "`status` like 'ready' ORDER BY `created_at` DESC, `id` ASC LIMIT ".(($pagenumber - 1) * $page_count).", ".$page_count);
    echo json_encode(array('status' => 'success', 'data' => $data));
    die();
  }

  if(isset($_POST['checkingId']) && $_POST['checkingId'] > 0){
    // checking ajax
    $checking_id = $_POST['checkingId'];
    $checking_value = $_POST['checkingValue'];
    $result = update_row($pdo, $table_film, array('is_checked'), array($checking_value), "`id` = ".$checking_id);
    if($result) echo json_encode(array('status' => 'success'));
    else echo json_encode(array('status' => 'fail'));
    die();
  }

  $data = select_rows($pdo, $table_film, "`status` like 'ready' ORDER BY  `created_at` DESC, `id` ASC LIMIT ".$page_count);
?>
    <section class="probootstrap-cover overflow-hidden relative"  style="background-image: url('assets/images/bg_1.jpg');" data-stellar-background-ratio="0.5"  id="section-home">
      <div class="overlay"></div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md">
            <h2 class="heading mb-2 display-4 font-light probootstrap-animate">Download Films From Yerli Filmler</h2>
            <p class="lead mb-5 probootstrap-animate">You could download from <a href="<?php echo SERVICE_URL_TWO ?>" target="_blank">Yerli Filmler | Film indir, Tek Link Film indir</a></p>
            <p class="probootstrap-animate">
              <a href="/?page=downloading" role="button" class="btn btn-primary p-3 mr-3 pl-5 pr-5 text-uppercase d-lg-inline d-md-inline d-sm-block d-block mb-3">Download Now</a> 
            </p>
          </div> 
          <div class="col-md probootstrap-animate">
            <form action="#" class="probootstrap-form">
              <div class="form-group">
                <div class="row mb-4">
                  <div class="col-md">
                      You must log in to download films.
                  </div>
                </div>
                <!-- END row -->
                <div class="row mb-3">
                  <div class="col-md">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <label for="input-text-email">Email</label>
                            </div>
                            <div class="col-md-8">
                                <div class="probootstrap-date-wrap">
                                    <span class="icon ion-email"></span> 
                                    <input type="text" id="input-text-email" class="form-control" placeholder="Type your email">
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- END row -->
                <div class="row mb-5">
                  <div class="col-md">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <label for="input-text-password">Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="probootstrap-date-wrap">
                                    <span class="icon ion-key"></span> 
                                    <input type="password" id="input-text-password" class="form-control" placeholder="Type your password">
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- END row -->
                <div class="row">
                  <div class="col-md">
                      <div class="col-md-6 ml-md-auto col-sm-12">
                        <input type="submit" value="Log In" class="btn btn-primary btn-block">
                      </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    
    </section>
    <!-- END section -->


    <section class="probootstrap_section" id="section-city-guides">
      <div class="container">
        <div class="row text-center mb-5 probootstrap-animate">
          <div class="col-md-12">
            <h2 class="display-4 border-bottom probootstrap-section-heading">All Films of Yerli Filmler</h2>
          </div>
        </div>

        <?php
          $i = 0;
          foreach($data as $row){
            if($i % 4 == 0) echo '<div class="row mb-5">';
        ?>
          <div class="col-lg-3 col-md-6 probootstrap-animate mb-3" id="custom-pattern-<?php echo ($i + 1); ?>">
            <a href="#" data-url="<?php echo $row['url'] ?>" data-id="<?php echo $row['id'] ?>" class="probootstrap-thumbnail custom-home-select-link <?php echo ($row['is_checked'])?'active':'' ?>">
              <img src="<?php echo ($row['thumbnail'])?$row['thumbnail']:"assets/images/sq_img_1.jpg" ?>" alt="<?php echo $row['thumbnail'] ?>" class="img-fluid">
              <div class="custom-ribon"><i class="icon ion-checkmark"></i></div>
              <div class="probootstrap-text">
                <h3><?php echo $row['title'] ?></h3>
              </div>
            </a>
          </div>
        <?php
            if($i % 4 == 3) echo '</div>';
            $i++;
          }
        ?>
        
        <div class="row">
          <nav aria-label="Page navigation example" class="probootstrap-animate ml-auto mr-auto" data-animate-effect="fadeInUp">
            <ul class="pagination" id="custom-pagination-home">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous" id="custom-pagination-previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active"><a class="page-link" href="#" id="custom-pagination-1">1</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-2">2</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-3">3</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-4">4</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-5">5</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-6">6</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-7">7</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-8">8</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-9">9</a></li>
              <li class="page-item"><a class="page-link" href="#" id="custom-pagination-10">10</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next" id="custom-pagination-next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </section>
  <!-- END section -->
  <script>
    var maximumPage = parseInt('<?php echo $total_pages; ?>');
  </script>
