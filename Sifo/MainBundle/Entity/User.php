<?php

namespace Sifo\MainBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="user_id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="no_id",type="string",nullable=true)
     *
     */
    protected $no_id;
    
    /**
     *  @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    protected $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=255,nullable=true)
     */
    protected $class;
    
    /**
     * @var string
     *
     * @ORM\Column(name="jurusan", type="string", length=255,nullable=true)
     */
    protected $jurusan;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mata_pelajaran", type="string", length=255,nullable=true)
     */
    protected $mataPelajaran;
    
    /**
     * @var string
     *
     * @ORM\Column(name="grup", type="string", length=20,nullable=true)
     */
    protected $grup;
    
    /**
     * @var integer
     * @ORM\Column(name="facebook_id", type="bigint",nullable=true)
     */
    protected $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_access_token", type="string", length=255,nullable=true)
     */
    protected $facebookAccessToken;


    /**
     * set id
     *
     * @param string $id
     * @return user
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set facebookId
     *
     * @param integer $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return integer 
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    /**
     * Set no_id
     *
     * @param integer $noId
     * @return User
     */
    public function setNoId($noId)
    {
        $this->no_id = $noId;

        return $this;
    }

    /**
     * Get no_id
     *
     * @return integer 
     */
    public function getNoId()
    {
        return $this->no_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return User
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set jurusan
     *
     * @param string $jurusan
     * @return User
     */
    public function setJurusan($jurusan)
    {
        $this->jurusan = $jurusan;

        return $this;
    }

    /**
     * Get jurusan
     *
     * @return string 
     */
    public function getJurusan()
    {
        return $this->jurusan;
    }

    /**
     * Set mataPelajaran
     *
     * @param string $mataPelajaran
     * @return User
     */
    public function setMataPelajaran($mataPelajaran)
    {
        $this->mataPelajaran = $mataPelajaran;

        return $this;
    }

    /**
     * Get mataPelajaran
     *
     * @return string 
     */
    public function getMataPelajaran()
    {
        return $this->mataPelajaran;
    }

    /**
     * Set grup
     *
     * @param string $grup
     * @return User
     */
    public function setGrup($grup)
    {
        $this->grup = $grup;

        return $this;
    }

    /**
     * Get grup
     *
     * @return string 
     */
    public function getGrup()
    {
        return $this->grup;
    }
}
