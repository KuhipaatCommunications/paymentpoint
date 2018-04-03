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
                <li >Mpos Merchant</li>
                <li class="active">Add Mpos Merchant</li>
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
                            <h3 class="box-title">Add Mpos Merchant</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_mpos_merchant" id="add_mpos_merchant" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">

                                    <?php if($this->session->flashdata('error_msg')!=''){ ?>
                                            <div class="form-group has-error">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error_msg');?></label>
                                            </div>
                                    <?php } ?>

                                     <?php if($this->session->flashdata('success_msg')!=''){ ?>
                                            <div class="form-group has-success">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('success_msg');?></label>
                                            </div>
                                    <?php } ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Type*</label>
                                    <select name="user_type" id="user_type" required>
                                        <!-- <option value="">Select User Type</option> -->
                                        <option value="m">Mpos Merchant</option>
                                       <!-- <option value="c">Individual</option>-->
                                    </select>
                                </div>
                                <span style="color:red;"><?php echo form_error('user_type');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name*</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('first_name');?></span>


                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Middle Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter Middle Name" name="middle_name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name*</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" id="last_name" required >
                                </div>
                                <span style="color:red;"><?php echo form_error('last_name');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter email" name="email" id="email">
                                </div>
                                <span style="color:red;"><?php echo form_error('email');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No*</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile No" name="mobile_no_1" id="mobile_no" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('mobile_no_1');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alternate Mobile No</label>
                                    <input type="text" class="form-control" placeholder="Enter Alternate Mobile No" name="mobile_no" id="mobile_no_2">
                                </div>

                               <div class="form-group">
                                    <label for="exampleInputEmail1">Address 1*</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 1 " name="address_1" id="address_1" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('address_1');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address 2</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 2 " name="address_2" id="address_2">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">City/village/Town*</label>
                                    <input type="text" class="form-control" placeholder="Enter City/village/Town" name="city" id="city" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('city');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pin Code*</label>
                                    <input type="text" class="form-control" placeholder="Enter Pin code" name="pincode" id="pincode" required>
                                </div>

                                <span style="color:red;"><?php echo form_error('pincode');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">District*</label>
                                    <input type="text" class="form-control" placeholder="Enter District" name="district" id="district" required>
                                </div>

                                <span style="color:red;"><?php echo form_error('district');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">State*</label>
                                    <input type="text" class="form-control" placeholder="Enter State" name="state" id="state" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('state');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <input type="text" class="form-control" placeholder="Enter Country" name="country" id="country" value="India">
                                </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="add_mpos_merchant">Submit</button>

                                <button type="button" class="btn btn-primary" name="add_mpos_merchant">Clear</button>
                                <input type="hidden" name="add_mpos_merchant" value="1" />
                            </div>
                        </form>
                    </div>
                </div>

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

!
