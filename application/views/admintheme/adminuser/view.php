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
                <li>Users</li>
                <li class="active">Details</li>
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
                            <h3 class="box-title">Details</h3>
                            <div class="text-right view-details-btn">                            
                                <a href="javascript:void(0);" class="btn btn-primary" onclick="javascript:history.back(-1);">back</a>
                            </div>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_user" id="add_user" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
                            <div class="box-body">
                                <?php if($this->session->flashdata('error')!=''){ ?>
                                        <div class="form-group has-error">
                                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error');?></label>
                                        </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role: </label>
                                    <?php
                                    echo $user['role'];
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name: </label>
                                    <?php echo (isset($user['first_name']) && $user['first_name']!="")?$user['first_name']:'None';?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name: </label>
                                    <?php echo $user['last_name'];?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email: </label>
                                    <?php echo $user['email_id'];?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number: </label>
                                    <?php echo $user['mobile_no'];?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputImage1">Profile Image: </label>
                                    <?php 
                                    if(isset($user['profile_image']) && $user['profile_image']!="")
                                    {
                                        $image=explode('.', $user['profile_image']);
                                       ?>
                                       <img src="<?php echo base_url().'uploads/admin_user_image/resize/'.$image[0].IMG_SIZE_MEDIUM.'.'.$image[1];?>">
                                       <?php
                                    }?>
                                </div>
                                
                            </div><!-- /.box-body -->

                            
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