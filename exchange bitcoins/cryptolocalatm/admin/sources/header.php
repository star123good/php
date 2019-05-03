<?php
if(!defined('EASYEX_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADMIN PANEL - <?php echo $settings['name']; ?></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><?php echo $settings['name']; ?></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="./"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
					
                    <h3 class="menu-title">exchanger management</h3><!-- /.menu-title -->
                    <li class="active"><a href="./?a=gateways"><i class="menu-icon fa fa-credit-card"></i> Gateways</a></li>
					<li class="active"><a href="./?a=exchanges"><i class="menu-icon fa fa-refresh"></i> Exchanges</a></li>
					<h3 class="menu-title">users management</h3><!-- /.menu-title -->
					<li class="active"><a href="./?a=users"><i class="menu-icon fa fa-users"></i> Users</a></li>
					<li class="active"><a href="./?a=feedbacks"><i class="menu-icon fa fa-comments-o"></i> Feedbacks</a></li>
                    <h3 class="menu-title">web management</h3><!-- /.menu-title -->
                    <li class="active"><a href="./?a=languages"> <i class="menu-icon fa fa-globe"></i>Languages </a></li>
					<li class="active"><a href="./?a=templates"> <i class="menu-icon fa fa-copy"></i>Templates </a></li>
					<li class="active"><a href="./?a=faq"> <i class="menu-icon fa fa-question-circle"></i>FAQ </a></li>
					<li class="active"><a href="./?a=posts"> <i class="menu-icon fa fa-comment"></i>Blog </a></li>
					<li class="active"><a href="./?a=pages"> <i class="menu-icon fa fa-bars"></i>Pages </a></li>
					<li class="active"><a href="./?a=smtp_settings"> <i class="menu-icon fa fa-inbox"></i>SMTP Settings </a></li>
					<li class="active"><a href="./?a=mobile_settings"> <i class="menu-icon fa fa-mobile"></i>Mobile Settings </a></li>
					<li class="active"><a href="./?a=settings"> <i class="menu-icon fa fa-cogs"></i>Settings </a></li>
					<li class="active"><a href="./?a=support"> <i class="menu-icon fa fa-helpdesk"></i>Get Support </a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-12">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> <?php echo idinfo($_SESSION['eex_admin_uid'],"username"); ?>
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="./?a=logout"><i class="fa fa-sign-out"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->