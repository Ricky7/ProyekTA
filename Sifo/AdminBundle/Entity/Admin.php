<?php

namespace Sifo\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 */
class Admin
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $userName;


    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Admin
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Admin
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }
    


    /**
     * Set userName
     *
     * @param string $userName
     * @return Admin
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
