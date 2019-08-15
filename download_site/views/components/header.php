<?php

	if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Download films from indir46</title>
		<meta name="description" content="Free Bootstrap 4 Theme by uicookies.com">
		<meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">

        <?php
            if(isset($css_files) && count($css_files) > 0){
                foreach($css_files as $css){
                    echo '<link rel="stylesheet" href="'.$css.'">';
                }
            }
        ?>

	</head>
	<body>
  
    <nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar" id="probootstrap-navbar">
      <div class="container">
        <a class="navbar-brand" href="/">DOWNLOAD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-menu" aria-controls="probootstrap-menu" aria-expanded="false" aria-label="Toggle navigation">
          <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-menu">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo ($page == "home")?"active":"" ?>"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item <?php echo ($page == "downloaded")?"active":"" ?>"><a class="nav-link" href="/?page=downloaded">Downloaded</a></li>
            <li class="nav-item <?php echo ($page == "downloading")?"active":"" ?>"><a class="nav-link" href="/?page=downloading">Downloading</a></li>
            <li class="nav-item <?php echo ($page == "scan")?"active":"" ?>"><a class="nav-link" href="/?page=scan">Scan</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->