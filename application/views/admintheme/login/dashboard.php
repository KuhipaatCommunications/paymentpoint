<script type="text/javascript">
    function check_custom(val){ 
        if(val == "custom"){
            //document.getElementById('start_date').disabled = false;
            //document.getElementById('end_date').disabled = false;
            document.getElementById('st_date').style.display = "";
        } else {
            	document.getElementById('st_date').style.display = "none";
		document.getElementById('datepicker').value = "";
		document.getElementById('datepicker1').value = "";
        }
        
    }
</script>
 

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url().'admin/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
		<?php
		if($this->session->flashdata('message') && $this->session->flashdata('message')!="")
		{
		?>
			<div style="color:red; font-size:20px;"><?php echo $this->session->flashdata('message');?></div>
		<?php
		}
		?>
					<div class="box-header">
						<!--<h3 class="box-title" style="display:block;" id="leadMonthToDate">Lead Activity Month to Date</h3>-->
                                                <h3 class="box-title" style="display:block;" id="leadMonthToDate">Lead Activity Year to Date</h3>
					</div>
                    <!-- Small boxes (Stat box) -->
                    <div class="row dashboard-date-sec">
                                            
						<div class="col-lg-6 col-xs-6 pull-left dashboard-company-select" > 
                                                    
                                                            <form role="form" method="get" >
                                                            <input type="hidden" name="campDate" value="1">
                                                            <table width="40%" style="text-align: left;" cellpadding="5" cellspacing="" class="pull-left">
                                                                <tr>
                                                                    <td> <?php //echo $this->session->userdata('company'); //die;?>
                                                                        <label>Company</label> 
                                                                        <select class="form-control" name="campaign_id" id="campaign_id">
                                                                        <!-- <select class="form-control" name="company_id" id="company_id"> -->
                                                                        <option value="">Select</option>
                                                                        <?php foreach($getAllCompany as $keyCompany=>$companyVal){ 
										if(isset($access) && ($access=='all' || $access==$companyVal->id)){
										?>
		                                                                <option <?php if($companyVal->id==$this->session->userdata('company')){ echo 'selected';}?> value="<?php echo $companyVal->id.'-'.$companyVal->type; ?>" role="<?php echo $companyVal->type; ?>"><?php echo $companyVal->company_name; ?></option>
		                                                                <?php 
										}
									} ?> 
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            </form>
										
                                                                                
									
									
								<!-- /.3 -->
							
						<!-- /.12 -->
                                                    
                        <!-- changes made here -->
                        </div>
                        
                        <div class="col-lg-6 col-xs-6 pull-right" >                                                    
                                                    <div><h3>Cost/Lead:
							<?php 
							$costperlead=0;
							$totcostlead=$getAllAnsweredCallsData['answeredCalls']+$getAllGoodChatData['goodChatData']+$getAllGoodFormData['goodFormData'];
							if($totcostlead!="" && $totcostlead>0 && $getAllAdwordsLeadsCount>0)
								$costperlead=(($getAllBudgetData['budget']/$getAllAdwordsLeadsCount)/1000000)/$totcostlead;
							echo '$'.number_format($costperlead,2);?></h3>
						    </div>
                                                            <form role="form" method="get" >
                                                            <input type="hidden" name="campDate" value="1">
                                                            <table width="50%" cellpadding="5" cellspacing="" class="pull-right">
                                                                <tr>
                                                                	<td colspan="2">
									<?php //echo 'sdfdfg'.$this->session->userdata('time');?>
                                                                            <select name="created_at" id="created_at" onchange="check_custom(this.value);">
                                                                                <option value="">Select Lead Age</option>
                                                                                <option value="thisWeek" <?php if($this->session->userdata('time')=='thisWeek'){ echo 'selected';} ?>>This Week</option>
                                                                                <option value="thisMonth" <?php if($this->session->userdata('time')=='thisMonth'){ echo 'selected';} ?>>This Month</option>
                                                                                <option value="thisYear" <?php if($this->session->userdata('time')=='thisYear'){ echo 'selected';} ?>>This Year</option>
                                                                                <option value="lasWeek" <?php if($this->session->userdata('time')=='lasWeek'){ echo 'selected';} ?>>Last Week</option>
                                                                                <option value="lastMonth" <?php if($this->session->userdata('time')=='lastMonth'){ echo 'selected';} ?>>Last Month</option>
                                                                                <option value="lastYear" <?php if($this->session->userdata('time')=='lastYear'){ echo 'selected';} ?>>Last Year</option>
                                                                                <option value="custom" <?php if($this->session->userdata('time')=='custom'){ echo 'selected';} ?>>Custom</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr id="st_date" <?php if($this->session->userdata('time')=='custom'){?>style=""<?php }else{ ?>style="display: none;" <?php } ?>>
                                                                    <td>
                                                                        <input type="text" name="start_date" id="datepicker" class="form-control" placeholder="YYYY-MM-DD" value="<?php if(isset($start_date)) echo $start_date;?>" /> 
                                                                    </td> 
                                                                    <td>
                                                                       <input type="text" name="end_date" id="datepicker1" class="form-control" placeholder="YYYY-MM-DD" value="<?php if(isset($end_date)) echo $end_date;?>" />
                                                                    </td> 
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</td> 
                                                                    <td>
                                                                       <button type="submit" name="srch">Search</button>
                                                                    </td> 
                                                                </tr>
                                                            </table>	
                                                            </form>
								<!-- /.3 -->
							
						<!-- /.12 -->
						
                                                    
                        <!-- changes made here -->
                        </div>
                        
                    </div>   
                        
					<div class="row">
                    	<div class="box dashboard-top-sec">
                        	<!--<div class="box-header">
                            	<h3 class="box-title">Update</h3>
                            </div>-->
                            
                            <div class="box-body no-padding">
				<?php //if(isset($access) && ($access=='all' || $access==1)){?>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-aqua">
                                    	<span class="dashboard-icon calls"><i class="fa fa-phone"></i></span>
                                        <div class="inner">
                                            <h3>
                                                <?php echo $getAllCallLeadsCount; ?>
                                            </h3>
                                            <p>
                                               Calls
                                            </p>
                                        </div>
                                        <!--<a href="<?php echo base_url().'leads/1';?>" class="small-box-footer">-->
                                        <?php //if($type==1){?>
                                       <!--<a href="<?php echo base_url().'leads/exportCallLeads/'.$company_id;?>" class="small-box-footer">Export</a>-->
                                       <!--<a href="<?php echo base_url().'leads/fetchALead/'.$getCompanyId[0]->company_id.'/callrail';?>" class="small-box-footer">-->
                                        <?php //}else{ ?>
                                        <?php if($company_id == '' ){
											if($this->session->userdata('time') == ''){
											?>
												<a href="<?php echo base_url().'leads/calls/all';?>" class="small-box-footer">
												<?php //} ?>
													More info <i class="fa fa-arrow-circle-right"></i>
												</a>
											<?php
											}
											else
											{
											?>
												<a href="<?php echo base_url().'leads/new_calls';?>" class="small-box-footer">
												<?php //} ?>
													More info <i class="fa fa-arrow-circle-right"></i>
												</a>
                                        <?php
											}
                                        }
                                        else
                                        {
											if($this->session->userdata('time') == ''){
                                        ?>
												<a href="<?php echo base_url().'leads/calls/'.$company_id;?>" class="small-box-footer">
												
													More info <i class="fa fa-arrow-circle-right"></i>
												</a>
											<?php
											}
											else
											{
											?>
												<a href="<?php echo base_url().'leads/new_calls';?>" class="small-box-footer">
												<?php //} ?>
													More info <i class="fa fa-arrow-circle-right"></i>
												</a>
                                        <?php }
										}
										?>
                                    </div>
                        
                                	<table class="table table-striped">
                                    	<tr>
                                        	<th colspan="2" class="calls-title">Calls</th>
                                        </tr>
                                       <tr>
                                            <td>Leads</td>
                                            <td><?php 
						if($getAllCallsData['totalCalls'] > 0 ) {
						echo number_format((($getAllAnsweredCallsData['answeredCalls']/$getAllCallsData['totalCalls'])*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllAnsweredCallsData['answeredCalls'].')';?>
					    </td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Current Customer</td>
                                            <td><?php 
if($getAllCallsData['totalCalls'] > 0 ) {
echo number_format((($getAllExistingCustomerData['existingCustomer']/$getAllCallsData['totalCalls'])*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllExistingCustomerData['existingCustomer'].')';?></td>
                                        </tr>
                                         <tr>
                                            <td>Lost Opportunity</td>
                                            <td><?php 
                                            //echo $getLost." ".$getAllCallsData['totalCalls']; exit;
                                            if($getAllCallsData['totalCalls'] > 0 ) {
						
						echo number_format((($getLost/$getAllCallsData['totalCalls'])*100),2).'%' ;}else{ echo '0.00%';} echo ' ('.$getLost.')';?></td>
                                        </tr>
                                        <tr>
                                            <td>Unanswered</td>
                                            <td><?php 
						if($getAllCallsData['totalCalls'] > 0 )  {
						
						echo number_format((($getAllUnAnsweredCallsData/$getAllCallsData['totalCalls'])*100),2).'%' ;}else{ echo '0.00%';} echo ' ('.$getAllUnAnsweredCallsData.')';?>
					    </td>
                                        </tr>
                                        <tr>
                                            <td>Zero Calls</td>
                                            <td><?php 
						if($getAllCallsData['totalCalls'] > 0 ) {
						
						echo number_format((($zerocalls/$getAllCallsData['totalCalls'])*100),2).'%' ;}else{ echo '0.00%';} echo ' ('.$zerocalls.')';?>
					     </td>
                                        </tr>
                                    </table>  
                                </div>
				
                                <!-- 2nd -->
                                <div class="col-lg-3 col-xs-6">
                                	<div class="small-box bg-yellow">
                                    	<span class="dashboard-icon chats"><i class="fa fa-comments-o"></i></span>
                                        <div class="inner">
                                            <h3>
                                                <?php echo $getAllLivechatLeadsCount; ?>
                                            </h3>
                                            <p>
                                                Chats
                                            </p>
                                        </div>
                                        <!--<a href="<?php echo base_url().'leads/3';?>" class="small-box-footer">-->
                                        <?php //if($type==3){?>
                                        <!--<a href="<?php echo base_url().'leads/exportChatLeads/'.$company_id;?>" class="small-box-footer">Export</a>-->
                                        <!--<a href="<?php echo base_url().'leads/fetchALead/'.$getCompanyId[0]->company_id.'/live';?>" class="small-box-footer">-->
                                        <?php //}else{ ?>
                                        <?php if($company_id == '' ){
                                            if($this->session->userdata('time') == ''){    
                                        ?>
                                                <a href="<?php echo base_url().'leads/chats/all';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <a href="<?php echo base_url().'leads/new_chats';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            if($this->session->userdata('time') == ''){    
                                        ?>
                                                <a href="<?php echo base_url().'leads/chats/'.$company_id;?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <a href="<?php echo base_url().'leads/new_chats';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        <?php } 
                                        }
//echo $getAllLivechatLeadsCount.'***'.$getAllGoodChatData['goodChatData'].'***'.$getAllIncompleteChatData['incompleteChatData'];
                                        ?>
                                    </div>
                            
                                    <table class="table table-striped">
                                    	<tr>
                                        	<th colspan="2" class="chats-title">Chats</th>
                                        </tr>
                                        <?php //echo $getAllGoodChatData['goodChatData'].'***'.$getAllLivechatLeadsCount;?>
                                       <tr>
                                            <td>Sales</td>
                                            <td><?php if($getAllGoodChatData['goodChatData'] > 0 && $getAllLivechatLeadsCount > 0 ){ echo number_format((($getAllGoodChatData['goodChatData']/$getAllLivechatLeadsCount)*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllGoodChatData['goodChatData'].')';?></td>
                                            
                                        </tr>
                                        <?php //echo $getAllIncompleteChatData['incompleteChatData'];?>
                                         <tr>
                                            <td>Service</td>
                                            <td><?php if($getAllIncompleteChatData['incompleteChatData'] > 0 && $getAllLivechatLeadsCount > 0){ echo number_format((($getAllIncompleteChatData['incompleteChatData']/$getAllLivechatLeadsCount)*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllIncompleteChatData['incompleteChatData'].')';?></td>
                                        </tr>
                                        
					<tr>
                                            <td>Other</td>
                                            <td><?php if($getAllOtherChatData['otherChatData'] > 0 && $getAllLivechatLeadsCount > 0 ){ echo number_format((($getAllOtherChatData['otherChatData']/$getAllLivechatLeadsCount)*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllOtherChatData['otherChatData'].')';?></td>
                                        </tr>
                                    </table> 
                                </div>
                                <!-- 3rd -->
				
                                <div class="col-lg-3 col-xs-6">
                                	<div class="small-box bg-red">
                                    	<span class="dashboard-icon forms"><i class="fa fa-align-justify"></i></span>
                                        <div class="inner">
                                            <h3>
                                                <?php echo $getAllFormLeadsCount; ?>
                                            </h3>
                                            <p>
                                                Forms
                                            </p>
                                        </div>
                                        <?php //if($type==4){?>
                                       <!-- <a href="<?php echo base_url().'leads/exportFormLeads/'.$company_id;?>" class="small-box-footer">Export</a>-->
                                        <!--<a href="<?php echo base_url().'leads/fetchALead/'.$getCompanyId[0]->company_id.'/form';?>" class="small-box-footer">-->
                                        
                                            
                                <?php //***********************************************Important******************************** ?>
                                        
                                        <?php /*if($company_id == '' ){?>
                                        <a href="<?php echo base_url().'leads/forms/all';?>" class="small-box-footer">
                                            More info <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <a href="<?php echo base_url().'leads/forms/'.$company_id;?>" class="small-box-footer">
                                        
                                            More info <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                        <?php } */?>
                                        
                                <?php //***********************************************Important******************************** ?>        
                                     
                                        <?php if($company_id == '' ){
                                            if($this->session->userdata('time') == ''){    
                                        ?>
                                                <a href="<?php echo base_url().'leads/forms/all';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <a href="<?php echo base_url().'leads/new_forms';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            if($this->session->userdata('time') == ''){    
                                        ?>
                                                <a href="<?php echo base_url().'leads/forms/'.$company_id;?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <a href="<?php echo base_url().'leads/new_forms';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        <?php } 
                                        }
                                        ?>
                                        
                                    </div>
                            
                                    <table class="table table-striped">
                                    	<tr>
                                        	<th colspan="2" class="forms-title">Forms</th>
                                        </tr>
                                       <tr>
                                            <td>Sales</td>
                                            <td><?php if($getAllGoodFormData['goodFormData'] > 0 ){ echo number_format((($getAllGoodFormData['goodFormData']/$getAllFormLeadsCount)*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllGoodFormData['goodFormData'].')';?></td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Service</td>
                                            <td><?php if($getAllIncompleteFormData['incompleteFormData'] > 0 ){ echo number_format((($getAllIncompleteFormData['incompleteFormData']/$getAllFormLeadsCount)*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllIncompleteFormData['incompleteFormData'].')';?></td>
                                        </tr>
                                         <tr>
                                            <td>Other</td>
                                            <td><?php if($getAllOtherFormData['otherFormData'] > 0 ){ echo number_format((($getAllOtherFormData['otherFormData']/$getAllFormLeadsCount)*100),2).'%' ;}else{ echo '0%';} echo ' ('.$getAllOtherFormData['otherFormData'].')';?></td>
                                        </tr>
                                    </table> 
                                </div>
                                <!-- 4th -->
			
                                <div class="col-lg-3 col-xs-6">
                                	<div class="small-box bg-green">
                                    	<span class="dashboard-icon campaigns"><i class="fa fa-bullhorn"></i></span>
                                        <div class="inner">
                                            <h3>
                                                <?php echo $getAllAdwordsLeadsCount; ?><!--<sup style="font-size: 20px">%</sup>-->
                                            </h3>
                                            <p>
                                                Campaigns
                                            </p>
                                        </div>
                                        <!--<a href="<?php echo base_url().'leads/2';?>" class="small-box-footer">-->
                                        <?php //if($type==2){?>
                                        <!--<a href="<?php //echo base_url().'leads/exportAdwordsLeads/'.$company_id;?>" class="small-box-footer">Export</a>-->
                                        <!--<a href="<?php //echo base_url().'leads/fetchALead/'.$getCompanyId[0]->company_id.'/adwords';?>" class="small-box-footer">-->
                                        <?php //}else{ ?>
                                        <?php if($company_id == '' ){
                                            if($this->session->userdata('time') == ''){ 
                                        ?>
                                                <a href="<?php echo base_url().'leads/campaigns/all';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <a href="<?php echo base_url().'leads/new_campaigns';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        <?php
                                            }
                                        }
                                        else
                                        {
                                            if($this->session->userdata('time') == ''){ 
                                        ?>
                                                <a href="<?php echo base_url().'leads/campaigns/'.$company_id;?>" class="small-box-footer">

                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <a href="<?php echo base_url().'leads/new_campaigns';?>" class="small-box-footer">
                                                    More info <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        <?php }
                                        }
                                        ?>
                                    </div>
                            
                                    <table class="table table-striped">
                                    	<tr>
                                        	<th colspan="2" class="campaigns-title">Campaigns</th>
                                        </tr>
                                        <!--<tr>
                                            <td>CTR</td>
                                            <td><?php //if($getAllCtrData['ctr'] > 0 ){ echo number_format($getAllCtrData['ctr'],2)."%"; }else{ echo '0.00%';} ?></td>
                                            
                                        </tr>-->
                                        <?php //echo "xcfxgxgxgsx".$getTotalCostData['days']; exit;?>
                                        <tr>
                                            <td>Spend/day</td>
                                            <td><?php if($getTotalCostData['avgbudget'] > 0){ /*echo number_format((($getTotalCostData['cost']/$getTotalCostData['days'])/$getAllAdwordsLeadsCount));*/echo '$'.number_format(($getTotalCostData['avgbudget']/1000000),2); }else{ echo '0.00';} ?></td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Imp Share</td>
                                            <td><?php if($getAllImpressionData['impressions'] > 0 && $getAllAdwordsLeadsCount > 0 ){ echo number_format(($getAllImpressionData['impressions']/$getAllAdwordsLeadsCount)); }else{ echo '0.00';} ?></td>
                                        </tr>
                                        <?php /* ?>
                                        <tr>
                                            <td>Lost to Rank</td>
                                            <td><?php $rank = getRank();
                                            echo  number_format(($rank['rank']/$getAllAdwordsLeadsCount));
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td>Lost to Budget</td>
                                            <td><?php $rank = getBudget();
                                            echo  number_format(($rank['budget']/$getAllAdwordsLeadsCount));
                                            ?></td>
                                        </tr>
                                        <?php */ ?>
                                        <tr>
                                            <td>Cost</td>
                                            <td><?php if($getAllBudgetData['budget'] > 0 ){ echo '$'.number_format((($getAllBudgetData['budget']/$getAllAdwordsLeadsCount)/1000000),2); }else{ echo '0';} ?></td>
                                        </tr>
                                    </table> 
                                </div>
                                
                            </div><!-- /.box-body -->
                            </div><!-- /.box -->
                                            
                                            
                                            
                            <!-- LINE CHART -->
                            
			<?php if($type==1){ ?>
                            <!-- <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Call Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart" style="height: 300px;"></div>
                                </div>
                            </div>-->
                        
			<?php }else if($type==0){ ?>
                         <!--<div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Call Lead</h3>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="line-chart" style="height: 300px;"></div>
                            </div>
                         </div>-->
			
                        <?php } ?>
                        <?php if($type==2){?>
			
                       <!-- <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Adwords Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart-year-adwords" style="height: 300px;"></div>
                                </div>
                            </div>-->
			<?php }else if($type==0){ ?>
			
                        <!--<div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Adwords Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart-year-adwords" style="height: 300px;"></div>
                                </div>
                            </div>-->
                        <?php } ?>
                        <?php if($type==3){?>
					<!--	
                                                <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Chat Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart-year-chat" style="height: 300px;"></div>
                                </div>
                            </div>-->
						<?php }else if($type==0){ ?>
						
                                              <!--  <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Chat Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart-year-chat" style="height: 300px;"></div>
                                </div>
                            </div>-->
						<?php } ?>
						<?php if($type==4){?>
						
                                               <!-- <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart-year-form" style="height: 300px;"></div>
                                </div>
                            </div>-->
                        <?php }else if($type==0){ ?>
						
                                              <!--  <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Lead</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart-year-form" style="height: 300px;"></div>
                                </div>
                            </div>-->
                        <?php } ?>
                        
						
                    </div><!-- /.row -->
					
					
					<!--<div class="box-header">
							<h3 class="box-title" style="display:block;" id="leadYearToDate">Lead Activity Year to Date</h3>
						</div>-->
					<div class="row table-chart"> 
                                         <h3>Lead Time Line</h3>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                        <tr>
                                                                <th>Source</th>
                                                                <th>Type</th>
                                                                <th>Name</th>
                                                                <th>Phone</th>
                                                                <th>Date</th>
                                                                <th>City</th>
                                                                <th>Duration</th>
                                                                

                                                        </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
												
									
                                                        if(count($getAllCompanies)>0 && !empty($getAllCompanies) ){
                                                        foreach($getAllCompanies as $row){
                                                           
                                                ?>
                                                        <tr>
                                                                <td><?php echo $row['source_name'];?></td>
                                                                <td><?php echo $row['type'];?></td>
                                                                <td><?php if($row['name']){echo $row['name'];}else{echo "Not Found";}?></td>
                                                                <td><?php if($row['phone']){echo $row['phone'];}else{echo "Not Found";}?></td>
                                                                <td><?php if($row['created_at']){echo $row['created_at'];}else{echo "Not Found";}?></td>
                                                                <td><?php if($row['city']){echo $row['city'];}else{echo "Not Found";}?></td>
                                                                <td><?php if($row['duration']){echo $row['duration'];}else{echo "Not Found";}?></td>
                                                            
                                                        </tr>
                                                <?php }}
                                                else
                                                {
                                                    echo "No Data Found.";
                                                }
                                                ?>	

                                                </tbody>
                                                <tfoot>
                                                        <tr>
                                                               <th>Source</th>
                                                                <th>Type</th>
                                                                <th>Name</th>
                                                                <th>Phone</th>
                                                                <th>Date</th>
                                                                <th>City</th>
                                                                <th>Duration</th>
                                                                

                                                        </tr>
                                                </tfoot>
                                        </table>
                                            
                                        </div><!-- /.row -->
					
					
					

                    <!-- Main row -->
                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
var jq = jQuery.noConflict();
jq(function() {
jq( "#datepicker" ).datepicker({
    dateFormat: 'yy-mm-dd'
});
});
</script> 
<script>
var jq = jQuery.noConflict();
jq(function() {
jq( "#datepicker1" ).datepicker({
    dateFormat: 'yy-mm-dd'
});
});
</script>   
       
