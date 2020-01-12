<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Content;
use domain\Status;
use router\Router;

isset($this->content)?$content=$this->content:$content=new Content();

?>
<header class="masthead" style="background-image:url('assets/img/<?php echo $content->getCategory()->getKey()?>.jpg');" xmlns="http://www.w3.org/1999/html">
    <div class="overlayarticle overlay" <?php echo ($content->getStatus() == Status::DRAFT()) ? 'style="background-image:url(assets/img/draft.png);"' : 'NULL' ?>></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="post-heading">
                    <h1><?php echo TemplateView::noHTML($content->getTitle()) ?></h1>
                    <h2 class="subheading"><?php echo TemplateView::noHTML($content->getSubtitle()) ?></h2>
                    <span class="meta">Posted by&nbsp;<a href="<?php echo $GLOBALS["ROOT_URL"] .'/'. Router::getInstance()->route('article_author', [$content->getAuthor()->getUsername()]);?>"><?php echo TemplateView::noHTML($content->getAuthor()->getFullName()) ?></a>&nbsp;on  <?php echo $content->getCreationDate()->format('F d, Y')?>  </span>
                    <span class="meta"> <a href="<?php echo $GLOBALS["ROOT_URL"] .'/'. Router::getInstance()->route('article_category', [$content->getCategory()->getKey()]);?>"><?php echo $content->getCategory()->getName()?></a></span>
                    <?php if($edit): ?>
                    <form method="get" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/<?php echo Router::getInstance()->route('edit_slug', [$content->getSlug()]);?>">
                        <div style="margin-top: 20px">
                            <input type="submit" class="btn btn-light" value="Edit article">
                        </div>
                    </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</header>
