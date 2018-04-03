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
                <li>Child Merchant</li>
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
                        <form role="form" method="post" name="view_user" id="add_user" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
                            <div class="box-body">
                                <?php if($this->session->flashdata('error')!=''){ ?>
                                        <div class="form-group has-error">
                                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error');?></label>
                                        </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Type: </label>
                                    <?php
                                    $type='Child Merchant';
                                    echo $type;
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bill Desk Merchant Id: </label>
                                    <?php

                                     $cm_bd_merchant_id='None';
                                     if(isset($child_merchant['bd_merchant_id']) && $child_merchant['bd_merchant_id']!="")
                                     {
                                         $cm_bd_merchant_id = $child_merchant['bd_merchant_id'];
                                     }
                                     echo $cm_bd_merchant_id;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Merchant Return Url : </label>
                                    <?php

                                     $cm_return_url='None';
                                     if(isset($child_merchant['cm_return_url']) && $child_merchant['cm_return_url']!="")
                                     {
                                         $cm_return_url = $child_merchant['cm_return_url'];
                                     }
                                     echo $cm_return_url;
                                     ?>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Merchant Name: </label>
                                    <?php
                                     //echo (isset($child_merchant['cm_name']));
                                     $cm_name='None';
                                     if(isset($child_merchant['cm_name']) && $child_merchant['cm_name']!="")
                                     {
                                         $cm_name = $child_merchant['cm_name'];
                                     }
                                     echo $cm_name;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status: </label>
                                    <?php

                                     $cm_status='Not Active';
                                     if(isset($child_merchant['cm_status']) && $child_merchant['cm_status']!="")
                                     {

                                       $cm_status = $child_merchant['cm_status'];
                                       if($cm_status == 0)
                                          $cm_status = "Not Active";
                                        else
                                          $cm_status = "Active";
                                     }
                                     echo $cm_status;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email: </label>
                                    <?php

                                     $email='None';
                                     if(isset($child_merchant['cm_email']) && $child_merchant['cm_email']!="")
                                     {
                                         $cm_email = $child_merchant['cm_email'];
                                     }
                                     echo $cm_email;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile No: </label>
                                    <?php

                                     $mobile_no_1='None';
                                     if(isset($child_merchant['mobile_no_1']) && $child_merchant['mobile_no_1']!="")
                                     {
                                         $mobile_no_1 = $child_merchant['mobile_no_1'];
                                     }
                                     echo $mobile_no_1;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alternate Mobile No: </label>
                                    <?php

                                     $mobile_no_2='None';
                                     if(isset($child_merchant['mobile_no_2']) && $child_merchant['mobile_no_2']!="")
                                     {
                                         $mobile_no_2 = $child_merchant['mobile_no_2'];
                                     }
                                     echo $mobile_no_2;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address Line 1:</label>
                                    <?php
                                     $cm_address_1='None';
                                     if(isset($child_merchant['cm_address_1']) && $child_merchant['cm_address_1']!="")
                                     {
                                         $cm_address_1 = $child_merchant['cm_address_1'];
                                     }
                                     echo $cm_address_1;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address Line 2:</label>
                                    <?php
                                     $cm_address_2='None';
                                     if(isset($child_merchant['cm_address_2']) && $child_merchant['cm_address_2']!="")
                                     {
                                         $cm_address_2 = $child_merchant['cm_address_2'];
                                     }
                                     echo $cm_address_2;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location/City/Village/Town :</label>
                                    <?php
                                     $cm_location='None';
                                     if(isset($child_merchant['cm_location']) && $child_merchant['cm_location']!="")
                                     {
                                         $cm_location = $child_merchant['cm_location'];
                                     }
                                     echo $cm_location;
                                     ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pincode :</label>
                                    <?php
                                     $cm_pincode='None';
                                     if(isset($child_merchant['cm_pincode']) && $child_merchant['cm_pincode']!="")
                                     {
                                         $cm_pincode = $child_merchant['cm_pincode'];
                                     }
                                     echo $cm_pincode;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">District :</label>
                                    <?php
                                     $cm_district='None';
                                     if(isset($child_merchant['cm_district']) && $child_merchant['cm_district']!="")
                                     {
                                         $cm_district = $child_merchant['cm_district'];
                                     }
                                     echo $cm_district;
                                     ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">State :</label>
                                    <?php
                                     $cm_state='None';
                                     if(isset($child_merchant['cm_state']) && $child_merchant['cm_state']!="")
                                     {
                                         $cm_state = $child_merchant['cm_state'];
                                     }
                                     echo $cm_state;
                                     ?>
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
