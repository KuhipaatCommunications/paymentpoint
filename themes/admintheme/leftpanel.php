<?php
//$access_controller = $this->session->userdata('access_controller');
//$access_method = $this->session->userdata('access_method');
$getAccess=getAccessControllerAndMethod();
$access_controller=$getAccess['a_controller'];
$access_method=$getAccess['a_method'];
?>
<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php /*?><div class="user-panel">
                        <div class="pull-left image">
                            <!-- <img src="<?php echo $this->config->item('admin_theme_url')?>images/avatar3.png" class="img-circle" alt="User Image" /> -->
                            <?php if($this->session->userdata('admin_id')) {
                                        $adminid=$this->session->userdata('admin_id');
                                        $this->load->model('admin/common_methods');
                                        $admnuserdtls=$this->common_methods->getSingle("admin","id =" .$adminid,"","","","");
                                        //print_r($admnuserdtls);
                                        ?>
                                    <img src="<?php echo base_url(); ?>uploads/admin_user_image/<?php echo $admnuserdtls['profile_image']; ?>" class="img-circle" alt="User Image" />
                                    <?php } else {?>
                                    <img src="<?php echo $this->config->item('admin_theme_url')?>images/avatar3.png" class="img-circle" alt="User Image" />
                                    <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->session->userdata('admin_name');?></p>

                           <?php
				if($this->session->userdata('admin_id'))
				{
				?>
                                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			   <?php
				}
			   ?>
                        </div>
                    </div><?php */?>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    <?php
                        if($this->session->userdata('role_id')==1 || in_array('dashboard', $access_controller))
                        {
                        ?>
                        <li class="<?php if($this->router->fetch_class()=='dashboard')echo 'active';?>">
                            <?php
                            if($this->session->userdata('role_id')==1 || in_array('dashboard/index', $access_method))
                            {
                            ?>
                                <a href="<?php echo base_url().'admin/dashboard';?>">
                                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                </a>
                            <?php
                            }
                            ?>
                        </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || (in_array('home', $access_controller) && in_array('home/settings', $access_method)))
                        {
                        ?>
                            <li class="<?php if($this->router->fetch_method()=='settings')echo 'active';?>">
                                <a href="<?php echo base_url().'admin/home/settings';?>">
                                    <i class="fa fa-cogs"></i> <span>Site Settings</span>
                                </a>
                            </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('user', $access_controller))
                        {
                        ?>
                            <li class="treeview <?php if($this->router->fetch_class()=='user')echo 'active';?>" >
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span>Manage Users</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if($this->session->userdata('role_id')==1 || in_array('user/add', $access_method))
                                    {
                                    ?>
                                    <li><a href="<?php echo base_url();?>admin/user/add"><i class="fa fa-angle-right"></i> Add User </a></li>
                                    <?php
                                    }
                                    if($this->session->userdata('role_id')==1 || in_array('user/index', $access_method))
                                    {
                                    ?>
                                    <li><a href="<?php echo base_url();?>admin/user"><i class="fa fa-angle-right"></i>Manage User</a></li>
                                    <?php
                                    }
                                    ?>
                                    <!-- <li><a href="<?php echo base_url();?>admin/user/balance"><i class="fa fa-angle-right"></i>List User Balance</a></li> -->
                                </ul>
                            </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('cms', $access_controller))
                        {
                        ?>
                            <li class="treeview <?php if($this->router->fetch_class()=='cms')echo 'active';?>" >
                                <a href="#">
                                    <i class="fa fa-columns"></i>
                                    <span>Manage CMS</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if($this->session->userdata('role_id')==1 || in_array('cms/update', $access_method))
                                    {
                                    ?>
                                        <li><a href="<?php echo base_url();?>admin/cms/update"><i class="fa fa-angle-right"></i> Create Page </a></li>
                                    <?php
                                    }
                                    if($this->session->userdata('role_id')==1 || in_array('cms/index', $access_method))
                                    {
                                    ?>
                                        <li><a href="<?php echo base_url();?>admin/cms"><i class="fa fa-angle-right"></i>Manage Pages</a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php
                        }
                        // if($this->session->userdata('role_id')==1 || (in_array('contactus', $access_controller) && in_array('contactus/index', $access_method)))
                        // {
                        ?>
            		    <!-- <li class="treeview <?php if($this->router->fetch_class()=='contactus')echo 'active';?>" >
                                <a href="#">
                                    <i class="fa fa-list-ol"></i>
                                    <span>Manage Contacts</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url();?>admin/contactus"><i class="fa fa-angle-right"></i>Manage Contacts</a></li>
                                </ul>
                            </li> -->
                        <?php
                        //}
                        if($this->session->userdata('role_id')==1 || in_array('role', $access_controller))
                        {
                        ?>
                            <li class="treeview <?php if($this->router->fetch_class()=='role')echo 'active';?>" >
                                <a href="#">
                                    <i class="fa fa-columns"></i>
                                    <span>Manage Role</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if($this->session->userdata('role_id')==1 || in_array('role/add', $access_method))
                                    {
                                    ?>
                                        <li><a href="<?php echo base_url();?>admin/role/add"><i class="fa fa-angle-right"></i> Add Role </a></li>
                                    <?php
                                    }
                                    if($this->session->userdata('role_id')==1 || in_array('role/index', $access_method))
                                    {
                                    ?>
                                        <li><a href="<?php echo base_url();?>admin/role"><i class="fa fa-angle-right"></i>Manage Role</a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('adminuser', $access_controller))
                        {
                        ?>
                            <li class="treeview <?php if($this->router->fetch_class()=='adminuser')echo 'active';?>" >
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span>Manage Admin Users</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if($this->session->userdata('role_id')==1 || in_array('adminuser/add', $access_method))
                                    {
                                    ?>
                                    <li><a href="<?php echo base_url();?>admin/adminuser/add"><i class="fa fa-angle-right"></i> Add Admin User </a></li>
                                    <?php
                                    }
                                    if($this->session->userdata('role_id')==1 || in_array('adminuser/index', $access_method))
                                    {
                                    ?>
                                    <li><a href="<?php echo base_url();?>admin/adminuser"><i class="fa fa-angle-right"></i>Manage Admin User</a></li>
                                    <?php
                                    }
                                    ?>
                                    <!-- <li><a href="<?php echo base_url();?>admin/user/balance"><i class="fa fa-angle-right"></i>List User Balance</a></li> -->
                                </ul>
                            </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('cmerchant', $access_controller))
                        {
                        ?>
                        <li class="treeview <?php if($this->router->fetch_class()=='cmerchant')echo 'active';?>" >
                            <a href="#">
                                <i class="fa fa-list-ol"></i>
                                <span>Manage Child Merchant</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php
                                if($this->session->userdata('role_id')==1 || in_array('cmerchant/add', $access_method))
                                {
                                ?>
                                    <li><a href="<?php echo base_url();?>admin/cmerchant/add"><i class="fa fa-angle-double-right"></i> Add Child Merchant </a></li>
                                <?php
                                }
                                if($this->session->userdata('role_id')==1 || in_array('cmerchant/index', $access_method))
                                {
                                ?>
                                    <li><a href="<?php echo base_url();?>admin/cmerchant/index"><i class="fa fa-angle-right"></i>Manage Child Merchant</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('mpos', $access_controller))
                        {
                        ?>
                        <li class="treeview <?php if($this->router->fetch_class()=='mpos')echo 'active';?>" >
                            <a href="#">
                                <i class="fa fa-list-ol"></i>
                                <span>Manage Mpos Merchant</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <?php
                            if($this->session->userdata('role_id')==1 || in_array('mpos/add', $access_method))
                            {
                            ?>
                                <li><a href="<?php echo base_url();?>admin/mpos/add"><i class="fa fa-angle-double-right"></i> Add Mpos Merchant </a></li>
                            <?php
                            }
                            if($this->session->userdata('role_id')==1 || in_array('mpos/index', $access_method))
                            {
                            ?>
                                <li><a href="<?php echo base_url();?>admin/mpos/index"><i class="fa fa-angle-right"></i>Manage Mpos Merchant</a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('device', $access_controller))
                        {
                        ?>
                        <li class="treeview <?php if($this->router->fetch_class()=='device')echo 'active';?>" >
                            <a href="#">
                                <i class="fa fa-list-ol"></i>
                                <span>Manage Device</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <?php
                            if($this->session->userdata('role_id')==1 || in_array('device/add', $access_method))
                            {
                            ?>
                                <li><a href="<?php echo base_url();?>admin/device/add"><i class="fa fa-angle-double-right"></i> Add Device </a></li>
                            <?php
                            }
                            if($this->session->userdata('role_id')==1 || in_array('device/index', $access_method))
                            {
                            ?>
                                <li><a href="<?php echo base_url();?>admin/device/index"><i class="fa fa-angle-right"></i>Manage Device</a></li>
                            <?php
                            }
                            ?>
                            </ul>
                        </li>
                        <?php
                        }
                        if($this->session->userdata('role_id')==1 || in_array('lead', $access_controller))
                        {
                        ?>
                        <li class="treeview <?php if($this->router->fetch_class()=='lead')echo 'active';?>" >
                            <a href="#">
                                <i class="fa fa-list-ol"></i>
                                <span>Manage Leads</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                              <?php
                                if($this->session->userdata('role_id')==1 || in_array('lead/index', $access_method))
                                {
                                ?>
                                    <li><a href="<?php echo base_url();?>lead/index"><i class="fa fa-angle-right"></i>view Leads</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }

                        ?>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
