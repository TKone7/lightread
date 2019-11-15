<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 12:16
 */

namespace domain;


class ContentManager
{
    private $articles = [];


    public function __construct(array $cont_list = NULL)
    {
        if(is_null($cont_list))
        {
            $this->articles=array();
        }else{
            $this->articles=$cont_list;
        }
    }

    public function addContent(Content $content){
        $this->articles[] = $content;
    }
    public function getContent(Status $status = NULL, Access $access = NULL) : array
    {
        return $this->articles;
    }
    public function getSize(){
        return sizeof($this->articles);
    }

    public function getRevenue(Purpose $purpose = NULL){
        $sum = 0;
        foreach ($this->articles as $article) {
            $sum += $article->getRevenue($purpose);
        }
        return $sum;
    }

}