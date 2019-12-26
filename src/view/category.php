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

    <?php
    $rowcount = 0;
    foreach ($categories as $cat) { ?>

        <?php if($rowcount % $cols == 0){ ?>
            <div class="row category_row">
        <?php } ?>

                <div class="col category_col">
                    <div class="category_container">
                        <a href="<?php echo $GLOBALS["ROOT_URL"] .'/'. Router::getInstance()->route('article_category', [$cat->getKey()]);?>">
                            <img class="category_img" src='assets/img/<?php echo $cat->getKey()?>.jpg' )>
                            <div class="category_name">
                                <h1 class="category_h1"><?php echo $cat->getName(); ?></h1>
                            </div>
                        </a>
                    </div>
                </div>

        <?php if(($rowcount +1) % $cols == 0){ ?>
            </div>
        <?php } ?>
        <?php $rowcount++  ?>
    <?php } ?>

</div>



