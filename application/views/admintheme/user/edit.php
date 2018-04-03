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
                <li >Users</li>
                <li class="active">Edit User</li>
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
                            <h3 class="box-title">Edit User</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_user" id="add_user" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
                            <div class="box-body">
                                    <?php if($this->session->flashdata('error_msg')!=''){ ?>
                                            <div class="form-group has-error">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error_msg');?></label>
                                            </div>
                                    <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="<?php echo $user['first_name'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" id="middle_name" placeholder="Enter middle Name" name="middle_name" value="<?php echo $user['middle_name'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name" value="<?php echo $user['last_name'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No</label>
                                    <input type="text" class="form-control" placeholder="Enter email" name="mobile_no" id="mobile_no" value="<?php echo $user['mobile_no'];?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputImage1">Profile Image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
                                <div>
                                    <?php 
                                    if(isset($user['profile_image']) && $user['profile_image']!="")
                                    {
                                        $image=explode('.', $user['profile_image']);
                                       ?>
                                       <img src="<?php echo base_url().'uploads/user_image/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1];?>">
                                       <?php
                                    }?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control" placeholder="Enter Description" name="description" id="description"><?php echo $user['description'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <textarea class="form-control" placeholder="Enter Address" name="address" id="address"><?php echo $user['address1'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <input type="text" class="form-control" placeholder="Enter City" name="city" id="city" value="<?php echo $user['city'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">State</label>
                                    <input type="text" class="form-control" placeholder="Enter State" name="state" id="state" value="<?php echo $user['state'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <input type="text" class="form-control" placeholder="Enter Country" name="country" id="country" value="<?php echo $user['country'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Zip Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Zipcode" name="zipcode" id="zipcode" value="<?php echo $user['zipcode'];?>">
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