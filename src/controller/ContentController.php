<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 10:44
 */

namespace controller;


use domain\Access;
use domain\Content;
use domain\Status;
use router\Router;
use services\ContentServiceImpl;

class ContentController
{
    public function store(Status $new_status){
        $cont = new Content();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $cont->setTitle($_POST["title"]);
        $cont->setSubtitle($_POST["subtitle"]);
        $cont->setBody($_POST["editordata"]);
        $cont->setStatus($new_status);
        $sat = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        if($_POST["paid"]=="on" AND $sat>0){
            $cont->setAccess(Access::PAID());
            $cont->setPrice($sat);
        }else{
            $cont->setAccess(Access::FREE());
            $cont->setPrice(0);
        }

        $contsvc = new ContentServiceImpl();
        if($id>0){
            // update
            $cont->setId($id);
            $res = $contsvc->updateContent($cont);

        }else{
            // create
            $res = $contsvc->createContent($cont);
        }

        Router::redirect("/article?id=" . $res->getId());

    }

}