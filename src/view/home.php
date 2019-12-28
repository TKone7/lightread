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
use router\Router;

isset($this->mgr) ? $mgr = $this->mgr : $mgr = new ContentManager();

?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <?php
            $articles = $mgr->getContent(Status::PUBLISHED());

            foreach ($articles as $item) { ?>
                <div class="post-preview">
                    <a href="<?php echo $GLOBALS["ROOT_URL"] . "/". Router::getInstance()->route('article_slug', [$item->getSlug()]) ; ?>">
                        <h2 class="post-title"><?php echo $item->getTitle(); ?></h2>
                        <h3 class="post-subtitle"><?php echo $item->getSubtitle(); ?></h3>
                    </a>
                    <p class="post-meta">Posted by <a href="<?php echo $GLOBALS["ROOT_URL"] .'/'. Router::getInstance()->route('article_author', [$item->getAuthor()->getUsername()]);?>"><?php echo $item->getAuthor()->getFullName(); ?></a> on <?php echo $item->getCreationDate()->format('F d, Y')?> </br><a href="<?php echo $GLOBALS["ROOT_URL"] .'/'. Router::getInstance()->route('article_category', [$item->getCategory()->getKey()]);?>"><?php echo $item->getCategory()->getName()?></a>
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
                <div class="post-preview" style="padding: 40px">
                    <a href="<?php echo $GLOBALS["ROOT_URL"] . "/"; ?>">
                        <h2 class="post-title">We're Sorry!</h2>
                        <h3 class="post-subtitle">There are no articles matching your search...</h3>
                    </a>
                </div>
            <?php endif; ?>

            <!--
            <div class="post-preview">
                <a href="post-secured.html">
                    <h2 class="post-title">Man must explore, and this is exploration at its greatest</h2>
                    <h3 class="post-subtitle">Problems look mighty small from 150 miles up</h3>
                </a>
                <p class="post-meta">Posted by&nbsp;<a href="#">Start Bootstrap on September 24, 2018</a><a class="text-right float-right justify-content-sm-end" href="#">$ 0.1&nbsp;<i class="fab fa-bitcoin"></i></a></p>
            </div>
            <hr>

            <div class="post-preview">
                <a href="post-1.html">
                    <h2 class="post-title">I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.</h2>
                </a>
                <p class="post-meta">Posted by&nbsp;<a href="#">Start Bootstrap on September 24, 2018</a><a class="text-right float-right justify-content-sm-end" href="#">FREE&nbsp;<i class="fas fa-piggy-bank"></i></a></p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post-1.html">
                    <h2 class="post-title"> Science has not yet mastered prophecy</h2>
                    <h3 class="post-subtitle">We predict too much for the next year and yet far too little for the next ten.</h3>
                </a>
                <p class="post-meta">Posted by&nbsp;<a href="#">Start Bootstrap on August 24, 2018</a><a class="text-right float-right justify-content-sm-end" href="#">FREE&nbsp;<i class="fas fa-piggy-bank"></i></a></p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="#">
                    <h2 class="post-title">Failure is not an option</h2>
                    <h3 class="post-subtitle">Many say exploration is part of our destiny, but it’s actually our duty to future generations.</h3>
                </a>
                <p class="post-meta">Posted by&nbsp;<a href="#">Start Bootstrap on July 8, 2018</a><a class="text-right float-right justify-content-sm-end" href="#">$ 1.90&nbsp;<i class="fab fa-bitcoin"></i></a></p>
            </div>
            <hr>
            <div class="text-center clearfix"><button class="btn btn-primary" type="button">More Articles ...</button></div>
            -->
        </div>
    </div>
</div>