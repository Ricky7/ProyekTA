<?php

namespace Sifo\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblKuis
 */
class TblKuis
{
    /**
     * @var string
     */
    private $userGuru;

    /**
     * @var integer
     */
    private $nipGuru;

    /**
     * @var string
     */
    private $namaGuru;

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
    private $soal;

    /**
     * @var string
     */
    private $mataPelajaran;

    /**
     * @var integer
     */
    private $kelas;

    /**
     * @var string
     */
    private $jawaban;

    /**
     * @var integer
     */
    private $nilai;

    /**
     * @var integer
     */
    private $nisSiswa;

    /**
     * @var string
     */
    private $userSiswa;

    /**
     * @var string
     */
    private $namaSiswa;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set userGuru
     *
     * @param string $userGuru
     * @return TblKuis
     */
    public function setUserGuru($userGuru)
    {
        $this->userGuru = $userGuru;

        return $this;
    }

    /**
     * Get userGuru
     *
     * @return string 
     */
    public function getUserGuru()
    {
        return $this->userGuru;
    }

    /**
     * Set nipGuru
     *
     * @param integer $nipGuru
     * @return TblKuis
     */
    public function setNipGuru($nipGuru)
    {
        $this->nipGuru = $nipGuru;

        return $this;
    }

    /**
     * Get nipGuru
     *
     * @return integer 
     */
    public function getNipGuru()
    {
        return $this->nipGuru;
    }

    /**
     * Set namaGuru
     *
     * @param string $namaGuru
     * @return TblKuis
     */
    public function setNamaGuru($namaGuru)
    {
        $this->namaGuru = $namaGuru;

        return $this;
    }

    /**
     * Get namaGuru
     *
     * @return string 
     */
    public function getNamaGuru()
    {
        return $this->namaGuru;
    }

    /**
     * Set tanggal
     *
     * @param \DateTime $tanggal
     * @return TblKuis
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
     * @return TblKuis
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
     * Set soal
     *
     * @param string $soal
     * @return TblKuis
     */
    public function setSoal($soal)
    {
        $this->soal = $soal;

        return $this;
    }

    /**
     * Get soal
     *
     * @return string 
     */
    public function getSoal()
    {
        return $this->soal;
    }

    /**
     * Set mataPelajaran
     *
     * @param string $mataPelajaran
     * @return TblKuis
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
     * Set kelas
     *
     * @param integer $kelas
     * @return TblKuis
     */
    public function setKelas($kelas)
    {
        $this->kelas = $kelas;

        return $this;
    }

    /**
     * Get kelas
     *
     * @return integer 
     */
    public function getKelas()
    {
        return $this->kelas;
    }

    /**
     * Set jawaban
     *
     * @param string $jawaban
     * @return TblKuis
     */
    public function setJawaban($jawaban)
    {
        $this->jawaban = $jawaban;

        return $this;
    }

    /**
     * Get jawaban
     *
     * @return string 
     */
    public function getJawaban()
    {
        return $this->jawaban;
    }

    /**
     * Set nilai
     *
     * @param integer $nilai
     * @return TblKuis
     */
    public function setNilai($nilai)
    {
        $this->nilai = $nilai;

        return $this;
    }

    /**
     * Get nilai
     *
     * @return integer 
     */
    public function getNilai()
    {
        return $this->nilai;
    }

    /**
     * Set nisSiswa
     *
     * @param integer $nisSiswa
     * @return TblKuis
     */
    public function setNisSiswa($nisSiswa)
    {
        $this->nisSiswa = $nisSiswa;

        return $this;
    }

    /**
     * Get nisSiswa
     *
     * @return integer 
     */
    public function getNisSiswa()
    {
        return $this->nisSiswa;
    }

    /**
     * Set userSiswa
     *
     * @param string $userSiswa
     * @return TblKuis
     */
    public function setUserSiswa($userSiswa)
    {
        $this->userSiswa = $userSiswa;

        return $this;
    }

    /**
     * Get userSiswa
     *
     * @return string 
     */
    public function getUserSiswa()
    {
        return $this->userSiswa;
    }

    /**
     * Set namaSiswa
     *
     * @param string $namaSiswa
     * @return TblKuis
     */
    public function setNamaSiswa($namaSiswa)
    {
        $this->namaSiswa = $namaSiswa;

        return $this;
    }

    /**
     * Get namaSiswa
     *
     * @return string 
     */
    public function getNamaSiswa()
    {
        return $this->namaSiswa;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return TblKuis
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
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
