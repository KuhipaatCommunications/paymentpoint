<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PaymentPoint</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">


	<!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
	<link href="favicon.ico" rel="shortcut icon">


	<!-- Bootstrap CSS File -->
	<link href="<?php echo $this->config->item('theme_url');?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Libraries CSS Files -->
	<link href="<?php echo $this->config->item('theme_url');?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('theme_url');?>animate-css/animate.min.css" rel="stylesheet">

	<!-- Main Stylesheet File -->
	<link href="<?php echo $this->config->item('theme_url');?>css/style.css" rel="stylesheet">
	<!-- Google Fonts -->
	<link href="<?php echo $this->config->item('theme_url');?>css/font-face.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('theme_url');?>css/font-face1.css" rel="stylesheet">
        <script src="<?php echo $this->config->item('theme_url');?>jquery/jquery.min.js"></script>
  <script type="text/javascript">
      var csrf_token="<?php echo $this->security->get_csrf_token_name(); ?>";
      var csrf_value="<?php echo $this->security->get_csrf_hash(); ?>";
  </script>
</head>

<body>
<!--  <div id="preloader"></div>-->
 <!--==========================
  Header Section
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="<?php echo base_url();?>"><img src="<?php echo $this->config->item('theme_url');?>img/logo.png" alt="" title="" /></img></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo base_url();?>">Home</a></li>
          <?php if($this->router->fetch_class()!='home'){?>
            <li><a href="<?php echo base_url('#about')?>">Who we are</a></li>
            <li><a href="<?php echo base_url('#features')?>">How we help</a></li>
          <?php
          }
          else
          {
          ?>
            <li><a href="#about">Who we are</a></li>
            <li><a href="#features">How we help</a></li>
          <?php
          }
          ?>
          <li><a href="<?php echo base_url('faq');?>">FAQ</a></li>
          <li><a href="<?php echo base_url().'#contact';?>">Contact Us</a></li>
          <li><a href="<?php echo base_url('partner-with-us');?>">Partner Us</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->


 <div class="sticky-container hidden-xs">
    <ul class="sticky">
      <a href="<?php echo base_url().'lead/merchant';?>" style="text-decoration:none;"><li>
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true" id="glyphicon"></span>Be merchant</li></a>
      <a href="<?php echo base_url().'lead/channelpartner';?>" style="text-decoration:none;"><li>
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true" id="glyphicon"></span>Be channel partner</li></a>

    </ul>
  </div>
