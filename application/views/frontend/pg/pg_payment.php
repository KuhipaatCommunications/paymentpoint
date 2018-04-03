<section>
    <div id="container">
        <form name="merchant_form" id="merchant_form" action="<?php echo base_url()?>payment/paymentProcessing" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="msg" value="<?php echo $msg;?>">
        </form>
    </div>
</section>
<script type="text/javascript">
    $(window).on('load', function(){
        $("#merchant_form").submit();
    })
</script>