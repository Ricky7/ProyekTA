<?php

namespace Sifo\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblBerita
 */
class TblBerita
{
    /**
     * @var \DateTime
     */
    private $tanggal;

    /**
     * @var string
     */
    private $judul;

    /**
     * @var string
     */
    private $isi;

    /**
     * @var string
     */
    private $sumber;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set tanggal
     *
     * @param \DateTime $tanggal
     * @return TblBerita
     */
    public function setTanggal($tanggal)
    {
        $this->tanggal = $tanggal;

        return $this;
    }

    /**
     * Get tanggal
     *
     * @return \DateTime 
     */
    public function getTanggal()
    {
        return $this->tanggal;
    }

    /**
     * Set judul
     *
     * @param string $judul
     * @return TblBerita
     */
    public function setJudul($judul)
    {
        $this->judul = $judul;

        return $this;
    }

    /**
     * Get judul
     *
     * @return string 
     */
    public function getJudul()
    {
        return $this->judul;
    }

    /**
     * Set isi
     *
     * @param string $isi
     * @return TblBerita
     */
    public function setIsi($isi)
    {
        $this->isi = $isi;

        return $this;
    }

    /**
     * Get isi
     *
     * @return string 
     */
    public function getIsi()
    {
        return $this->isi;
    }

    /**
     * Set sumber
     *
     * @param string $sumber
     * @return TblBerita
     */
    public function setSumber($sumber)
    {
        $this->sumber = $sumber;

        return $this;
    }

    /**
     * Get sumber
     *
     * @return string 
     */
    public function getSumber()
    {
        return $this->sumber;
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
