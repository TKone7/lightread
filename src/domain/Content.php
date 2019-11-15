<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:14
 */

namespace domain;


use dao\UserDAO;

class Content
{
    /**
     * @AttributeType int
     */
    private $id;
    /**
     * @AttributeType String
     */
    private $title;
    /**
     * @AttributeType String
     */
    private $subtitle;
    /**
     * @AttributeType String
     */
    private $body;
    /**
     * @AttributeType date
     */
    private $creation_date;
    /**
     * @AttributeType Array[]
     */
    private $keywords = [];
    /**
     * @AttributeType User
     */
    private $author;

    /**
     * @AttributeType Status
     */
    private $status;
    /**
     * @AttributeType Access
     */
    private $access;
    /**
     * @AttributeType numeric
     */
    private $price;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getAccess(): Access
    {
        return $this->access;
    }

    /**
     * @param mixed $access
     */
    public function setAccess(Access $access)
    {
        $this->access = $access;
    }


    /**
     * @return mixed
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
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
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * @param array $keywords
     */
    public function setKeywords(array $keywords)
    {
        $this->keywords = $keywords;
    }

    public function __set($name, $value)
    {
        if ($name=='fld_cont_id'){
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
            $this->setCreationDate($value);
        }elseif ($name=='fld_cont_satoshis'){
            $this->setPrice($value);
        }
    }


}