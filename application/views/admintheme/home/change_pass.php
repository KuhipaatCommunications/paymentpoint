<link href="<?php echo $this->config->item('admin_theme_url')?>css/cmxform.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/jquery.validate.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_validation.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("#frmUser").validate({
		rules: {
			old_password: {
				required: true
			},
			new_password: {
				required: true
			},
			c_new_password: {
				required: true,
				equalTo: '#new_password'
			}
		}
	});
});

</script>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'admin/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li >Users</li>
                <li class="active">Change Password</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Change Password</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
						<form name="frmUser" id="frmUser" method="post" action="<?php echo base_url()?>admin/home/change_pass/">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="box-body">
                                <?php if($this->session->flashdata('error_msg')!=''){ ?>
                                    <div class="form-group has-error">
                                        <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error_msg');?></label>
                                    </div>
                                <?php 
                                }
                                if($this->session->flashdata('success_msg')!=''){ ?>
                                    <div class="form-group has-error">
                                        <label for="inputSuccess" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('success_msg');?></label>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Old Password</label>*
                                    <input name="old_password" id="old_password" type="password" value="<?php echo set_value("old_password"); ?>" class="form-control" />
    								<span class="error"><?php echo form_error("old_password"); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">New Password</label>*
                                    <input name="new_password" id="new_password" type="password" value="<?php echo set_value("new_password"); ?>" class="form-control" />
    								<span class="error"><?php echo form_error("new_password"); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm New Password</label>*
                                    <input name="c_new_password" id="c_new_password" type="password" value="<?php echo set_value("c_new_password"); ?>" class="form-control" />
    								<span class="error"><?php echo form_error("c_new_password"); ?></span>
                                </div>
                        </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="addCms">Submit</button>                                
                            </div>
						</form>
						</div><!-- /.box -->
                </div>
                <div class="col-md-6">

                                        </div>

            </div><!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">                            




                </section><!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable"> 



                </section><!-- right col -->
            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

