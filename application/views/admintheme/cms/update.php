<div id="maindiv">
    <div>
        <div class="box_in2">
            <div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/article_img.png" border="0" /></span> <h3>Content Management System: <?php echo $page_title;?> </h3> </div>
            <div class="article_right">
                <ul>
                    <li><a style="cursor:pointer;" onclick="save('frmCms');"><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/save_img.png" border="0" /></span><br />Save</a> </li>
                    <li><a style="cursor:pointer;" onclick="save_close('frmCms');"><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Save-&-Close_img.png" border="0" /></span><br />Save & New </a></li>
                    <li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><a style="cursor:pointer;" href="<?php echo admin_url('cms'); ?>"><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></span><br />Cancel </a></li>
                </ul>
            </div>
        	<div class="clear"></div>
        </div>
    
    	<div class="clear"></div>
    
        <?php if($this->session->flashdata('success_msg')) { ?>
            <div id="success" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
                <span class="ico_success"><?php echo $this->session->flashdata('success_msg'); ?></span> 
            </div>
        	<?php 
        } 
        ?>
        
        <?php if($this->session->flashdata('error_msg')) { ?>
            <div id="fail" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
                <span class="ico_cancel"><?php echo $this->session->flashdata('error_msg'); ?></span>
            </div>
            <?php 
        } 
        ?>
    
        <div class="box_in2">
            <div class="white_box2" style="width:1090px;">
            <div class="arti"><?php echo $page_title;?></div>
            <div class="clear"></div>
            <form name="frmCms" method="post" action="<?php echo admin_url('cms/update')?>" autocomplete="off" enctype="multipart/form-data"><!--Form Open-->
            	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
                        <input type="hidden" name="action_type" value="save" />
                        <input type="hidden" name="id" value="<?php echo $id;?>" />
                        <tr>
                            <td>Page title </td>
                            <td><input name="page_title" type="text" value="<?php if(isset($page_details['page_title'])) echo $page_details['page_title'];?>" class="textfield2" style="width: 235px;"/>
                            <?php echo form_error('page_title');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Page header </td>
                            <td><input name="page_header" type="text" value="<?php if(isset($page_details['page_header'])) echo $page_details['page_header'];?>" class="textfield2" style="width: 235px;"/>
                            <?php echo form_error('page_header');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Title <span style="color: #eb8207;">* </span> </td>
                            <td><input name="title" type="text" value="<?php if(isset($page_details['title'])) echo $page_details['title'];?>" class="textfield2" style="width: 235px;"/>
                            <?php echo form_error('title');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Feature Image </td>
                            <td><input name="page_image" id="page_image" type="file" class="textfield2" style="width: 235px;"/>
                            </td>
                        </tr>
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
                        <tr>
                            <td>Meta Keywords</td>
                            <td><input name="meta_keyword" type="text" value="<?php if(isset($page_details['meta_keyword'])) echo $page_details['meta_keyword'];?>" class="textfield2" style="width: 235px;"/>
                            <span class="error"><?php echo form_error('meta_keyword');?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Meta Description</td>
                            <td><input name="meta_description" type="text" value="<?php if(isset($page_details['meta_description'])) echo $page_details['meta_description'];?>" class="textfield2" style="width: 235px;"/>
                            <span class="error"><?php echo form_error('meta_description');?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Page Content <span style="color: #eb8207;">* </span> </td>
                            <td><textarea name="content" class="ckeditor"><?php if(isset($page_details['content'])) echo $page_details['content'];?></textarea>
                            <span class="error"><?php echo form_error('content');?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input name="submit" id="submit" type="submit" value="Submit" class="btn2" />
                            </td>
                        </tr>
                    </table>
                </form>	<!--Form Close-->			
            </div>
        <div class="clear"></div>
        </div>
    	<div class="clear"></div>
    </div>
</div>