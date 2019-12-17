<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */
?>
<header class="masthead" style="background-image:url('assets/img/post-bg.jpg');" xmlns="http://www.w3.org/1999/html">
    <div class="overlayarticle overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="post-heading">
                    <h1><?php echo $title ?></h1>
                    <h2 class="subheading"><?php echo $subtitle ?></h2>
                    <span class="meta">Posted by&nbsp;<a href="#"><?php echo $author ?></a>&nbsp;on  <?php echo $date->format('F d, Y')?> </span>
                    <?php if($edit): ?>
                    <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/edit">
                        <div style="margin-top: 20px">
                            <input type="hidden" name="cont_id" value="<?php echo $id; ?>">
                            <input type="submit" class="btn btn-light" value="Edit article">
                        </div>
                    </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</header>
