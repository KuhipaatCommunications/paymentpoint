<section>
    <div id="container">
        <form name="merchant_form" action="<?php echo base_url()?>payment/pay" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="merchantId" value="PP5TST"><!--child merchant id provided by billdesk-->
            <input type="hidden" name="customerId" value="ppcm1234"><!--customer id provided by payment point-->
            <!--<input type="hidden" name="orderId" value="ord1234">--><!--order id of child merchant-->
            <input type="hidden" name="ru" value="http://localhost/ppuat/pg/payment/pay"><!--order id of child merchant-->
            
            <div>
                <input type="text" name="orderId" placeholder="Order Id">
            </div>

            <div>
                <input type="text" name="payeeFirstname" placeholder="First Name">
            </div>
            <div>
                <input type="text" name="payeeLastname" placeholder="Last Name">
            </div>
            <div>
                <input type="text" name="payeeEmail" placeholder="Email Id">
            </div>
            <div>
                <input type="text" name="payeeMobile" placeholder="Mobile No">
            </div>
            <div>
                <input type="text" name="txnAmount" placeholder="Amount">
            </div>
            <div>
                <input type="submit" name="submit" value="submit">
            </div>
        </form>
    </div>
</section>