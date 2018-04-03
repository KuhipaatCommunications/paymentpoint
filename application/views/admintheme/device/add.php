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
                <li >Add Device</li>
                <li class="active">Add Device</li>
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
                            <h3 class="box-title">Add Device </h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_device" id="add_device" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                          <!--   <input type="hidden" id="ajax_csrf" value="<?php //echo $this->security->get_csrf_hash(); ?>"> -->
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
                                    <label for="exampleInputEmail1">Select Device Company*</label>
                                    <select name="company_name" id="company_name" required>
                                        <option value="">Select Company</option>
                                        <?php foreach ($companies as $row) { ?>
                                            # code...
                                            <option value="<?php echo $row['company_name'];?>"><?php echo $row['company_name'];?></option>
                                        <?php } ?>

                                        <option value="others">Others</option> 
                                    </select>
                                </div>
                                <span style="color:red;"><?php echo form_error('company_name');?></span>   

                                <div class="form-group" id="other_company_name" <?php if($company_name != "others")   echo "hidden";?> >
                                    <label for="exampleInputEmail1">Enter Company Name*</label>
                                    <input type="text" class="form-control" id="other_company_name" placeholder="Enter Company Name" name="other_company_name" >
                                </div>
                                
                                <span style="color:red;"><?php echo form_error('other_company_name');?></span>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Device Type*</label>
                                    <select name="device_type" id="device_type" required>
                                          <option value="" >Select Device Type</option>
                                      
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <span style="color:red;"><?php echo form_error('device_type');?></span>

                                 <div id="other_device_type" class="form-group" <?php if($device_type != "others") echo " hidden ";?> >
                                    <label for="exampleInputEmail1">Enter Device Type</label>
                                    <input type="text" class="form-control" id="other_device_type" placeholder="Enter Device Type" name="other_device_type" >
                                </div>

                                <span style="color:red;"><?php echo form_error('other_device_type');?></span>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Device No*</label>
                                    <input type="text" class="form-control" id="device_no" placeholder="Enter Device Number" name="device_no" required>
                                </div>
                                
                                <span style="color:red;"><?php echo form_error('device_no');?></span>

                                                                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="add_device">Save</button>
                                <input type="hidden" name="add_device" value="1" />
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