 <!-- Plugins stylesheets -->

        <link href="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/misc/fullcalendar/fullcalendar.css" rel="stylesheet" /> 

        <link href="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/uniform/uniform.default.css" rel="stylesheet" /> 

        <link href="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/ui/jgrowl/jquery.jgrowl.css" rel="stylesheet" /> 

	<!-- <link rel="stylesheet" href="<?php echo $this->config->item('admin_theme_url') ?>css/bootstrap/bootstrap.css" type="text/css" />  -->

        <!-- Plugins stylesheets -->

        <link href="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/select2/select2.css" rel="stylesheet" />

        <!-- app stylesheets -->

        <link href="<?php echo $this->config->item('admin_theme_url') ?>css/app.css" rel="stylesheet" /> 
        <link href="<?php echo $this->config->item('admin_theme_url') ?>css/icons.css" rel="stylesheet" /> 

<script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/dashboard.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url') ?>scripts/jquery.flot.min.js"></script>
<div class="wrapper row-offcanvas row-offcanvas-left">
<aside class="right-side">
<section class="content">

         <div class="crumb">
                </div>
                <div class="container-fluid">
                    <div id="heading" class="page-header">
                        <h1><i class="icon20 i-dashboard"></i> Dashboard</h1>
                    </div>
                    
                    
                 <div class="row">
                  <!------------- MEMBER STATISTIC START  ------------------>
			<div class="col-lg-6" >
                            	<div class="panel panel-default">
                                	<div class="panel-heading">
                                    	<div class="icon"><i class="icon20 i-stats"></i></div>
                                    	<h4>Member Statistic </h4>
                                    	<a href="#" class="minimize"></a>
                                	</div><!-- End .panel-heading -->
                           
                                	<div class="panel-body">
                                    	<div class="campaign-stats center" style="border-top:none;">
                                        	<div class="items">
                                            	<div class="percentage" data-percent="100"><span>100%</span></div>
                                            		<div class="txt">Total <?php echo $total_member;?></div>
                                        		</div>
                                         		<div class="items">
                                            		<div class="percentage-green" data-percent="<?php if($total_member){echo ($lnd_member/$total_member)*100;}?>"><span><?php if($total_member){echo floor(($lnd_member/$total_member)*100);}else{echo '0';}?></span>%</div>
                                            		<div class="txt">Active <?php echo $lnd_member;?></div>
                                        		</div>
                                     
                                        		<div class="items">
                                            		<div class="percentage" data-percent="<?php if($total_member){echo ($tnt_member/$total_member)*100;}?>"><span><?php if($total_member){echo floor(($tnt_member/$total_member)*100);}?></span>%</div>
                                          			<div class="txt">Inactive <?php echo $tnt_member;?></div>
                                        		</div>
                                                
                            		</div><!-- End .widget -->
                        		</div>
                            </div>
                        </div>
                                <!------- MEMBER STATISTIC END ---------------------------->
                                
                               <!-------------PAID / FREE MEMBERSHIP STATISTIC START  ------------------>
            
                   <!-------------PAID / FREE MEMBERSHIP STATISTIC END  ------------------>
                                    <!--------------------------  REGISTRATION STATISTIC START ------------------------------>              
                    <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  <div class="icon"><i class="icon20 i-cube"></i></div> 
                                  <h4>Registration Statistic</h4>
                                  <a href="#" class="minimize"></a>
                                </div><!-- End .panel-heading -->

                                <div class="panel-body noPadding">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#home1" data-toggle="tab"><?=date('F Y',strtotime('-2 month'))?></a></li>
                    <li><a href="#profile1" data-toggle="tab"><?=date('F Y',strtotime('last month'))?></a></li>
                    <li><a href="#profile2" data-toggle="tab"><?=date('F Y')?></a></li>
                    
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home1">
                        <div class="">
                                    <div class="stats-buttons">
                                        <ul class="list-unstyled">
                                            <li style="float:left;">
                                                <a href="#" class="clearfix">
                                                    <span class="icon green"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $total_member12;?></span>
                                                    <span class="txt">Total User</span>
                                                </a>
                                            </li>
                                            
                                            <li style="float:left;">
                                                <a href="#" class="clearfix">
                                                    <span class="icon green"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $paid_member;?></span>
                                                    <span class="txt">Active User</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <span class="icon"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $ins_member;?></span>
                                                    <span class="txt">Inactive User</span>
                                                </a>
                                            </li>
