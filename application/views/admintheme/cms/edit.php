<link href="<?php echo $this->config->item('admin_theme_url')?>css/cmxform.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->config->item('admin_theme_url')?>scripts/jquery.validate.js"></script>
<!-- <script src="<?php echo $this->config->item('admin_theme_url')?>scripts/admin_validation.js"></script> -->
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
                <li class="active">Edit Cms Page</li>
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
                            <h3 class="box-title">Edit Cms Page</h3>
                            <a href="javascript:void(0);" style="float:right; margin:8px 0 0 0; " onclick="javascript:history.back(-1);"> <button class="btn btn-primary">back</button></a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="post" name="add_cms" id="add_cms" action="" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                            <div class="box-body">
                                    <?php if($this->session->flashdata('error')!=''){ ?>
                                            <div class="form-group has-error">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error');?></label>
                                            </div>
                                    <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Page title</label> 
                                    <input name="page_title" type="text" value="<?php if(isset($page_details['page_title'])) echo $page_details['page_title'];?>" class="form-control"/>
                                    <?php echo form_error('page_title');?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Page header</label>
                                    <input name="page_header" type="text" value="<?php if(isset($page_details['page_header'])) echo $page_details['page_header'];?>" class="form-control"/>
                                    <?php echo form_error('page_header');?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input name="title" type="text" value="<?php if(isset($page_details['title'])) echo $page_details['title'];?>" class="form-control" />
                                    <span style="color:red;"><?php echo form_error('title');?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Feature Image</label>
                                    <input name="page_image" id="page_image" type="file" class="form-control" />
                                <?php
                                        if(isset($page_details['page_image']) && $page_details['page_image']!="")
                                        {
                                        ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <img src="<?php echo base_url();?>uploads/page_image/thumbs/<?php echo $page_details['page_image'];?>" alt="" width="100" height="100" title="" />
                                                </td>
                                            </tr>
                                <?php
                                }
                                ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Keywords</label>
                                    <input name="meta_keyword" type="text" value="<?php if(isset($page_details['meta_keyword'])) echo $page_details['meta_keyword'];?>" class="form-control" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Description</label>
                                    <input name="meta_description" type="text" value="<?php if(isset($page_details['meta_description'])) echo $page_details['meta_description'];?>" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Page Content</label>
                                    <textarea name="content" class="form-control ckeditor"><?php if(isset($page_details['content'])) echo $page_details['content'];?></textarea>
                                </div>
                                
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