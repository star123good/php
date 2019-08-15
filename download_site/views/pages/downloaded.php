<?php

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

	$page_count = 12;
	$all_data = select_rows($pdo, $table_film, "`status` not like 'ready'");
	if(count($all_data) > 0){
		$total_pages = (int)((count($all_data) - 1)/ $page_count + 1);
	}
	
	if(isset($_POST['pagenumber']) && $_POST['pagenumber'] > 0){
		// pagination ajax
		$pagenumber = $_POST['pagenumber'];
		$data = select_rows($pdo, $table_film, "`status` not like 'ready' ORDER BY `id` ASC LIMIT ".(($pagenumber - 1) * $page_count).", ".$page_count);
		echo json_encode(array('status' => 'success', 'data' => $data));
		die();
	}

	$data = select_rows($pdo, $table_film, "`status` not like 'ready' ORDER BY `id` ASC LIMIT ".$page_count);
?>
	<section class="probootstrap-cover overflow-hidden relative"  style="background-image: url('assets/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row align-items-center text-center">
				<div class="col-md">
					<h2 class="heading mb-2 display-4 font-light probootstrap-animate">Downloaded Films</h2>
					<p class="lead mb-5 probootstrap-animate">You can show all downloaded films here.</p>
				</div> 
			</div>
		</div>
	</section>
	<!-- END section -->

	<section class="probootstrap_section" id="section-city-guides">
		<div class="container">
		<div class="row text-center mb-5 probootstrap-animate fadeInUp probootstrap-animated">
			<div class="col-md-12">
				<h2 class="display-4 border-bottom probootstrap-section-heading">Downloaded Films List</h2>
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
							<p><?php echo "...".substr($row['download_url'], -10) ?></p>
							<p><?php echo ($row['download_at']!="")?date('Y-m-d H:i:s', strtotime($row['download_at'])):"" ?></p>
						</div>
					</div>
				</div>
			<?php
					if($i % 2 == 1) echo '</div>';
					$i++;
				}
				if($i %2 == 1) echo '</div>';
			?>

			<div class="row">
				<nav aria-label="Page navigation example" class="probootstrap-animate ml-auto mr-auto" data-animate-effect="fadeInUp">
					<ul class="pagination" id="custom-pagination-downloaded">
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