<!--                                            <li>
                                                <a href="#" class="clearfix">
                                                    <span class="icon gray"><i class="icon24 i-coin"></i></span>
                                                    <span class="number"><?php echo $all_free;?></span>
                                                    <span class="txt">Free User</span>
                                                </a>
                                            </li>-->
                                        </ul>
                                    </div><!-- End .stats-buttons  -->
                                    <div class="clearfix"></div>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="profile1">
                        <div class="">
                                    <div class="stats-buttons">
                                        <ul class="list-unstyled">
                                            <li style="float:left;">
                                                <a href="#" class="clearfix">
                                                    <span class="icon green"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $total_member1;?></span>
                                                    <span class="txt">Total User</span>
                                                </a>
                                            </li>
                                            <li style="float:left;">
                                                <a href="#" class="clearfix">
                                                    <span class="icon green"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $paid_member1;?></span>
                                                    <span class="txt">Active User</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <span class="icon"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $ins_member1;?></span>
                                                    <span class="txt">Inactive Member</span>
                                                </a>
                                            </li>
<!--                                            <li>
                                                <a href="#" class="clearfix">
                                                    <span class="icon gray"><i class="icon24 i-coin"></i></span>
                                                    <span class="number"><?php echo $all_free;?></span>
                                                    <span class="txt">Free User</span>
                                                </a>
                                            </li>-->
                                        </ul>
                                    </div><!-- End .stats-buttons  -->
                                    <div class="clearfix"></div>
                                </div>
                    </div>
                    
                    <div class="tab-pane fade" id="profile2">
                        <div class="">
                                    <div class="stats-buttons">
                                        <ul class="list-unstyled">
                                            <li style="float:left;">
                                                <a href="#" class="clearfix">
                                                    <span class="icon green"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $total_member2;?></span>
                                                    <span class="txt">Total User</span>
                                                </a>
                                            </li>
                                            <li style="float:left;">
                                                <a href="#" class="clearfix">
                                                    <span class="icon green"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $paid_member2;?></span>
                                                    <span class="txt">Active User</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <span class="icon"><i class="icon24 i-file-8"></i></span>
                                                    <span class="number"><?php echo $ins_member2;?></span>
                                                    <span class="txt">Inactive User</span>
                                                </a>
                                            </li>
<!--                                            <li>
                                                <a href="#" class="clearfix">
                                                    <span class="icon gray"><i class="icon24 i-coin"></i></span>
                                                    <span class="number"><?php echo $all_free;?></span>
                                                    <span class="txt">Free User</span>
                                                </a>
                                            </li>-->
                                        </ul>
                                    </div><!-- End .stats-buttons  -->
                                    <div class="clearfix"></div>
                                </div>
                    </div>
                </div>    
                                </div><!-- End .panel-body -->
                            </div><!-- End .widget -->  
                        </div>
                                    <!---------------------------  REGISTRATION STATISTIC END ----------------------------->       
                                </div>

<!--                   <div class="row">
       
                        
                        </div>-->
                    
   			           
                
                    
                   
                  
                </div> <!-- End .container-fluid  -->

        </section>
</aside>
</div>
<script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/conditionizr.min.js"></script>  

        <!--<script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/bootstrap/bootstrap.js"></script>-->  

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/core/nicescroll/jquery.nicescroll.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/core/jrespond/jRespond.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/jquery.genyxAdmin.js"></script>

        <!--<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url') ?>bootstrap-2.3.2.min.js"></script>

        <script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url') ?>bootstrap-multiselect.js"></script>-->

        <!-- Charts plugins -->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/jquery.flot.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/jquery.flot.pie.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/jquery.flot.resize.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/jquery.flot.tooltip.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/jquery.flot.orderBars.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/jquery.flot.time.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/sparklines/jquery.sparkline.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/flot/date.js"></script> <!-- Only for generating random data delete in production site-->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/pie-chart/jquery.easy-pie-chart.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/gauge/justgage.1.0.1.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/charts/gauge/raphael.2.1.0.min.js"></script>



        <!-- Form plugins -->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/uniform/jquery.uniform.min.js"></script>


        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/validation/jquery.validate.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/select2/select2.js"></script> 

        <!-- Misc plugins -->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/misc/fullcalendar/fullcalendar.min.js"></script>

        <!-- UI plugins -->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/ui/jgrowl/jquery.jgrowl.min.js"></script>

        <!-- Init plugins -->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/app.js"></script><!-- Core js functions -->


        <!--    Text editor js-->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/autosize/jquery.autosize-min.js"></script>



        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/inputlimit/jquery.inputlimiter.1.3.min.js"></script>



        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/mask/jquery.mask.min.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/spectrum/spectrum.js"></script><!--  Color picker -->

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/multiselect/ui.multiselect.js"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/forms/tinymce/tinymce.min.js"></script>



        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

        <script src="<?php echo $this->config->item('admin_theme_url') ?>scripts/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
