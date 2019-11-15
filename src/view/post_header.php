<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */
?>
<header class="masthead" style="background-image:url('assets/img/post-bg.jpg');">
    <div class="overlayarticle overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="post-heading">
                    <h1><?php echo $title ?></h1>
                    <h2 class="subheading"><?php echo $subtitle ?></h2><span class="meta">Posted by&nbsp;<a href="#"><?php echo $author ?></a>&nbsp;on  <?php echo $date->format('F d, Y')?> </span></div>
            </div>
        </div>
    </div>
</header>
