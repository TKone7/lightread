<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

$title = str_replace("lightread", "<strong>light</strong><i class=\"fa fa-flash\" style=\"color: #ffc81e;\"></i>read", $title);

?>

<header class="masthead" style="background-image:url('assets/img/lightningstruck.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
              <div class="site-heading">
                  <h1 class="lrlogo"><strong><?php echo $title ?></strong></h1><span class="subheading"><?php echo $subtitle ?></strong></span></div>
              </div>
        </div>
    </div>
</header>
