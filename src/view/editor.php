<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Access;
use domain\Content;

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
                        <div class="form-check">
                            <input name="paid" class="form-check-input" type="checkbox" id="formCheck-1" <?php echo ($load and $content->getAccess()==Access::PAID()) ?  " checked='checked' " : ""; ?>><label class="form-check-label" for="formCheck-1">Paid article?</label>
                        </div>
                        <input name="price" class="form-control" type="number" placeholder="Price (in Satoshi)" style="margin-bottom:10px;width:25%" value="<?php echo $load ? $content->getPrice() : ""; ?>">
                        <div class="form-group">
                            <button formaction="<?php echo $GLOBALS["ROOT_URL"]; ?>/preview" class="btn btn-light" type="submit">Store & Preview</button>
                            <button class="btn btn-primary" type="submit">Publish</button>
                        </div>
            </form>
        </div>
    </div>
    </div>
    </div>
