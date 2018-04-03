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
                <li>Device</li>
                <li class="active">Device Details</li>
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
                            <h3 class="box-title">Device Details</h3>
                            <div class="text-right view-details-btn">
                                <a href="javascript:void(0);" class="btn btn-primary" onclick="javascript:history.back(-1);">back</a>
                            </div>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_user" id="add_user" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <input type="hidden" name="device_id" id="device_id" value="<?php echo $device_id;?>" />

                            <div class="box-body">
                                <?php if($this->session->flashdata('error')!=''){ ?>
                                        <div class="form-group has-error">
                                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error');?></label>
                                        </div>
                                <?php } ?>


                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Device Company : </label>
                                    <?php
                                    $company_name='None';
                                    if(isset($device['company_name']) && $device['company_name']!="")
                                    {

                                        $company_name = $device['company_name'];

                                    }
                                    echo $company_name;
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Device Type: </label>
                                    <?php
                                    $device_type='None';
                                    if(isset($device['device_type']) && $device['device_type']!="")
                                    {

                                        $device_type = $device['device_type'];

                                    }
                                    echo $device_type;
                                    ?>
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Device No: </label>
                                    <?php
                                    $device_no='None';
                                    if(isset($device['device_no']) && $device['device_no']!="")
                                    {

                                        $device_no = $device['device_no'];

                                    }
                                    echo $device_no;
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status : </label>
                                    <?php
                                    $status ='Not Assigned';
                                    if(isset($device['status']) && $device['status']!="")
                                    {
                                        if($device['status']== '1')
                                            $status =  "Active";

                                    }
                                    echo $status;
                                    ?>
                                </div>


                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Merchant Name : </label>

                                    <?php
                                    $first_name ='';
                                    $middle_name ='';
                                    $last_name ='';

                                    $full_name='';

                                    if(isset($merchant_name['first_name']) && $merchant_name['first_name']!="")
                                    {
                                        $first_name = $merchant_name['first_name'];
                                    }


                                    if(isset($merchant_name['middle_name']) && $merchant_name['middle_name']!="")
                                    {
                                        $middle_name = $merchant_name['middle_name'];
                                    }

                                    if(isset($merchant_name['last_name']) && $merchant_name['last_name']!="")
                                    {
                                        $last_name = $merchant_name['last_name'];
                                    }

                                    echo $full_name=$first_name.' '.$middle_name.' '.$last_name;


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
