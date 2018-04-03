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
                <li >User Roles</li>
                <li class="active">Add Role</li>
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
                            <h3 class="box-title">Add Role</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_role" id="add_role" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="box-body">
                                    <?php if($this->session->flashdata('error_msg')!=''){ ?>
                                            <div class="form-group has-error">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error_msg');?></label>
                                            </div>
                                    <?php } ?>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <input type="text" class="form-control" id="role" placeholder="Enter Role" name="role">
                                </div>
                                <span style="color:red;"><?php echo form_error('role');?></span>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role Access</label>
                                    <div><input type="checkbox" id="selectAll"> Select All</div>
                                    <div style="margin-bottom: 10px;">
                                    <?php
                                    if(!empty($access_pages))
                                    {
                                        $f=1;
                                        foreach($access_pages as $page)
                                        {
                                    ?>
                                    <input type="checkbox" name="access[]" class="checked" value="<?php echo strtolower($page['controller']).'/'.strtolower($page['method']);?>"> <?php if(isset($page['page_name']) && $page['page_name']!=""){echo $page['page_name'];}else{ echo $page['controller'].'/'.$page['method'];}?>
                                    <?php
                                    if(count($access_pages)==$f)
                                        echo '</div>';
                                    elseif($f%3==0)
                                        echo '</div><div style="margin-bottom: 10px;">';
                                    $f++;
                                        }
                                    }
                                    ?>
                                </div>
                                <span style="color:red;"><?php echo form_error('access[]');?></span>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="addRole">Submit</button>
                                <input type="hidden" name="addRole" value="1" />
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
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#selectAll', function(){
           if($(this).is(':checked'))
           {
               $('.checked').prop('checked', true);
           }
           else
               $('.checked').prop('checked', false);
        });
    })
</script>