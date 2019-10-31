<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.19
 * Time: 17:55
 */

function layoutSetContent($content){
    require_once("simple_header.php");
    require_once($content);
    require_once("footer.php");
}
