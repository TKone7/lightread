<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:42
 */

namespace services;


use domain\Content;

interface SearchService
{

    public function getFindings(String $searchterms, array $cont_list);

}
