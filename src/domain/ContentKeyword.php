<?php

namespace domain;

class ContentKeyword
{

    /**
     * @AttributeType int
     */
    private $id;

    /**
     * @AttributeType String
     */
    private $cont_id;

    /**
     * @AttributeType String
     */
    private $keyw_id;



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
    public function getContID()
    {
        return $this->cont_id;
    }

    /**
     * @param mixed $name
     */
    public function setContID($ID)
    {
        $this->cont_id = $ID;
    }

    /**
     * @return mixed
     */
    public function getKeywID()
    {
        return $this->keyw_id;
    }

    /**
     * @param mixed $name
     */
    public function setKeywID($ID)
    {
        $this->keyw_id = $ID;
    }


    public function __set($name, $value)
    {
        if ($name=='fld_coke_id'){
            $this->setId($value);
        }elseif ($name=='fld_cont_id'){
            $this->setContID($value);
        }elseif ($name=='fld_keyw_name'){
            $this->setKeywID($value);
        }
    }
}