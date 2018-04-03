
  <!--==========================
  Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
       <!-- <div class="hero-logo">
          <img class="" src="img/logo.png" alt="Imperial">
        </div>-->

     
        <h2><span class="maintext">Payment is necessary: </span><span class="rotating">Going to a bank isn't, Writing a Cheque isn't, Collection is as well</span></h2>
        <div class="actions">
          <a href="#about" class="btn-get-started">know more</a>
          <!--<a href="#services" class="btn-services">Our Services</a>-->
        </div>
      </div>
    </div>
  </section>

  <!--==========================
  About Section
  ============================-->
  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Who we are</h3>
          <div class="section-title-divider"></div>
          <p>PaymentPoint<sup>TM</sup> is an initiative by Kuhipaat Communication and Technology Pvt. Ltd, to provide easy & inclusive payments solutions in the Northeast of India.</p> <p>We plan to launch payments and collection services through mPOS device, smartcard, android application and a browser based web application. The mPOS device will enable debit card cash withdrawals in regions where there are no ATMs, as well as card based cashless sale transactions. We have tied up with Mswipe Technologies Limited, one of India's largest mPOS merchant acquirer & network provider to facilitate
 these services in Assam and Northeast. We have also tied up with one of the biggest payments enabler IndiaIdeas.com Ltd.(BillDesk) to provide an easy website based and android app based payments and collection services.<br />
<br />

 
Kuhipaat is based out of a small town, Duliajan in the district of Dibrugarh, Assam. One of the strategic intention is to create high skilled jobs in regions outside the concept of big cities and metros. The operations management for the financial services will be executed from its branch office in Duliajan.
 <br />
<br />

Our Director, Mr. Durlov Baruah has intensive experience in the digital banking domain with over 10 years of hands-on experience. He was heading the Internet Banking team at Deutsche Bank PBC India before deciding to venture out on his own. Prior to that, he was working at ICICI Bank in the International Banking Group handling ICICI Bank Canada / Online remittances marketing strategy & operations. Our business head for the POS and Card business, Mr. Arindam Majumder brings in extensive experience in terms of distribution network & customer service.
 </p>
 <!--<div class="text-center primary_btn"><button type="submit">Know more details</button></div>-->
        </div>
      </div>
    </div>
   
  </section>

  <!--==========================
  Services Section
  ============================-->
  <section id="features">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title" style="color:#fff">How we help</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Earn as you help people with payments and collections</p>
        </div>
      </div>

      <!---->
      <div class="container about-container wow fadeInUp">
      <div class="row">
  <!--    <div class="col-md-6 about-content">
        <img src="img/mswipe-left.png" width="460" ></div>-->
        <div class="col-md-6 about-content pull-left">
         <h2 class="about-title"></h2>
          <p class="about-text">
          We have tied up with Mswipe Technologies to offer a host of payment services and cash withdrawal services through their proprietary m-POS device. Currently, a card holder can pay or withdraw cash using this device. Shortly, we will launch more services onto the device for convenience of the card holders and for business opportunities for the device holder. We invite channel partners to distribute in the Northeast. Interested merchants / parties can write to us at enquiry@kuhipaat.in for a demo of the device.
          </p>
          <div class="col-sm-6">
                <div class="text-box">
                  <h4 class="upper small-heading"><a href="#">mPOS</a></h4>
                  <p>To enable cash withdrawal, cashless sale through debit / credit cards. Merchants will earn by enabling cash withdrawal in rural areas.</p>
                </div>
                <!-- end of text box-->
              </div>
              <div class="col-sm-6">
                <div class="text-box">
                  <h4 class="upper small-heading"><a href="#">Prepaid Card</a></h4>
                  <p>To enable a cashless society, this card will not only be an identity card, but also a prepaid card for students, employees and any closed group.</p>
                </div>
                <!-- end of text box-->
              </div>
              </p>
          <div class="col-sm-6">
                <div class="text-box">
                  <h4 class="upper small-heading"><a href="#">Bill Payments</a></h4>
                  <p>This website will enable payments of bills of electricity, DTH, mobile, insurance etc through a simple registration process</p>
                </div>
                <!-- end of text box-->
              </div>
              <div class="col-sm-6">
                <div class="text-box">
                  <h4 class="upper small-heading"> <a href="#">Online Payments</a></h4>
                  <p>TAny individual or business can collect payments online from its consumers using PaymentPoint website or android application</p>
                </div>
                <!-- end of text box-->
              </div>
              
                <!--<div class="text-center primary_btn"><button type="submit">Know more details</button></div>-->
        </div>
      </div>
    </div>
    </div>
  </section>

 
  
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contact Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">We are happy to hear from you</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-md-push-2">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Kuhipaat Communications & Technology Pvt.Ltd<br>
First Floor,<br>
Near SIRD, Tipling<br>
Duliajan-786602, Assam<br>
</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>info@paymentpoint.in</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+91 8472086357</p>
            </div>

          </div>
        </div>

        <div class="col-md-5 col-md-push-2">
          
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

            <div id="errormessage"></div>
            <form action="<?php echo base_url()?>home/contactus" method="post" role="form" class="contactForm">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="form-group">
                <input type="text" name="fname" class="form-control" id="fname" value="<?php echo set_value('fname');?>" placeholder="First Name" pattern="^[a-zA-Z]{2,50}$" title="First Name cannot be less than 2 characters and only letters allowed" maxlength="50" required />
                <div style="color:red"><?php echo form_error('fname');?></div>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" pattern="^[a-zA-Z]{2,30}$" title="Last Name cannot be less than 2 characters and only letters allowed" maxlength="30" required />
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
                <!-- <input type="text" class="form-control" name="form_type" value="contactus" id="form_type" placeholder="form_type" data-rule="minlen:4" data-msg="Please enter at least 6 Chars for State" /> -->
            
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" pattern="^[a-zA-Z][a-zA-Z0-9-, ]{1,250}$"
                                                 title="Message should not be greater than 250 characters and should have only numbers and letters with ',' allowed" required placeholder="Write You Query"></textarea>
                <div style="color:red"><?php echo form_error('message');?></div>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>