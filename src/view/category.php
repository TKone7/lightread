<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */
use domain\Category;
use router\Router;

(isset($this->categories)) ? $categories = $this->categories: array(new Category());
$cols = 2;

?>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <section class="cms-boxes">
                <div class="container-fluid">
                    <?php
                    $rowcount = 0;
                    foreach ($categories as $cat) { ?>

                        <?php if($rowcount % $cols == 0){ ?>
                            <div class="row">
                        <?php } ?>

                            <div class="col-md-6 cms-boxes-outer">
                                <a href="<?php echo $GLOBALS["ROOT_URL"] .'/'. Router::getInstance()->route('article_category', [$cat->getKey()]);?>">
                                    <div class="cms-boxes-items cms-pink" style="background-image:url('assets/img/<?php echo $cat->getKey().'_thumb'?>.jpg');">
                                        <div class="boxes-align">
                                            <div class="large-box">
                                                <h3 style="color:#000000; background-color:rgba(255,255,255,0.26)"> <?php echo $cat->getName(); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php if(($rowcount +1) % $cols == 0){ ?>
                            </div>
                        <?php } ?>
                        <?php $rowcount++  ?>
                    <?php } ?>
                </div>
            </section>
        </div>
    </div>
</div>
