<?php


namespace domain;


class View
{

    /**
     * @AttributeType int
     */
    private $id;
    /**
     * @AttributeType User
     */
    private $user;
    /**
     * @AttributeType Content
     */
    private $content;

    /**
     * @AttributeType String
     */
    private $ip;
    /**
     * @AttributeType String
     */
    private $country;

    /**
     * @AttributeType String
     */
    private $city;
    /**
     * @AttributeType String
     */
    private $os;
    /**
     * @AttributeType String
     */
    private $browser;
    /**
     * @AttributeType String
     */
    private $browserversion;

    /**
     * @AttributeType date
     */
    private $PIT;

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
    public function getUser() : User
    {
        return $this->user ?? new User();
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getContent(): Content
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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }


    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }


    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $country
     */
    public function setCity($city)
    {
        $this->city = $city;
    }


    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @return mixed
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param mixed $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    /**
     * @return mixed
     */
    public function getBrowserVersion()
    {
        return $this->browserversion;
    }

    /**
     * @param mixed $screensize
     */
    public function setBrowserVersion($browserversion)
    {
        $this->browserversion = $browserversion;
    }


    /**
     * @return mixed
     */
    public function getPIT()
    {
        return $this->PIT;
    }

    /**
     * @param mixed $PIT
     */
    public function setPIT($PIT)
    {
        $this->PIT = $PIT;
    }




}