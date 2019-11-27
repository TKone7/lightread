<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\User;

isset($this->user) ? $user = $this->user : $user = new User();

?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h1>Withdraw</h1>
            <p>You should regularly take back control of your funds by withdrawing them to your personal wallet. Only so, you
                take control of your earnings and lose dependency from our platform.</p>

            <p>Please paste a valid lightning invoice in the textfield below. Your maximum amount to withdraw is <?php echo $user->getBalance() ?> satoshis.
            <div class="text-center clearfix">
                <div class="form-group">
                    <input id="pay_req" name="pay_req" class="form-control" type="text" placeholder="lnbc..." style="display:block;margin:0 auto">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" onclick="sendPayReq()" style="display:block;margin:0 auto;max-width:200px">Withdraw</button>
                </div>
                <div id="success" class="alert" style="display: none">

                </div>
                <hr>

                <div class="form-group">
                    <input id="amount" name="amount" class="form-control" type="number" placeholder="1 - <?php echo $user->getBalance() ?> sats" style="display:block;margin:0 auto">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" onclick="reqLnUrl()" style="display:block;margin:0 auto;max-width:200px">Withdraw</button>
                    <div style="margin-top: 50px" id="qr"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>

    function sendPayReq(){
        var pay_req = $('#pay_req').val();
        $("#success").show();
        $("#success").removeClass('alert-success')
        $("#success").removeClass('alert-warning')
        $("#success").addClass('alert-info')
        $('#success').html('Please wait while we try to pay the invoice: <br>' + pay_req);

        $.ajax({
            type: 'POST',
            url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/withdraw',
            data: {ajax: 1,pay_req:pay_req},
            dataType: "json",
            success: function(response){
                if(response.result){
                    $("#success").show();
                    $("#pay_req").val('');
                    $("#success").removeClass('alert-warning')
                    $("#success").removeClass('alert-info')
                    $("#success").addClass('alert-success')
                    $('#success').html('<b>Invoice paid</b> <br>Memo: ' + response.memo + '<br>Amount: ' + response.amount + ' sats');
                }else{
                    $("#success").show();
                    $("#success").removeClass('alert-success')
                    $("#success").removeClass('alert-info')
                    $("#success").addClass('alert-warning')
                    $('#success').html(response.msg);
                }
            }
        });

    }
    function reqLnUrl() {
        var amount = $('#amount').val();

        $.ajax({
            type: 'POST',
            url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/withdraw',
            data: {ajax: 1, amount: amount},
            dataType: "json",
            success: function (response) {
                $("#qr").empty();
                $("#qr").qrcode({render: 'canvas', text: response.lnurl});
            }
        });
    }
</script>