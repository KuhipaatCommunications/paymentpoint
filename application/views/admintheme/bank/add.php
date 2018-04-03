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
                <li >Add Bank</li>
                <li class="active">Add Bank Details</li>
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
                            <h3 class="box-title">Add Bank Details</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_bank" id="add_bank" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"


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

                                    <input type="hidden" name="is_child_merchant" id="is_child_merchant" value="<?php echo $is_child_merchant;?>"

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Benificary  Name*</label>
                                        <input type="text" class="form-control" id="benificiary_name" placeholder="Enter Benificary Name" name="benificiary_name" required>
                                    </div>

                                    <span style="color:red;"><?php echo form_error('benificiary_name');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bank Name*</label>
                                    <input type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name" name="bank_name" required>
                                </div>
                                <span style="color:red;"><?php echo form_error('bank_name');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Account Number*</label>
                                    <input type="text" class="form-control" id="account_number" placeholder="Enter Account Number" name="account_number" required>
                                </div>

                                <span style="color:red;"><?php echo form_error('account_number');?></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">IFSC Code*</label>
                                    <input type="text" class="form-control" id="ifsc_code" placeholder="Enter IFSC Code" name="ifsc_code" required>
                                </div>

                                <span style="color:red;"><?php echo form_error('ifsc_code');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bank Branch Name*</label>
                                    <input type="text" class="form-control" id="bank_branch" placeholder="Enter Branch Name" name="bank_branch" required>
                                </div>

                                <span style="color:red;"><?php echo form_error('bank_branch');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description </label>
                                    <input type="text" class="form-control" id="description" placeholder="Description " name="description">
                                </div>

                                <span style="color:red;"><?php echo form_error('description');?></span>


                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="add_bank">Save</button>
                                <input type="hidden" name="add_bank" value="1" />
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
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('change', '#company_name', function(){
             var val=$(this).val();
            if(val == "others")
                $('#other_company_name').show();
            else
                $('#other_company_name').hide();

            var csrf_value=$('input[name=_pp_token]').val();


        $.ajax({    //create an ajax request
        type: "POST",
        url: "<?php echo base_url('admin/ajax/ajax_device/get_device_type_by_company_name') ?>",
        data: {"company_name":val, "_pp_token":csrf_value},
        //dataType: "html",   //expect html to be returned
        success: function(response){
            //$(#responsecontainer").html(response);
              // alert(response);
            var result = JSON.parse(response);
            $('input[name=_pp_token]').val(result.csrf_value);
            var options='<option value="" >Select Device Type</option><option value="others">Others</option>';

             if(result && result['data'].length>0)
             {
                for(i = 0; i<=result['data'].length; i++){

                    //alert(result[i].device_type);

                    options +='<option value="'+result['data'][i].device_type+'">'+result['data'][i].device_type+'</option>';
                    $('#device_type').html(options);

                }

            }
            else{

                 $('#device_type').html(options);
            }


        }
        });

        })


         $(document).on('change', '#device_type', function(){
             var val=$(this).val();
            if(val == "others")
                $('#other_device_type').show();
            else
                $('#other_device_type').hide();
        })




    });

</script>
