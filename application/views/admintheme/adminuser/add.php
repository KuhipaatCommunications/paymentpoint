<link href="<?php echo $this->config->item('admin_theme_url')?>css/cmxform.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/jquery.validate.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_validation.js"></script>
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
                <li >Admin Users</li>
                <li class="active">Add Admin User</li>
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
                            <h3 class="box-title">Add Admin User</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_adminuser" id="add_adminuser" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">
                                <?php if($this->session->flashdata('error_msg')!=''){ ?>
                                        <div class="form-group has-error">
                                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error_msg');?></label>
                                        </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Role</label>
                                    <select name="role_id">
                                        <option value="">Select Role</option>
                                        <?php
                                        foreach($roles as $r)
                                        {
                                        ?>
                                            <option value="<?php echo $r['id']?>"><?php echo $r['role']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span style="color:red;"><?php echo form_error('role_id');?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter User Name" name="user_name">
                                </div>
                                <span style="color:red;"><?php echo form_error('user_name');?></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                                </div>
                                <span style="color:red;"><?php echo form_error('password');?></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">
                                </div>
                                <span style="color:red;"><?php echo form_error('first_name');?></span>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name">
                                </div>
                                <span style="color:red;"><?php echo form_error('last_name');?></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter email" name="email_id" id="email_id">
                                </div>
                                <span style="color:red;"><?php echo form_error('email_id');?></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile No" name="mobile_no" id="mobile_no">
                                </div>
                                <span style="color:red;"><?php echo form_error('mobile_no');?></span>
                                <div class="form-group">
                                    <label for="exampleInputImage1">Profile Image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
 
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="addUser">Submit</button>
                                <input type="hidden" name="addUser" value="1" />
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