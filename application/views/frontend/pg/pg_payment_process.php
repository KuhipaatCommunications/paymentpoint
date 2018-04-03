<section>
    <div id="container">
        <div><h3>Please wait...while it is redirecting to Payment Page</h3></div>
        <form name="pg_payment_process" id="pg_payment_process" action="<?php echo $bd_url;?>" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="msg" value="<?php echo $msg;?>">
        </form>
    </div>
</section>
<script type="text/javascript">
    $(window).on('load', function(){
        setTimeout(function(){$("#pg_payment_process").submit()}, 3000);
    })
</script>