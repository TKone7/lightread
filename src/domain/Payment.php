<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:36
 */

namespace domain;


class Payment extends Invoice
{
    /**
     * @AttributeType Content
     */
    private $content;

    /**
     * @AttributeType User
     */
    private $payer;

    /**
     * @return mixed
     */
    public function getContent() : Content
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPayer() : User
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

}