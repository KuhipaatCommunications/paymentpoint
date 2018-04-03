<link href="<?php echo $this->config->item('admin_theme_url')?>css/cmxform.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/jquery.validate.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_validation.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("#frmUser").validate({
		rules: {
			old_password: {
				required: true
			},
			new_password: {
				required: true
			},
			c_new_password: {
				required: true,
				equalTo: '#new_password'
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
                <li class="active">Site Settings</li>
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
                            <h3 class="box-title">Site Settings</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form action="<?php echo site_url('admin/home/settings');?>" name="settings" id="settings" method="post">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">
                                <?php if($this->session->flashdata('error')!=''){ ?>
                                        <div class="form-group has-error">
                                            <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error');?></label>
                                        </div>
                                <?php } ?>
                                <?php
                                if($settings)
                                { 
                                    $i=0;
                                    foreach($settings as $row) 
                                    {?>
                                        <div class="form-group">
                                            <input type='hidden' name='settings[<?php echo $i ?>][key]' value='<?php echo $row->key ?>' />
                                            <label for="exampleInputEmail1"><?php echo $row->title; ?></label>*
                                            <input type="text" class="form-control" name="settings[<?php echo $i ?>][value]" value="<?php echo $row->value; ?>" />
                                        </div>

                                <?php $i++;
                                    } 
                                }
                                ?>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="addCms">Submit</button>                                
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

