<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */
?>
<div class="container">
        <div class="row articlerow">
            <div class="col-md-10 col-lg-8 mx-auto">
                <h1>Let's put it down</h1>
                <div class="container">
                    <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/publish">
                        <div class="form-group">
                            <input name="title" class="form-control" type="text" placeholder="Title" style="margin-bottom:10px">
                            <input name="subtitle" class="form-control" type="text" placeholder="Subtitle" style="margin-bottom:10px">
                            <textarea class="form-control" id="summernote" name="editordata" placeholder="Your story...." style="min-height:200px"></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1">Paid article?</label>
                        </div>
                        <input class="form-control" type="text" placeholder="Price (in Satoshi)" style="margin-bottom:10px;width:25%">
                        <div class="form-group">
                            <button formaction="<?php echo $GLOBALS["ROOT_URL"]; ?>/preview" class="btn btn-light" type="submit">Preview</button>
                            <button class="btn btn-primary" type="submit">Publish</button>
                        </div>
            </form>
        </div>
    </div>
    </div>
    </div>
