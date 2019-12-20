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
            <div class="text-center clearfix" style="display: flex;">
              <div style="float:left;margin:20px;width:50%;">
                <div class="form-group">
                    <h2>Lightning Invoice</h2>
                    <input id="pay_req" name="pay_req" class="form-control" type="text" placeholder="lnbc..." style="display:block;margin:0 auto">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" onclick="sendPayReq()" style="display:block;margin:0 auto;max-width:200px">Withdraw</button>
                </div>
                <div id="pralert" class="alert" style="display: none">

                </div>
              </div>
                <hr>
              <div style="float:left;margin:20px;flex: 1;">
                <div class="form-group">
                    <h2>LNURL</h2>
                    <input min="1" max="<?php echo $user->getBalance() ?>" id="amount" name="amount" class="form-control" type="number" placeholder="1 - <?php echo $user->getBalance() ?> sats" style="display:block;margin:0 auto">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" onclick="reqLnUrl()" style="display:block;margin:0 auto;max-width:200px">Withdraw</button>
                    <div style="margin-top: 50px" id="qr"></div>
                </div>
                <div id="lnurlalert" class="alert" style="display: none">

                </div>
              </div>

            </div>
        </div>
    </div>
</div>
<script>

    function sendPayReq(){
        var pay_req = $('#pay_req').val();
        $("#pralert").show();
        $("#pralert").removeClass('alert-success')
        $("#pralert").removeClass('alert-warning')
        $("#pralert").addClass('alert-info')
        $('#pralert').html('Please wait while we try to pay the invoice: <br>' + pay_req);

        $.ajax({
            type: 'POST',
            url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/withdraw',
            data: {ajax: 1,pay_req:pay_req},
            dataType: "json",
            success: function(response){
                if(response.result){
                    $("#pralert").show();
                    $("#pay_req").val('');
                    $("#pralert").removeClass('alert-warning')
                    $("#pralert").removeClass('alert-info')
                    $("#pralert").addClass('alert-success')
                    $('#pralert').html('<b>Invoice paid</b> <br>Memo: ' + response.memo + '<br>Amount: ' + response.amount + ' sats');
                }else{
                    $("#pralert").show();
                    $("#pralert").removeClass('alert-success')
                    $("#pralert").removeClass('alert-info')
                    $("#pralert").addClass('alert-warning')
                    $('#pralert').html(response.msg);
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
                if(response.result){
                    $("#qr").empty();
                    $("#qr").qrcode({render: 'canvas', text: response.lnurl});
                    $("#lnurlalert").hide();
                    $("#lnurlalert").removeClass('alert-warning')
                    $("#lnurlalert").removeClass('alert-info')
                    $("#lnurlalert").removeClass('alert-success')
                }else{
                    $("#qr").empty();
                    $("#lnurlalert").show();
                    $("#lnurlalert").removeClass('alert-success')
                    $("#lnurlalert").removeClass('alert-info')
                    $("#lnurlalert").addClass('alert-warning')
                    $('#lnurlalert').html(response.msg);
                }

            }
        });
    }
</script>
