<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_script.js"></script>

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
                <li class="active">Cms</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                                <h3 class="box-title">List Of Pages</h3>
                                <a href="<?php echo site_url('admin/cms/update');?>" style="float:right; margin:8px 0 0 0; " > <button class="btn btn-primary">Add</button></a>
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
                            <table id="cmstab" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>content</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if($pages!="" && count($pages)>0)
                                    {
                                        foreach($pages as $row){                                                                             ?>
                                            <tr>
                                                <td>
                                                    <?php if(isset($row['page_image']) && $row['page_image']!=""){?>
                                                        <img src="<?php echo base_url()?>uploads/page_image/thumbs/<?php echo $row["page_image"];?>" width="100" height="100" />
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url();?>themes/admintheme/images/no_image.jpg" alt="<?php echo $row['title'];?>" width="100" height="100" title="<?php echo $row['title'];?>" />
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row["title"]; ?></td> 
                                                <td style="max-width:300px;"><?php echo word_limiter($row["content"], 50); ?></td> 
                                                <td><a style="cursor:pointer;" onclick="<?php if($row['status'] == '1'){echo "deactivate('/cms/change_status', ".$row["id"].");";}else{ echo "activate('/cms/change_status', ".$row["id"].");";}?>"><?php if($row['status'] == '1'){?> <img src="<?php echo $this->config->item('admin_theme_url')?>images/right.png" alt="unblock" title="unblock" border="0" /> <?php }else{ ?> <img src="<?php echo $this->config->item('admin_theme_url')?>images/inactive.png" alt="block" title="block" border="0" /> <?php } ?></a></td>
                                                <td> 
                                                    <!-- <a href="<?php echo site_url('admin/cms/view/'.$row["id"])?>" style="cursor:pointer;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/view.jpeg" alt="View" title="View" border="0" /></a>&nbsp;&nbsp;&nbsp; -->
                                                    <a href="<?php echo site_url('admin/cms/update'); ?>/<?php echo $row["id"]; ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/edit.png" alt="Edit" title="Edit" border="0" /></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:void(0)" onclick="delete_single('cms/delete', <?php echo $row["id"]; ?>)"><img src="<?php echo $this->config->item('admin_theme_url')?>images/b_drop.png" alt="Delete" title="Delete" border="0" /></a>
                                                </td>
                                            </tr>
                                    <?php }
                                    }else{
                                    ?>
                                        <tr>
                                            <td colspan="5">No Data Found</td>
                                        </tr>
                                    <?php
                                    } ?>	

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>content</th>
                                            <th>Status</th>
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
