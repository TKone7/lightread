<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:36
 */

namespace domain;


use dao\ContentDAO;
use dao\UserDAO;

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
        return $this->payer ?? new User();
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    public function __set($name, $value)
    {
        if ($name=='fld_invc_id'){
            $this->setId($value);
        }elseif ($name=='fld_user_id1'){
            $this->setPayer((new UserDAO())->read($value));
        }elseif ($name=='fld_cont_id'){
            $this->setContent((new ContentDAO())->read($value));
        }elseif ($name=='fld_purp_key'){
            $this->setPurpose(Purpose::$value());
        }elseif ($name=='fld_sinv_key'){
            $this->setStatus(InvStatus::$value());
        }elseif ($name=='fld_invc_rhash'){
            $this->setRhash($value);
        }elseif ($name=='fld_invc_payreq'){
            $this->setPayReq($value);
        }elseif ($name=='fld_invc_memo'){
            $this->setMemo($value);
        }elseif ($name=='fld_invc_satoshis'){
            $this->setValue($value);
        }elseif ($name=='fld_invc_creationpit'){
            $this->setCreationDate(date_create_from_format('Y-m-d H:i:s',$value)  );
        }elseif ($name=='fld_invc_settlepit'){
            if(!is_null($value)){
                $this->setSettleDate(date_create_from_format('Y-m-d H:i:s',$value));
            }else{
                $this->setSettleDate(NULL);
            }
        }elseif ($name=='fld_invc_expiry'){
            $this->setExpiry($value);
        }
    }
}