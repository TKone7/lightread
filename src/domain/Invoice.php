<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:18
 */

namespace domain;


class Invoice
{
    /**
     * @AttributeType int
     */
    private $id;

    /**
     * @AttributeType String
     */
    private $rhash;

    /**
     * @AttributeType String
     */
    private $pay_req;
    /**
     * @AttributeType String
     */
    private $memo;
    /**
     * @AttributeType int
     */
    private $value;

    /**
     * @AttributeType date
     */
    private $creation_date;
    /**
     * @AttributeType date
     */
    private $settle_date;
    /**
     * @AttributeType int
     */
    private $expiry;

    /**
     * @AttributeType StatusInvoice
     */
    private $status;

    private $purpose;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRhash()
    {
        return $this->rhash;
    }

    /**
     * @param mixed $rhash
     */
    public function setRhash($rhash)
    {
        $this->rhash = $rhash;
    }

    /**
     * @return mixed
     */
    public function getPayReq()
    {
        return $this->pay_req;
    }

    /**
     * @param mixed $pay_req
     */
    public function setPayReq($pay_req)
    {
        $this->pay_req = $pay_req;
    }

    /**
     * @return mixed
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @param mixed $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return mixed
     */
    public function getSettleDate()
    {
        return $this->settle_date;
    }

    /**
     * @param mixed $settle_date
     */
    public function setSettleDate($settle_date)
    {
        $this->settle_date = $settle_date;
    }

    /**
     * @return mixed
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @param mixed $expiry
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;
    }

    /**
     * @return mixed
     */
    public function getStatus() : InvStatus
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPurpose() : InvPurpose
    {
        return $this->purpose;
    }

    /**
     * @param mixed $purpose
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;
    }

    public function __set($name, $value)
    {
       /* if ($name=='fld_cont_id'){
            $this->setId($value);
        }elseif ($name=='fld_user_id'){
            $this->setAuthor((new UserDAO)->read($value));
        }elseif ($name=='fld_accc_key'){
            $this->setAccess(Access::$value());
        }elseif ($name=='fld_scon_key'){
            $this->setStatus(Status::$value());
        }elseif ($name=='fld_cont_title'){
            $this->setTitle($value);
        }elseif ($name=='fld_cont_subtitle'){
            $this->setSubtitle($value);
        }elseif ($name=='fld_cont_body'){
            $this->setBody($value);
        }elseif ($name=='fld_cont_creationpit'){
            $this->setCreationDate(date_create_from_format('Y-m-d H:i:s', $value));
        }elseif ($name=='fld_cont_satoshis'){
            $this->setPrice($value);
        }*/
    }
}