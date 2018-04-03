<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $this->config->item('admin_theme_url')?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <!--<form action="../../index.html" method="post">-->
		<form name="loginform" id="loginform" action="" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				
                <div class="body bg-gray">
					<?php echo validation_errors('<div class="error_message">', '</div>'); ?>
				<?php if( $this->session->userdata('error_msg') && $this->session->userdata('error_msg') != '' ) { ?>
					<div class="error_message"><?php echo $this->session->userdata('error_msg'); ?></div>
				<?php } ?>
                    <div class="form-group">
                        <!--<input type="text" name="userid" class="form-control" placeholder="User ID"/>-->
			<input type="text" name="username" id="username" class="form-control" placeholder="username"  value="" />
                    </div>
                    <div class="form-group">
                        <!--<input type="password" name="password" class="form-control" placeholder="Password" />-->
			<input type="password" name="password" id="password" class="form-control" placeholder="Password"  value="" />
                    </div>          
                    <!--<div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>-->
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block" name="submit_button" value="1">Sign me in</button> 
					<input type="hidden" name="submit_button" value="1" />
                    
                    <!--<p><a href="#">I forgot my password</a></p>-->
                    
                    <!--<a href="register.html" class="text-center">Register a new membership</a>-->
                </div>
            <!--</form>-->
			<?php echo form_close(); ?>

           <!-- <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $this->config->item('admin_theme_url')?>scripts/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>
