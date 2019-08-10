<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>

<!DOCTYPE html >
<html lang="en-US">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Free Leads Classifieds - <?php echo $type; ?></title>
	<meta name="title" content="Free Leads Classifieds" />
	<meta name="description" content="Post free ads and get free leads for your business. Ads stay live 90 days! Add YouTube videos, Facebook pages and direct links to your website. All links live and clickable!" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo WEB_PATH; ?>oc-content/themes/bender/favicon/favicon-48.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo WEB_PATH; ?>oc-content/themes/bender/favicon/favicon-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo WEB_PATH; ?>oc-content/themes/bender/favicon/favicon-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo WEB_PATH; ?>oc-content/themes/bender/favicon/favicon-72.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo WEB_PATH; ?>oc-content/themes/bender/favicon/favicon-57.png">
	<!-- /favicon -->

	<link href="<?php echo WEB_PATH; ?>oc-content/themes/bender/js/jquery-ui/jquery-ui-1.10.2.custom.min.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	    var bender = window.bender || {};
	    bender.base_url = '<?php echo WEB_PATH; ?>index.php';
	    bender.langs = {"delete":"Delete","cancel":"Cancel"};
	    bender.fancybox_prev = 'Previous image';
	    bender.fancybox_next = 'Next image';
	    bender.fancybox_closeBtn = 'Close';
	</script>

	<link href="<?php echo WEB_PATH; ?>oc-content/themes/bender/css/main.css" rel="stylesheet" type="text/css" />
	<meta name="generator" content="Osclass 3.7.4" />
	<style>.payment-pro-highlighted { background-color:#fff000 !important; }</style>
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<link href="<?php echo WEB_PATH; ?>oc-content/themes/bender/js/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEB_PATH; ?>oc-content/themes/bender/css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEB_PATH; ?>oc-includes/osclass/assets/js/fineuploader/fineuploader.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEB_PATH; ?>oc-content/themes/bender/css/ajax-uploader.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo WEB_PATH; ?>oc-includes/osclass/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo WEB_PATH; ?>oc-content/themes/bender/js/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="<?php echo WEB_PATH; ?>oc-includes/osclass/assets/js/date.js"></script>
	<script type="text/javascript" src="<?php echo WEB_PATH; ?>oc-includes/osclass/assets/js/fineuploader/jquery.fineuploader.min.js"></script>
	<script type="text/javascript" src="<?php echo WEB_PATH; ?>oc-includes/osclass/assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo WEB_PATH; ?>oc-content/themes/bender/js/global.js"></script>

	<style>
		input.campaign_file_upload{
			position: absolute;
			width: 170px !important;
			margin-left: 10px;
		}
	</style>

</head>

<body class="has-searchbox">

	<!-- <script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=BMfqZ&webforms_id=20327204"></script>
	<br>
	<br> -->

	<div id="header">
	    <!-- header ad 728x60-->
	    <div class="ads_header">
	    <!-- /header ad 728x60-->
	    </div>
	    <div class="clear"></div>
	    <!-- <div class="wrapper">
	        <div id="logo">
	            <a href="<?php echo WEB_PATH1; ?>">Free Leads Classifieds</a>
	            <span id="description">Post free ads and get free leads for your business. Ads stay live 90 days! Add YouTube videos, Facebook pages and direct links to your website. All links live and clickable!</span>
	        </div>
	        <ul class="nav">
	            <li><a id="login_open" href="<?php echo WEB_PATH1; ?>user/login">Login</a></li>
	            <li><a href="<?php echo WEB_PATH1; ?>user/register">Register for a free account</a></li>
	            <li class="publish"><a href="<?php echo WEB_PATH1; ?>item/new">Publish your ad for free</a></li>
	        </ul>
	    </div> -->
	    <!-- <form action="<?php echo WEB_PATH1; ?>index.php" method="get" class="search nocsrf" >
	        <input type="hidden" name="page" value="search"/>
	        <div class="main-search">
	            <div class="cell">
	                <input type="text" name="sPattern" id="query" class="input-text" value="" placeholder="Work From Home..." />
	            </div>
	            <div class="cell selector">
	                <select name="sCategory" id="sCategory">
	                	<option value="">Select a category</option><option value="105">Business Opportunities</option><option value="106">&nbsp;&nbsp;Work From Home</option><option value="107">&nbsp;&nbsp;Businesses For Sale</option><option value="108">&nbsp;&nbsp;&nbsp;&nbsp;Agents Dealers Wanted</option><option value="109">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agents Dealers Wanted</option><option value="110">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agents Dealers Wanted</option><option value="111">&nbsp;&nbsp;Agents Dealers Wanted</option><option value="112">&nbsp;&nbsp;Distributors Wanted</option><option value="113">&nbsp;&nbsp;Wholesalers</option><option value="114">&nbsp;&nbsp;Computer</option><option value="115">&nbsp;&nbsp;E Books</option><option value="116">&nbsp;&nbsp;Energy</option><option value="117">&nbsp;&nbsp;Food</option><option value="118">&nbsp;&nbsp;General</option><option value="119">&nbsp;&nbsp;Health</option><option value="120">&nbsp;&nbsp;Publishing</option><option value="121">&nbsp;&nbsp;Real Estate</option><option value="122">&nbsp;&nbsp;Representatives</option><option value="123">&nbsp;&nbsp;Technology</option><option value="124">&nbsp;&nbsp;Telecom</option><option value="125">&nbsp;&nbsp;Travel</option><option value="126">&nbsp;&nbsp;Turnkey Websites</option><option value="127">&nbsp;&nbsp;Web Promotion</option><option value="128">&nbsp;&nbsp;Web Traffic</option><option value="129">&nbsp;&nbsp;Advertising</option><option value="130">&nbsp;&nbsp;Affiliate Marketing</option><option value="131">&nbsp;&nbsp;Marketing/Sales</option><option value="132">&nbsp;&nbsp;Start Your Own Biz</option><option value="1">For sale</option><option value="9">&nbsp;&nbsp;Animals</option><option value="10">&nbsp;&nbsp;Art - Collectibles</option><option value="11">&nbsp;&nbsp;Barter</option><option value="12">&nbsp;&nbsp;Books - Magazines</option><option value="13">&nbsp;&nbsp;Cameras - Camera Accessories</option><option value="14">&nbsp;&nbsp;CDs - Records</option><option value="15">&nbsp;&nbsp;Cell Phones - Accessories</option><option value="16">&nbsp;&nbsp;Clothing</option><option value="17">&nbsp;&nbsp;Computers - Hardware</option><option value="18">&nbsp;&nbsp;DVD</option><option value="19">&nbsp;&nbsp;Electronics</option><option value="20">&nbsp;&nbsp;For Babies - Infants</option><option value="21">&nbsp;&nbsp;Garage Sale</option><option value="22">&nbsp;&nbsp;Health - Beauty</option><option value="23">&nbsp;&nbsp;Home - Furniture - Garden Supplies</option><option value="24">&nbsp;&nbsp;Jewelry - Watches</option><option value="25">&nbsp;&nbsp;Musical Instruments</option><option value="26">&nbsp;&nbsp;Sporting Goods - Bicycles</option><option value="27">&nbsp;&nbsp;Tickets</option><option value="28">&nbsp;&nbsp;Toys - Games - Hobbies</option><option value="29">&nbsp;&nbsp;Video Games - Consoles</option><option value="30">&nbsp;&nbsp;Everything Else</option><option value="103">&nbsp;&nbsp;&nbsp;&nbsp;Advertising Services</option><option value="2">Vehicles</option><option value="31">&nbsp;&nbsp;Cars</option><option value="32">&nbsp;&nbsp;Car Parts</option><option value="33">&nbsp;&nbsp;Motorcycles</option><option value="34">&nbsp;&nbsp;Boats - Ships</option><option value="35">&nbsp;&nbsp;RVs - Campers - Caravans</option><option value="36">&nbsp;&nbsp;Trucks - Commercial Vehicles</option><option value="37">&nbsp;&nbsp;Other Vehicles</option><option value="3">Classes</option><option value="38">&nbsp;&nbsp;Computer - Multimedia Classes</option><option value="39">&nbsp;&nbsp;Language Classes</option><option value="40">&nbsp;&nbsp;Music - Theatre - Dance Classes</option><option value="41">&nbsp;&nbsp;Tutoring - Private Lessons</option><option value="42">&nbsp;&nbsp;Other Classes</option><option value="4">Real estate</option><option value="43">&nbsp;&nbsp;Houses - Apartments for Sale</option><option value="44">&nbsp;&nbsp;Houses - Apartments for Rent</option><option value="45">&nbsp;&nbsp;Rooms for Rent - Shared</option><option value="46">&nbsp;&nbsp;Housing Swap</option><option value="47">&nbsp;&nbsp;Vacation Rentals</option><option value="48">&nbsp;&nbsp;Parking Spots</option><option value="49">&nbsp;&nbsp;Land</option><option value="50">&nbsp;&nbsp;Office - Commercial Space</option><option value="51">&nbsp;&nbsp;Shops for Rent - Sale</option><option value="99">&nbsp;&nbsp;&nbsp;&nbsp;Legal Services</option><option value="5">Services</option><option value="100">&nbsp;&nbsp;Legal Services</option><option value="104">&nbsp;&nbsp;Real Estate Services</option><option value="101">&nbsp;&nbsp;Financial Services</option><option value="102">&nbsp;&nbsp;Advertising Services</option><option value="52">&nbsp;&nbsp;Babysitter - Nanny</option><option value="53">&nbsp;&nbsp;Casting - Auditions</option><option value="54">&nbsp;&nbsp;Computer</option><option value="55">&nbsp;&nbsp;Event Services</option><option value="56">&nbsp;&nbsp;Health - Beauty - Fitness</option><option value="57">&nbsp;&nbsp;Horoscopes - Tarot</option><option value="58">&nbsp;&nbsp;Household - Domestic Help</option><option value="59">&nbsp;&nbsp;Moving - Storage</option><option value="60">&nbsp;&nbsp;Repair</option><option value="61">&nbsp;&nbsp;Writing - Editing - Translating</option><option value="62">&nbsp;&nbsp;Other Services</option><option value="6">Community</option><option value="63">&nbsp;&nbsp;Carpool</option><option value="64">&nbsp;&nbsp;Community Activities</option><option value="65">&nbsp;&nbsp;Events</option><option value="66">&nbsp;&nbsp;Musicians - Artists - Bands</option><option value="67">&nbsp;&nbsp;Volunteers</option><option value="68">&nbsp;&nbsp;Lost And Found</option><option value="8">Jobs</option><option value="98">&nbsp;&nbsp;Business Opportunities</option><option value="75">&nbsp;&nbsp;Accounting - Finance</option><option value="76">&nbsp;&nbsp;Advertising - Public Relations</option><option value="77">&nbsp;&nbsp;Arts - Entertainment - Publishing</option><option value="78">&nbsp;&nbsp;Clerical - Administrative</option><option value="79">&nbsp;&nbsp;Customer Service</option><option value="80">&nbsp;&nbsp;Education - Training</option><option value="81">&nbsp;&nbsp;Engineering - Architecture</option><option value="82">&nbsp;&nbsp;Healthcare</option><option value="83">&nbsp;&nbsp;Human Resource</option><option value="84">&nbsp;&nbsp;Internet</option><option value="85">&nbsp;&nbsp;Legal</option><option value="86">&nbsp;&nbsp;Manual Labor</option><option value="87">&nbsp;&nbsp;Manufacturing - Operations</option><option value="88">&nbsp;&nbsp;Marketing</option><option value="89">&nbsp;&nbsp;Non-profit - Volunteer</option><option value="90">&nbsp;&nbsp;Real Estate</option><option value="91">&nbsp;&nbsp;Restaurant - Food Service</option><option value="92">&nbsp;&nbsp;Retail</option><option value="93">&nbsp;&nbsp;Sales</option><option value="94">&nbsp;&nbsp;Technology</option><option value="95">&nbsp;&nbsp;Other Jobs</option><option value="97">&nbsp;&nbsp;&nbsp;&nbsp;Business Opportunities</option><option value="96">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Business Opportunities</option>
	                </select>
	            </div>
	            <div class="cell reset-padding">
	                <button class="ui-button ui-button-big js-submit">Search</button>
	            </div>
	        </div>
	        <div id="message-seach"></div>
	    </form> -->
    </div>
	<div class="wrapper wrapper-flash">
		<div class="breadcrumb">
			<style>
				#custom_ul li:after{
					content : "|";
				}
				#custom_ul li:last-child:after{
					content : "";
				}
			</style>
			<ul class="breadcrumb" id="custom_ul">
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=login" title="Log In" >Log In</a>
				</li>
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=logout" title="Log Out" >Log Out</a>
				</li>
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=register" title="Sign Up" >Register</a>
				</li>
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=profile" title="Edit Profile" >Edit Profile</a>
				</li>
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=customer" title="Show Profiles" >Show Profiles</a>
				</li>
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=customers" title="Show Customers" >Show Customers</a>
				</li>
				<li>
					<a href="<?php echo WEB_PATH; ?>index.php?type=show_sites" title="Show Sites" >Show Sites</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
    </div>

	<div class="clear"></div>

	<div class="wrapper" id="content">
		<div id="main">