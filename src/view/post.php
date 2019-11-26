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
                    <?php endif; ?>
                    </div>

            </div>
        </div>
    </article>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
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

        function myFunc(){
            var name = $('#name').val();
            var pay_req = "";
            $("#response").val("Please wait while invoice is generated...")
            $.ajax({
                type: 'POST',
                url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/geninvoice',
                data: {ajax: 1,content_id: <?php echo $content->getId(); ?>},
                dataType: "json",
                success: function(response){
                    pay_req=response.payreq;
                    $('#response').val(response.payreq);
                    $('#wallet').attr("href", "lightning:" + response.payreq);
                    $("#qr").qrcode({render:'canvas',text: response.payreq});
                    //$('#paid').text("Status: unpaid");
                    // poll();
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
