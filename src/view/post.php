<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Content;
use services\ContentServiceImpl;

isset($this->body)?$body=$this->body:$body="Article not found";
isset($this->content)?$content=$this->content:$content=new Content();
isset($this->restricted)?$restricted=$this->restricted:$restricted=false;

?>
<article>
    <?php if(!$restricted): ?>
        <div  style="z-index:100;position:fixed;bottom:100px;right:100px;margin:0;padding:5px 3px;">
            <button id="donate" onclick="donate()"  class="btn btn-primary text-uppercase font-weight-bold mb-2"style="border-radius: 50px;display: none" type="submit">
                Donate
            </button>
            <button onclick="incDonation()" id="donate_plus" class="btn btn-primary btn-circle btn-circle m-1"><i class="glyphicon glyphicon-flash"></i></button>

        </div>
    <?php endif; ?>

    <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <div>
                    <p><?php echo $body; ?></p>
                    <?php if($restricted): ?>
                        <div class="hiding"></div>
                    <?php endif; ?>
                    </div>
                    <?php if($restricted): ?>
                        <div class="text-center clearfix">
                            <button id="btnpay" onclick="myFunc()" class="btn btn-primary" type="button" data-target="#payinvoice" data-toggle="modal">Read on for <?php echo $content->getPrice(); ?> Sats (<?php echo $content->getPriceFiat(); ?>)</button>

                        </div>
                    <?php endif; ?>
                        <div id="output" style="display: none">
                            <div class="text-center clearfix">
                                <input name="pay_req" class="form-control" type="text" id='response' readonly style="width: 100%;">
                                <a id="wallet" href=""> <div id="qr"></div></a>
                                <!--
                                don't need button since we do polling
                                <button onclick="checkPayment()" class="btn btn-primary" type="button" >check payment</button>
                                -->
                                <br>
                                <span id="paid"></span>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </article>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        var curr_val = 0;

        function incDonation(){
            curr_val = curr_val + 500;
            $('#donate').show();
            $('#donate').html('Donate ' + curr_val + ' sats');

        }

            function checkPayment(){
            var pay_req = $('#response').val();
            $('#paid').text("hold on, we check your payment...");

            $.ajax({
                type: 'POST',
                url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/checkinvoice',
                data: {ajax: 1,pay_req: pay_req},
                success: function(response){
                    $('#paid').text(response);
                    if (response=='Status: payment successful'){
                        window.location.reload();
                    }
                }
            });
        }

        function donate(){
            $('html, body').animate({ scrollTop: $("#output").offset().top}, 500);

            $("#donate").hide();

            myFunc(curr_val)

        }

        function myFunc(){

            var name = $('#name').val();
            var pay_req = "";
            $("#qr").text("");
            $("#response").val("Please wait while invoice is generated...")
            $.ajax({
                type: 'POST',
                url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/geninvoice',
                data: (arguments.length == 0) ? {ajax: 1,content_id: <?php echo $content->getId(); ?>} : {ajax: 1,content_id: <?php echo $content->getId(); ?>,donation: arguments[0]},
                dataType: "json",
                success: function(response){
                    pay_req=response.payreq;
                    $('#response').val(response.payreq);
                    $('#wallet').attr("href", "lightning:" + response.payreq);
                    $("#qr").qrcode({render:'canvas',text: response.payreq});
                }
            });
            $("#output").show();
            $("#btnpay").hide();

            // start
            (function poll(){
                setTimeout(function(){
                    var pay_req = $('#response').val();
                    $('#paid').text("start polling...");
                    $.ajax({
                        type: 'POST',
                        url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/checkinvoice',
                        data: {ajax: 1,pay_req: pay_req},
                        success: function(response){
                            $('#paid').text(response);
                            if (response=='Status: payment successful'){
                                window.location.reload();
                            }
                            poll();
                        }
                    });
                }, 8000);
            })();


        }

    </script>
