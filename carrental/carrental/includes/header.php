<?php  include_once('includes/language_currency.php'); ?>
<!-- header section start -->
<div class="top-area "  >
	<div class="head-top-area" >
	
 <!------------------------------------------------>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark	   sticky-top" style="background-color: black">
  <div class="container">
    <a class="navbar-brand" href="index.php">
          <img src="assets/img/logo.png" alt="">
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php"><?=$languages[0][$lang_select]?>
                <span class="sr-only">(<?=$languages[1][$lang_select]?>)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="carguides.php"><?=$languages[2][$lang_select]?></a>
        </li>
          <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$languages[3][$lang_select]?></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="page.php?type=str"><?=$languages[4][$lang_select]?></a>
      <a class="dropdown-item" href="page.php?type=ltr"><?=$languages[5][$lang_select]?></a>
      <a class="dropdown-item" href="page.php?type=cr"><?=$languages[6][$lang_select]?></a>
      <a class="dropdown-item" href="page.php?type=cs"><?=$languages[7][$lang_select]?></a>
      <a class="dropdown-item" href="page.php?type=ts"><?=$languages[8][$lang_select]?></a>
    </div>
  </li>
         
        <li class="nav-item">
          <a class="nav-link" href="page.php?type=aboutus"><?=$languages[9][$lang_select]?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page.php?type=faq"><?=$languages[10][$lang_select]?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contactus.php"><?=$languages[11][$lang_select]?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$languages[12][$lang_select]?></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#" onclick="javascript:change_url('language', 'english');"><?=$languages[13][$lang_select]?></a>
            <a class="dropdown-item" href="#" onclick="javascript:change_url('language', 'georgian');"><?=$languages[14][$lang_select]?></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$languages[15][$lang_select]?></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#" onclick="javascript:change_url('currency', 'USD');"><?=$languages[16][$lang_select]?></a>
            <a class="dropdown-item" href="#" onclick="javascript:change_url('currency', 'EUR');"><?=$languages[17][$lang_select]?></a>
            <a class="dropdown-item" href="#" onclick="javascript:change_url('currency', 'GEL');"><?=$languages[18][$lang_select]?></a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
 
<script>
  function change_url(key, value){
    var url = location.href;
    url_temp = url.split('#');
    url = url_temp[0];
    if(url.indexOf('?') >= 0){
      url_tmp = url.split('?');
      url_temp = url_tmp[1].split('&');
      str_url = '';
      for (let index = 0; index < url_temp.length; index++) {
        temp = url_temp[index];
        if(temp.indexOf(key.concat('=')) < 0) str_url = str_url.concat('&', temp);
      }
      str_url = str_url.concat('&', key, '=', value);
      url = url_tmp[0].concat('?', str_url.slice(1));
    }
    else{
      url = url.concat('?', key, '=', value);
    }
    location.href = url;
  }
</script>

<!-------------------------------->