<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PaymentPoint</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/cmxform.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo $this->config->item('admin_theme_url')?>scripts/jquery.min.js"></script>
        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
        var ADMINURL = '<?php echo site_url('admin');?>';
        var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <form name="fromCheckAction" id="fromCheckAction" action="" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="check_ids" id="check_ids" value="" />
            <input type="hidden" name="status" id="status" value="" />
        </form>
        <header class="header">
            <a href="<?php echo base_url(); ?>admin" class="logo">
                <img src="<?php echo $this->config->item('admin_theme_url')?>images/logo123.png" alt="Logo Here">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <!--Leadhub-->
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->session->userdata('admin_name'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php
                                    $profile=getCurrentAdminUserProfileImage();
                                    // echo "<pre>";
                                    // print_r($profile);exit();

                                    if($profile && !empty($profile) && isset($profile['profile_image']))
                                    {
                                    $image=explode('.', $profile['profile_image']);
                                   ?>
                                    <img src="<?php echo base_url().'uploads/admin_user_image/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1];?>" class="img-circle">
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <img src="<?php echo $this->config->item('admin_theme_url')?>images/avatar3.png" class="img-circle" alt="User Image" />
                                    <?php
                                    }
                                    ?>
                                    <p>
                                        <?php echo $this->session->userdata('admin_name'); ?> - <?php if($this->session->userdata('superAdmin')== 1){ ?>Super Admin <?php }else{ echo $this->session->userdata('role_name'); } ?>
                                        <small>Member since <?php echo $this->session->userdata('created');?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!--<li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url().'admin/home/admin_profile_edit'?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-left">
                                        <a href="<?php echo base_url().'admin/home/change_pass' ;?>" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-left">
                                        <a href="<?php echo base_url().'admin/home/logout' ;?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
