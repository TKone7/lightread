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
        <div class="donate-right" >
            <button id="donate" onclick="donate()"  class="btn btn-primary text-uppercase font-weight-bold mb-2"style="border-radius: 50px;display: none" type="submit">
                Donate
            </button>
            <button onclick="incDonation()" id="donate_plus" class="btn btn-primary btn-circle btn-circle-xl m-1"><i class="glyphicon glyphicon-flash"></i></button>

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
                            <button id="btnpay" onclick="pay()" class="btn btn-primary" type="button" data-target="#payinvoice" data-toggle="modal">Read on for <?php echo $content->getPrice(); ?> Sats (<?php echo $content->getPriceFiat(); ?>)</button>

                        </div>
                    <?php endif; ?>
                        <div id="output" style="display: none">
                            <div class="text-center clearfix">
                                <input name="pay_req" class="form-control" type="text" id='response' readonly style="width: 100%;">
                                <a id="wallet" href=""> <div id="qr"></div></a>

                                <br>
                                <span id="paid"></span>
                            </div>
                        </div>
                        <div id="donationinfo" class="alert" style="display: none">

                        </div>
                    </div>

            </div>
        </div>
    </article>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        // global variable to increase donation
        var curr_val = 0;

        $(document).ready(function() {

            $('#donate').click(function(){
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                return false;
            });

        });

        function incDonation(){
            var el     = $('#donate_plus'),
                newone = el.clone(true);
            el.before(newone);
            el.remove();
            newone.children('.glyphicon-flash').addClass('animate-donate');
            // upper limit for donations
            if (curr_val < 200000){
                curr_val = curr_val + 500;
            }
            $('#donate').show();
            $('#donate').html('Donate ' + curr_val + ' sats');

        }

        function pay(){
            $("#btnpay").hide();
            $("#output").show();
            requestInvoice(null,function () {
                window.location.reload();
            })
        }
        
        function donate(){
            $("#donate").hide();
            $("#donationinfo").hide();
            $("#output").show();
            $('#paid').text("");

            requestInvoice(curr_val,function () {
                $("#donationinfo").addClass('alert-success')
                $('#donationinfo').html('<b>Invoice paid</b> <br>Thank you for the donation.');
                $("#donationinfo").show();
                $("#output").hide();
            })
            curr_val = 0;
        }

        function requestInvoice(donationamount, callback){
            $("#qr").text("");
            $("#response").val("Please wait while invoice is generated...")

            $.ajax({
                type: 'POST',
                url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/geninvoice',
                data: (donationamount === null) ? {ajax: 1,content_id: <?php echo $content->getId(); ?>} : {ajax: 1,content_id: <?php echo $content->getId(); ?>,donation: donationamount},
                dataType: "json",
                success: function(data, textStatus){
                    console.log(textStatus);
                    $('#response').val(data.payreq);
                    $('#wallet').attr("href", "lightning:" + data.payreq);
                    $("#qr").qrcode({render:'canvas',text: data.payreq});

                    // start
                    (function poll(){
                        setTimeout(function(){
                            var pay_req = $('#response').val();
                            $('#paid').text("start polling...");
                            $.ajax({
                                type: 'POST',
                                url: '<?php  echo $GLOBALS["ROOT_URL"]; ?>/checkinvoice',
                                data: {ajax: 1,pay_req: pay_req},
                                dataType: "json",
                                success: function(response){
                                    $('#paid').text(response.text);
                                    if (response.paid){
                                        callback();
                                    }else {
                                        poll();
                                    }
                                }
                            });
                        }, 1000);
                    })();

                }
            });



        }

    </script>
