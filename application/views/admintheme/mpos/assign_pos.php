<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">


    <section class="content">

       <form role="form" method="post" name="add_pos" id="add_pos" action="" enctype="multipart/form-data">

      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">

             <?php if($this->session->flashdata('error_msg')!=''){ ?>
                                            <div class="form-group has-error">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('error_msg');?></label>
                                            </div>
                          <?php } ?>

                          <?php if($this->session->flashdata('success_msg')!=''){ ?>
                                            <div class="form-group has-success">
                                                <label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> <?php echo $this->session->flashdata('success_msg');?></label>
                                            </div>
                                    <?php } ?>



        <div class="form-group">

                 <label for="exampleInputEmail1">Enter Device Number</label>

                  <!-- <input type="text" name="device_no" placeholder="Enter device Number"> -->
                  <select class="form-group" name="device_no">
                    <option value="">Select Device No </option>
                    <?php foreach ($unassign_pos as $row) { ?>
                      <option value="<?php echo $row['device_no'] ;?>"><?php echo $row['device_no'] ;?> </option>
                    <?php } ?>
                  </select>
        </div>

            <span style="color:red;"><?php echo form_error('device_no');?></span>


            <div class="form-group">

                     <label for="exampleInputEmail1">Enter Plan Name</label>

                      <input type="text" name="plan_name" placeholder="Enter Plan Number">

            </div>

                <span style="color:red;"><?php echo form_error('plan_name');?></span>

                <div class="form-group">

                         <label for="exampleInputEmail1">Enter Plan Amount </label>

                          <input type="text" name="plan_amount" placeholder="Enter plan amount">

                </div>
                    <span style="color:red;"><?php echo form_error('plan_amount');?></span>


    <button type="submit" class="btn btn-primary" name="add_pos">Save</button>

    </form>

  </section>

  </aside>

</div>
