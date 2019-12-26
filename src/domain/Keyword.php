<?php

namespace domain;

class Keyword
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



    public function __set($name, $value)
    {
        if ($name=='fld_keyw_id'){
            $this->setId($value);
        }elseif ($name=='fld_keyw_name'){
            $this->setName($value);
        }
    }
}