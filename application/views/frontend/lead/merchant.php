<section id="features_ins">
  <!--<div class="inside">-->
  
  <div class="container">
    <div class="col-md-12 col-xs-12">
      <div class="formdesign col-md-5 col-sm-6 col-xs-12 pull-left hidden-xs">
      <h3>Merchant Application</h3>
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
            <form action="<?php echo base_url()?>lead/merchant" method="post" role="form" class="contactForm">
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
              <input type="hidden" class="form-control" name="form_type" value="merchant" id="form_type" placeholder="form_type" data-rule="minlen:4" data-msg="Please enter at least 6 Chars for State" />
            </div>

              <div class="text-center">
                
                  <button type="submit" class="submit_btn">Register With  Us</button>
              </div>
            
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-xs-12 content-rt">
        <h3>Become digital. Be our merchant.</h3>
          <p>Today, it has become essential for any business to accept debit and credit cards to sell products and services. With RBI making the charge (MDR) zero for debit card transactions below Rs. 2000/-, it is the right time to go digital. It is the right time to get a mPOS machine in your shop.<br />
<br />


Our mPOS device accepts all debit and credit cards and runs on a SIM card, WIFI or via Bluetooth. Credit card acceptance will increase your business as customers get credit for a month along with EMI benefits. He can convert a costly purchase into monthly payments as is provided by the credit card issuer bank.<br />
<br />


The device also helps in the withdrawal of cash like a mini ATM. You can give cash back to the customer over and above the purchase amount if the customer wants cash, earning a decent commission from it. It accepts all major debit cards.</p>
        <p class="text-strong">Other benefits:</p>
        <ul><li>  It is a portable device that can be carried in the pocket. Enough battery to do 300 card swipes.</li>

        <li> It can be connected to any bank account of any bank</li>

       <li> It gives SMS receipts of the purchase to the customers reducing the use of paper</li>
          <li>It comes with an Android application to monitor all transactions and cash@POS income</li></ul>

      <p><a href="<?php echo base_url().'uploads/Wisepad_G2_Factsheet.pdf';?>"> Download the fact sheet</a> to know more about the device.</p>
        
         <div class="hidden-sm hidden-lg hidden-md"> <button type="submit" id="m-button" class="submit_btn" data-toggle="modal" data-target="#cform">Merchant Form</button></div> 
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
      <h3>Merchant Application</h3>
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
            <form action="<?php echo base_url()?>lead/merchant" method="post" role="form" class="contactForm">
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
              <input type="hidden" class="form-control" name="form_type" value="merchant" id="form_type" placeholder="form_type" data-rule="minlen:4" data-msg="Please enter at least 6 Chars for State" />
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