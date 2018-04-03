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
                <li >Child Merchant</li>
                <li class="active">Add Child Merchant</li>
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
                            <h3 class="box-title">Add Child Merchant</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_child_merchant" id="add_child_merchant" action="<?php echo base_url().'admin/cmerchant/add';?>" enctype="multipart/form-data">
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
                              </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Business Entity*</label>
                                    <select name="cm_type_id" id="cm_type_id" required>
                                        <option value="">Select Business Entity</option>
                                        <option value="1">Sole Proprietor</option>
                                        <option value="2">Partnership</option>
                                        <option value="3">Goverment Controlled</option>
                                        <option value="4">Private Ltd Company</option>
                                        <option value="5">Public Ltd Company</option>
                                    </select>
                                </div>
                                <span style="color:red;"><?php echo form_error('cm_type_id');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">BillDesk Merchant ID*</label>
                                    <input type="text" class="form-control" id="bd_merchant_id" placeholder="Enter Bill Desk Merchant ID" name="bd_merchant_id" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('bd_merchant_id');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Merchant Name*</label>
                                    <input type="text" class="form-control" id="cm_name" placeholder="Enter Merchant Name" name="cm_name" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('cm_name');?></span>

                                <div class="form-group">
                                     <label for="exampleInputEmail1">Return Url*</label>
                                     <input type="text" class="form-control" placeholder="Enter Return URL" name="cm_return_url" id="cm_return_url" required>
                                 </div>
                                  <span style="color:red;"><?php echo form_error('cm_return_url');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Merchant Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Merchant Email" name="cm_email" id="cm_email">
                                </div>
                                <span style="color:red;"><?php echo form_error('email');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No*</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile No" name="mobile_no_1" id="mobile_no_1" required>
                                </div>
                                 <span style="color:red;"><?php echo form_error('mobile_no_1');?></span>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Alternate Mobile No</label>
                                    <input type="text" class="form-control" placeholder="Enter Alternate Mobile No" name="mobile_no_2" id="mobile_no_2">
                                </div>
                                 <span style="color:red;"><?php echo form_error('mobile_no_2');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">LandLine</label>
                                    <input type="text" class="form-control" placeholder="Enter LandLine No" name="land_line_1" id="land_line_1">
                                </div>
                                 <span style="color:red;"><?php echo form_error('land_line_1');?></span>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Alternate Landline No</label>
                                    <input type="text" class="form-control" placeholder="Enter Alternate LandLine No" name="land_line_2" id="land_line_2">
                                </div>
                                 <span style="color:red;"><?php echo form_error('land_line_2');?></span>


                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Address 1*</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 1" name="cm_address_1" id="cm_address_1" required>
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_address_1');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address 2</label>
                                    <input type="text" class="form-control" placeholder="Enter Address 2" name="cm_address_2" id="cm_address_2">
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_address_2');?></span>


                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Pincode*</label>
                                    <input type="text" class="form-control" placeholder="Enter Pincode" name="cm_pincode" id="cm_pincode" required>
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_pincode');?></span>



                                <div class="form-group">
                                    <!-- <input type="text" class="form-control" placeholder="Enter Location" name="cm_location" id="cm_location"> -->
                                    <label for="exampleInputEmail1">Location/City/Village/Town</label>
                                    <input type="text" class="form-control" placeholder="Enter Location/City/Village/Town" name="cm_location" id="cm_location">
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_location');?></span>

                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <input type="text" class="form-control" placeholder="Enter City" name="cm_city" id="cm_city">
                                </div>

                                 <span style="color:red;"><?php //echo form_error('cm_city');?></span> -->


                                 <div class="form-group">
                                    <label for="exampleInputEmail1">District*</label>
                                    <input type="text" class="form-control" placeholder="Enter District" name="cm_district" id="cm_district" required>
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_district');?></span>


                               <div class="form-group">
                                    <label for="exampleInputEmail1">State*</label>
                                    <input type="text" class="form-control" placeholder="Enter State" name="cm_state" id="cm_state" required>
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_state');?></span>


                               <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <input type="text" class="form-control" placeholder="Enter Country" name="cm_country" id="cm_country" value="INDIA">
                                </div>
                                 <span style="color:red;"><?php echo form_error('cm_country');?></span>



                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="addChildMerchant">Submit</button>
                                <input type="hidden" name="addChildMerchant" value="1" />
                            </div>
                        </form>
                    </div><!-- /.box -->
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
