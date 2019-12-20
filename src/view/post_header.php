<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Content;
use domain\Status;

isset($this->content)?$content=$this->content:$content=new Content();

?>
<header class="masthead" style="background-image:url('assets/img/<?php echo $content->getCategory()->getKey()?>.jpg');" xmlns="http://www.w3.org/1999/html">
    <div class="overlayarticle overlay" <?php echo ($content->getStatus() == Status::DRAFT()) ? 'style="background-image:url(assets/img/draft.png);"' : 'NULL' ?>></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="post-heading">
                    <h1><?php echo $content->getTitle() ?></h1>
                    <h2 class="subheading"><?php echo $content->getSubtitle() ?></h2>
                    <span class="meta">Posted by&nbsp;<a href="#"><?php echo $content->getAuthor()->getFullName() ?></a>&nbsp;on  <?php echo $content->getCreationDate()->format('F d, Y')?>  </span>
                    <span class="meta"><?php echo $content->getCategory()->getName()?></span>
                    <?php if($edit): ?>
                    <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/edit">
                        <div style="margin-top: 20px">
                            <input type="hidden" name="cont_id" value="<?php echo $content->getId(); ?>">
                            <input type="submit" class="btn btn-light" value="Edit article">
                        </div>
                    </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</header>
