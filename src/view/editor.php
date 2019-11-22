<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Access;
use domain\Content;
use services\MarketDataServiceImpl;

$load = isset($this->content);
(isset($this->content)) ? $content = $this->content : $content = new Content();
?>
<div class="container">
        <div class="row articlerow">
            <div class="col-md-10 col-lg-8 mx-auto">
                <h1>Let's put it down</h1>
                <div class="container">
                    <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/publish">
                        <input type="hidden" name="id" value="<?php echo $load ? $content->getId() : ""; ?>">

                        <div class="form-group">
                            <input name="title" class="form-control" type="text" placeholder="Title" style="margin-bottom:10px" value="<?php echo $load ? $content->getTitle() : ""; ?>" required>
                            <input name="subtitle" class="form-control" type="text" placeholder="Subtitle" style="margin-bottom:10px" value="<?php echo $load ? $content->getSubtitle() : ""; ?>">
                            <textarea class="form-control" id="summernote" name="editordata" placeholder="Your story...." style="min-height:200px"><?php echo $load ? $content->getBody() : ""; ?></textarea>
                        </div>
                        <div style="display:inline-block">
                            <input id="price" name="price" class="form-control" type="number" placeholder="Price (in Satoshi)" style="margin-bottom:10px;text-align:right;display:inline-block;width: inherit;" min="0" max="1000000" value="<?php echo $load ? $content->getPrice() : ""; ?>"><span style="margin-left:10px;">sats</span>
                            <span id="fiat" > ~<?php echo $load ? $content->getPriceFiat() : ""; ?></span>
                        </div>
                        <input name="btcprice" id="btcprice" type="hidden" value="<?php echo $load ? MarketDataServiceImpl::getInstance()->getPrice() : ""; ?>" readonly>
                        <div class="form-group">
                            <button formaction="<?php echo $GLOBALS["ROOT_URL"]; ?>/preview" class="btn btn-light" type="submit">Store & Preview</button>
                            <button class="btn btn-primary" type="submit">Publish</button>
                        </div>
            </form>
        </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function (){
                        $('#price').on('input',function(e){
                            var val = $('#price').val();
                            var btcprice = $('#btcprice').val();
                            var satprice = btcprice / 100000000;
                            var usdval = satprice * val;
                            if (usdval<1){
                                usdval = usdval * 100;
                                usdval = Math.floor(usdval);
                                $('#fiat').text('~' + usdval  + ' cts.');
                            }else{
                                $('#fiat').text('~' + (usdval).toFixed(2) + ' $');
                            }
                        });
                    });

                </script>
    </div>
    </div>
    </div>
