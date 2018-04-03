<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_script.js"></script>
<form method="post" name="ins_free" id="ins_free" action="user/setUserFreeInsprction">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="user_id" id="use_id" value="">
</form>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Role
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'admin/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Role</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                                <h3 class="box-title">List Of Role</h3>
                                <a href="<?php echo base_url().'/admin/role/add'?>" style="float:right; margin:8px 0 0 0; " > <button class="btn btn-primary">Add</button></a>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">

                            <?php  if($this->session->flashdata('success_msg')!=''){ ?>
                                    <div class="form-group has-success">
                                        <label for="inputSuccess" class="control-label"><i class="fa fa-check"></i> <?php echo $this->session->flashdata('success_msg');?></label>
                                    </div>
                            <?php } ?>
                            <?php  if($this->session->flashdata('error_msg')!=''){ ?>
                            <div class="form-group has-failed" style="color:red;">
                                        <label for="inputFailed" class="control-label"><?php echo $this->session->flashdata('error_msg');?></label>
                                    </div>
                            <?php } ?>
                            <table id="usertab" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Created On</th>
                                            <th style="width:130px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if($role!="" && count($role)>0)
                                    {
                                        foreach($role as $row){ 
                                    ?>
                                            <tr>
                                                <td><?php echo $row["role"]; ?></td> 
                                                <td><?php echo $row['created_on'];?></td>
                                                <td> 
<!--                                                    <a href="<?php //echo base_url('/admin/role/view/'.$row["id"])?>" style="cursor:pointer;"><img src="<?php //echo $this->config->item('admin_theme_url')?>images/view.jpeg" alt="View" title="View" border="0" /></a>&nbsp;&nbsp;&nbsp;-->
                                                    <a href="<?php echo base_url('/admin/role/edit'); ?>/<?php echo $row["id"]; ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/edit.png" alt="Edit" title="Edit" border="0" /></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:void(0)" onclick="delete_single('role/delete', <?php echo $row["id"]; ?>)"><img src="<?php echo $this->config->item('admin_theme_url')?>images/b_drop.png" alt="Delete" title="Delete" border="0" /></a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>	

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>Role</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                        </tr>
                                    </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div><!-- /.row -->



        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
