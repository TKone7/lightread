<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Access;
use domain\ContentManager;
use domain\Status;

isset($this->mgr) ? $mgr = $this->mgr : $mgr = new ContentManager();

?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <?php
            $articles = $mgr->getContent(Status::PUBLISHED());
            foreach ($articles as $item) { ?>
                <div class="post-preview">
                    <a href="<?php echo $GLOBALS["ROOT_URL"] . "/article/". $item->getSlug(); ?>">
                        <h2 class="post-title"><?php echo $item->getTitle(); ?></h2>
                        <h3 class="post-subtitle"><?php echo $item->getSubtitle(); ?></h3>
                    </a>
                    <p class="post-meta">Posted by&nbsp;<?php echo $item->getAuthor()->getFullName(); ?> on <?php echo $item->getCreationDate()->format('F d, Y')?> </br><?php echo $item->getCategory()->getName()?></a>
                        <?php if($item->getAccess() == Access::PAID()): ?>
                        <a class="text-right float-right justify-content-sm-end" href="#"><?php echo $item->getPrice() ?> sats&nbsp;/&nbsp;<?php echo $item->getPriceFiat() ?>&nbsp;<i class="fab fa-bitcoin"></i></a>
                        <?php else: ?>
                        <a class="text-right float-right justify-content-sm-end" href="#">FREE&nbsp;<i class="fas fa-piggy-bank"></i></a>
                        <?php endif; ?>
                    </p>
                </div>
                <hr>

                <?php
            }
            if(sizeof($articles)==0): ?>

                <p>No articles found</p>
            <?php endif; ?>

        </div>
    </div>
</div>