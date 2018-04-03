<section id="features_ins">
  <!--<div class="inside">-->
  
  <div class="container">
    <div class="col-md-12 col-xs-12">
      <div class="formdesign col-md-5 col-sm-6 col-xs-12 pull-left hidden-xs">
        <h3>Channel Partner Application</h3>
          <p>Please fill in your details in the form below, and our representative will call you as soon as possible.</p>
        <div class="col-md-10 col-md-push-1">
          <div class="form">
         <?php if($this->session->flashdata('success_msg')){?>
            <div style="color:green;">
              <strong> <?php echo $this->session->flashdata('success_msg');?></strong>
            </div>
            <?php }  ?>

              
              <?php if($this->session->flashdata('error_msg')){?>
                <div style="color:red;">
                  <strong> <?php echo $this->session->flashdata('error_msg');?></strong>
                </div>
              <?php }  ?>
            </div>

          <div class="form">
          

             <div id="errormessage"></div>
            <form action="<?php echo base_url()?>lead/channelpartner" method="post" role="form" class="contactForm">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
             
            
            <div class="form-group">
                <input type="text" name="fname" class="form-control" id="fname" value="<?php echo set_value('fname');?>" placeholder="First Name" pattern="^[a-zA-Z]{2,50}$" title="First Name cannot be less than 2 characters and only letters allowed" maxlength="50" required />
                <div style="color:red"><?php echo form_error('fname');?></div>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" name="lname" class="form-control" id="lname" value="<?php echo set_value('lname');?>" placeholder="Last Name" pattern="^[a-zA-Z]{2,50}$" title="Last Name cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('lname');?></div>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter A Valid Email Address Containing '@' and '.' and after '.' cam have maximum 2 to 3 characters" />
                <div style="color:red"><?php echo form_error('email');?></div>
                <div class="validation"></div>
              </div>

               <div class="form-group">
                <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Mobile Number" pattern="[0-9]{10}" title="Contact Number should Contain Only Numbers and should be 10 characters long" maxlength="10" min="10" required />
                <div style="color:red"><?php echo form_error('contact_no');?></div>
                <div class="validation"></div>
              </div>

               <div class="form-group">
                <input type="text" name="otype" class="form-control" id="otype" value="<?php echo set_value('otype');?>" placeholder="Occupation" pattern="^[a-zA-Z]{2,50}$" title="Occupation cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('otype');?></div>
                <div class="validation"></div>
            </div>


             <div class="form-group">
                <input type="text" name="city" class="form-control" id="city" value="<?php echo set_value('city');?>" placeholder="City/town/village" pattern="^[a-zA-Z]{2,50}$" title="City cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('city');?></div>
                <div class="validation"></div>
            </div>
            
            <div class="form-group">
                <input type="text" name="pin" class="form-control" id="pin" value="<?php echo set_value('pin');?>" placeholder="Pincode" pattern="[0-9]{6}$" title="Pin should Contain only Number and should be 6 characters long" maxlength="6"  />
                <div style="color:red"><?php echo form_error('pin');?></div>
                <div class="validation"></div>
            </div>
            
            <div class="form-group">
                <input type="text" name="district" class="form-control" id="district" value="<?php echo set_value('district');?>" placeholder="District" pattern="^[a-zA-Z]{2,50}$" title="District cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('');?></div>
                <div class="validation"></div>
            </div>
            
             <div class="form-group">
                <input type="text" name="state" class="form-control" id="state" value="<?php echo set_value('state');?>" placeholder="State" pattern="^[a-zA-Z]{2,50}$" title="State cannot be less than 2 characters and only letters are allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('state');?></div>
                <div class="validation"></div>
            </div>
             
            <div class="form-group">
              <input type="hidden" class="form-control" name="form_type" value="channel_partner" id="form_type" placeholder="form_type" data-rule="minlen:4" data-msg="Please enter at least 6 Chars for State" />
            </div>

              <div class="text-center">
                
                  <button type="submit" class="submit_btn">Register With  Us</button>
              </div>

      
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-xs-12 content-rt">
        <h2>Become part of the Cashless Digital Payments Revolution</h2>
        
        <p>We invite applications from businesses, who are engaged in the retail distribution business for FMCG, Electricals, Durable Goods etc to become our channel partners. It requires minimal capital and is a service to the society in terms of increasing the reach of ATMs.<br />
          <br />
          Wisepad G2 is an EMV L1, L2 and PCI PTS approved mPOS device that not only enables the customer to buy products using debit / credit cards, but also allows cash withdrawal like an ATM. It works with Bluetooth and WIFI connectivity. It even has a SIM slot to work independently.</p>
          

          <div class="hidden-sm hidden-lg hidden-md"> <button type="submit" id="m-button" class="submit_btn" data-toggle="modal" data-target="#cform">Channel Partner Form</button></div> 
          <!-- Modal -->
 <div id="cform" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
     
      </div>
      <div class="modal-body" style="height: 100vh; overflow: auto;">
      <div class="formdesign col-xs-12 ">
        <h3>Channel Partner Application</h3>
          <p>Please fill in your details in the form below, and our representative will call you as soon as possible.</p>
        

        <div class="col-md-10 col-md-push-1">
          <div class="form">
         <?php if($this->session->flashdata('success_msg')){?>
            <div style="color:green;">
              <strong> <?php echo $this->session->flashdata('success_msg');?></strong>
            </div>
            <?php }  ?>

              
              <?php if($this->session->flashdata('error_msg')){?>
                <div style="color:red;">
                  <strong> <?php echo $this->session->flashdata('error_msg');?></strong>
                </div>
              <?php }  ?>
            </div>

          <div class="form">
                 

             <div id="errormessage"></div>
            <form action="<?php echo base_url()?>lead/channelpartner" method="post" role="form" class="contactForm">
            <input type="hidden" name="mobile_form" value="1">  
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
             
            
            <div class="form-group">
                <input type="text" name="fname" class="form-control" id="fname" value="<?php echo set_value('fname');?>" placeholder="First Name" pattern="^[a-zA-Z]{2,50}$" title="First Name cannot be less than 2 characters and only letters allowed" maxlength="50" required />
                <div style="color:red"><?php echo form_error('fname');?></div>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" name="lname" class="form-control" id="lname" value="<?php echo set_value('lname');?>" placeholder="Last Name" pattern="^[a-zA-Z]{2,50}$" title="Last Name cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('lname');?></div>
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter A Valid Email Address Containing '@' and '.' and after '.' cam have maximum 2 to 3 characters" />
                <div style="color:red"><?php echo form_error('email');?></div>
                <div class="validation"></div>
              </div>

               <div class="form-group">
                <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Mobile Number" pattern="[0-9]{10}" title="Contact Number should Contain Only Numbers and should be 10 characters long" maxlength="10" min="10" required />
                <div style="color:red"><?php echo form_error('contact_no');?></div>
                <div class="validation"></div>
              </div>

               <div class="form-group">
                <input type="text" name="otype" class="form-control" id="otype" value="<?php echo set_value('otype');?>" placeholder="Occupation" pattern="^[a-zA-Z]{2,50}$" title="Occupation cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('otype');?></div>
                <div class="validation"></div>
            </div>


             <div class="form-group">
                <input type="text" name="city" class="form-control" id="city" value="<?php echo set_value('city');?>" placeholder="City/town/village" pattern="^[a-zA-Z]{2,50}$" title="City cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('city');?></div>
                <div class="validation"></div>
            </div>
            
            <div class="form-group">
                <input type="text" name="pin" class="form-control" id="pin" value="<?php echo set_value('pin');?>" placeholder="Pincode" pattern="[0-9]{6}$" title="Pin should Contain only Number and should be 6 characters long" maxlength="6"  />
                <div style="color:red"><?php echo form_error('pin');?></div>
                <div class="validation"></div>
            </div>
            
            <div class="form-group">
                <input type="text" name="district" class="form-control" id="district" value="<?php echo set_value('district');?>" placeholder="District" pattern="^[a-zA-Z]{2,50}$" title="District cannot be less than 2 characters and only letters allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('');?></div>
                <div class="validation"></div>
            </div>
            
             <div class="form-group">
                <input type="text" name="state" class="form-control" id="state" value="<?php echo set_value('state');?>" placeholder="State" pattern="^[a-zA-Z]{2,50}$" title="State cannot be less than 2 characters and only letters are allowed" maxlength="50"  />
                <div style="color:red"><?php echo form_error('state');?></div>
                <div class="validation"></div>
            </div>
             
            <div class="form-group">
              <input type="hidden" class="form-control" name="form_type" value="channel_partner" id="form_type" placeholder="form_type" data-rule="minlen:4" data-msg="Please enter at least 6 Chars for State" />
            </div>

              <div class="text-center">
                
                  <button type="submit" class="submit_btn">Register With  Us</button>
              </div>

            </form>
          </div>
        </div>
      </div>
      </div>
     
    </div>

  </div>
</div>
<br/>
          <p class="text-strong">Significant Features:</p>
  <ul class="ol">
    <li> Accepts all cards including VISA, MasterCard, RuPay and AmEx</li>
    <li> Accepts all debit cards for Cash@POS cash withdrawal</li>
    <li> It can be connected to any bank account of any bank</li>
    <li>It comes with an Android Application for transaction & income reports</li>
    <li> Great battery life to do around 300 transactions on a single charge</li>
  </ul>
  <p>Download the <a href="<?php echo base_url().'uploads/Wisepad_G2_Factsheet.pdf';?>">fact sheet</a> to know more about the device.</p>
  <p class="text-strong"> Business Potential:</p>
  <p> As a channel partner, you can earn commission against device activation, monthly rent and daily cash@POS transaction. On an average, if you activate 500 mPOS devices, you may earn as much as Rs. 1 Lakhs rupees every month.</p>
  
      </div>
    </div>
  </div>
  </section>
  
  <?php
  if($this->session->userdata('m_form'))
  {
  ?>
    <script type="text/javascript">
      $(window).on('load', function(){
        $('#m-button').trigger('click');
      })
    </script>
 <?php
    $this->session->set_userdata('m_form', "");
  }
 ?>