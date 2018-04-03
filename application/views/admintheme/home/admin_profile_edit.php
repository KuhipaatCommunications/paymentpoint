<link href="<?php echo $this->config->item('admin_theme_url')?>css/cmxform.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/jquery.validate.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_validation.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("#frmUser").validate({
		rules: {
			username: {
				required: true
			},
			first_name: {
				required: true
			},
			last_name: {
				required: true
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
                <li class="active">Edit Profile</li>
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
                            <h3 class="box-title">Edit Profile</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                            <form name="frmUser" id="frmUser" method="post" action="<?php echo base_url()?>admin/home/admin_profile_edit/" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">
                                    <?php if($this->session->flashdata('error')!=''){ ?>
                                            <div class="form-group has-error">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error');?></label>
                                            </div>
                                    <?php } ?>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input name="username" id="username" type="text" value="<?php echo $admin_info["username"]; ?>" class="form-control" />
                                        <span class="error"><?php echo form_error("username"); ?></span>
                                </div>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input name="first_name" id="first_name" type="text" value="<?php echo $admin_info["first_name"]; ?>" class="form-control" />
                                        <span class="error"><?php echo form_error("first_name"); ?></span>
                                </div>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input name="last_name" id="last_name" type="text" value="<?php echo $admin_info["last_name"]; ?>" class="form-control" />
                                        <span class="error"><?php echo form_error("last_name"); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputImage1">Profile Image</label>
                                    <input type="file" class="form-control" id="company_image" name="company_image">
                                </div>
                                <?php
                                    if(isset($admin_info['profile_image']) && $admin_info['profile_image']!="")
                                    {
                                    $image=explode('.', $admin_info['profile_image']);
                                   ?>
                                       
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <img src="<?php echo base_url().'uploads/admin_user_image/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1];?>">
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="edit_profile">Submit</button>                                
                                </div>
                            </div>
                            
                            </form>
                            </div>
                </div> 
        </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
