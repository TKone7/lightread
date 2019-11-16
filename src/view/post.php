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
                        <div class="text-center clearfix"><button class="btn btn-primary" type="button" data-target="#payinvoice" data-toggle="modal">Read on for <?php echo $content->getPrice(); ?> Sats (~?? cents)</button></div>
                    <?php endif; ?>
                    </div>

            </div>
        </div>
    </article>
