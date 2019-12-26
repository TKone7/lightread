<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Access;
use domain\Category;
use domain\Content;
use domain\Keyword;
use services\MarketDataServiceImpl;
use validator\ContentValidator;

$load = isset($this->content);
(isset($this->content)) ? $content = $this->content : $content = new Content();
(isset($this->categories)) ? $categories = $this->categories: array(new Category());
(isset($this->contentValidator)) ? $contentValidator = $this->contentValidator : $contentValidator = new ContentValidator();
(isset($this->keywordvalues)) ? $keywordvalues = $this->keywordvalues: "";
(isset($this->keywordsuggestions)) ? $keywordsuggestions = $this->keywordsuggestions: "";
?>

<div class="container">
        <div class="row articlerow">
            <div class="col-md-10 col-lg-8 mx-auto">
                <h1>Let's put it down</h1>
                <div class="container">
                    <?php if($contentValidator->isUserVerifiedError()): ?>
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> <?php echo $contentValidator->getUserVerifiedError() ?>
                        </div>
                    <?php endif; ?>
                    <?php if($contentValidator->isCategorySetError()): ?>
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> <?php echo $contentValidator->getCategorySetError() ?>
                        </div>
                    <?php endif; ?>
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
                            <select name="category" id="inputCategory" class="form-control">
                                <option <?php echo !$load ? 'selected': '' ?>>Choose a category...</option>
                                <?php foreach ($categories as $category) {?>
                                    <?php
                                    if ($load AND !empty($content->getCategory())){
                                        $selected = $content->getCategory()->getId()==$category->getId();
                                    }else{
                                        $selected = false;
                                    }
                                    ?>
                                    <option value="<?php echo $category->getId(); ?>" <?php echo $selected ? 'selected' : '' ?> > <?php echo $category->getName(); ?></option>

                                <?php } ?>

                            </select>
                        </div>


                        <div class="form-group">
                            <div class="amsify-suggestags-input">
                                <input name="keywords" type="text" class="form-control" value="<?php echo $keywordvalues ?>" placeholder="Give up to 6 tags" />
                            </div>
                        </div>


                        <div class="form-group">
                            <button formaction="<?php echo $GLOBALS["ROOT_URL"]; ?>/preview" class="btn btn-light" type="submit">Store as draft</button>
                            <button class="btn btn-primary" type="submit">Publish</button>
                        </div>
            </form>
        </div>
    </div>
    </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
                $('#fiat').text('~¢' + usdval);
            }else{
                $('#fiat').text('~$' + (usdval).toFixed(2));
            }
        });

        $('input[name="keywords"]').amsifySuggestags({
            suggestions: <?php echo $keywordsuggestions ?>,
            tagLimit: 6
        });

    });



</script>