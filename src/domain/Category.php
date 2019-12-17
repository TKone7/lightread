<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:38
 */

namespace domain;


class Category
{

    /**
     * @AttributeType int
     */
    private $id;

    /**
     * @AttributeType String
     */
    private $name;
    /**
     * @AttributeType String
     */
    private $key;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }



    public function __set($name, $value)
    {
        if ($name=='fld_cate_id'){
            $this->setId($value);
        }elseif ($name=='fld_cate_name'){
            $this->setName($value);
        }elseif ($name=='fld_cate_key'){
            $this->setKey($value);
        }
    }
}