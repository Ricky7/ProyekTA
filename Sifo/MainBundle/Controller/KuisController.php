<?php

namespace Sifo\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sifo\AdminBundle\Modals\Login;
use Sifo\AdminBundle\Entity\FosUser;
use Sifo\AdminBundle\Entity\Admin;
use Sifo\AdminBundle\Entity\Kelas;
use Sifo\AdminBundle\Entity\TblMateri;
use Sifo\AdminBundle\Entity\TblKuis;

class KuisController extends Controller {
    
    public function createkuisAction(Request $request)
    {
        if($request->getMethod()=='POST'){
            $judul=$request->get('judul');
            $soal=$request->get('soal');
            $kelas=$request->get('kelas');
            $userguru=$request->get('userguru');
            $nipguru=$request->get('nipguru');
            $namaguru=$request->get('namaguru');
            $mapel=$request->get('mapel');
            $status=$request->get('status');
            
            $c = new TblKuis();
            //$dateTime = new \DateTime();
            $c->setJudul($judul);
            $c->setSoal($soal);
            $c->setKelas($kelas);
            $c->setTanggal(new \DateTime("now"));
            $c->setUserGuru($userguru);
            $c->setNipGuru($nipguru);
            $c->setNamaGuru($namaguru);
            $c->setMataPelajaran($mapel);
            $c->setStatus($status);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($c);
            $em->flush();
            return $this->redirect($this->generateUrl('create_kuis_page'));
        }
        $username = $this->getUser()->getUsername();
        $tbl = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblKuis')
                      ->findByUserGuru($username);
                      
                      
        $kelas = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:Kelas')
                      ->findAll();
        
        if (!$tbl) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:createkuis.html.twig', array('error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Kuis:createkuis.html.twig', array('kelas' => $kelas, 'message' => 'berhasil disimpan', 'tbl' => $tbl));
    }
    
    public function editkuisAction(Request $request, $id)
    {
        $kuis = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblKuis')
                      ->find($id);
        
        $kelas = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:Kelas')
                      ->findAll();
        
        if (!$kuis) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:editkuis.html.twig', array('error' => 'data tidak tersedia'));
        }
        if($request->getMethod()=='POST'){
                $judul = $request->get('judul');
                $soal = $request->get('soal');
                $kelas = $request->get('kelas');
                
                $kuis->setJudul($judul);
                $kuis->setSoal($soal);
                $kuis->setKelas($kelas);
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('create_kuis_page'));
            }
        return $this->render('SifoMainBundle:Kuis:editkuis.html.twig', array('kelas' => $kelas, 'kuis' => $kuis, 'message' => 'berhasil disimpan'));
            
    }
    
    public function deletekuisAction(Request $request, $id)
    {
        $kuis = $this->getDoctrine()
                     ->getRepository('SifoAdminBundle:TblKuis')
                     ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($kuis);
        $em->flush();
           
        return $this->redirect($this->generateUrl('create_kuis_page'));
    }
    
    public function checkkelassatuAction()
    {
        $username = $this->getUser()->getUsername();
        $tbl = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblKuis')
                    //->findByUserGuru($username)->findByStatus('new');
                    ->findBy(array('userGuru' => $username, 'status' => 'old', 'kelas' => 1));
        
        if (!$tbl) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:checkkuisKelas1.html.twig', array('tbl' => $tbl, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Kuis:checkkuisKelas1.html.twig', array('tbl' => $tbl));
    }
    
    public function checkkelasduaAction()
    {
        $username = $this->getUser()->getUsername();
        $tbl = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblKuis')
                    //->findByUserGuru($username)->findByStatus('new');
                    ->findBy(array('userGuru' => $username, 'status' => 'old', 'kelas' => 2));
        
        if (!$tbl) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:checkkuisKelas2.html.twig', array('tbl' => $tbl, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Kuis:checkkuisKelas2.html.twig', array('tbl' => $tbl));
    }
    
    public function checkkelastigaAction()
    {
        $username = $this->getUser()->getUsername();
        $tbl = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblKuis')
                    //->findByUserGuru($username)->findByStatus('new');
                    ->findBy(array('userGuru' => $username, 'status' => 'old', 'kelas' => 3));
        
        if (!$tbl) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:checkkuisKelas3.html.twig', array('tbl' => $tbl, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Kuis:checkkuisKelas3.html.twig', array('tbl' => $tbl));
    }
    
    public function inputnilai1Action(Request $request, $id)
    {
        $kuis = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblKuis')
                      ->find($id);
        
        if (!$kuis) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:editkuis.html.twig', array('error' => 'data tidak tersedia'));
        }
        if($request->getMethod()=='POST'){
                $nilai = $request->get('nilai');
                $status = $request->get('status');
                
                $kuis->setNilai($nilai);
                $kuis->setStatus($status);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('check_kuis_kelas_satu'));
            }
        return $this->render('SifoMainBundle:Kuis:inputnilai1.html.twig', array('kuis' => $kuis, 'message' => 'berhasil disimpan'));
            
    }
    
    public function inputnilai2Action(Request $request, $id)
    {
        $kuis = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblKuis')
                      ->find($id);
        
        if (!$kuis) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:checkkuisKelas2.html.twig', array('error' => 'data tidak tersedia'));
        }
        if($request->getMethod()=='POST'){
                $nilai = $request->get('nilai');
                $status = $request->get('status');
                
                $kuis->setNilai($nilai);
                $kuis->setStatus($status);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('check_kuis_kelas_dua'));
            }
        return $this->render('SifoMainBundle:Kuis:inputnilai2.html.twig', array('kuis' => $kuis, 'message' => 'berhasil disimpan'));
            
    }
    
    public function inputnilai3Action(Request $request, $id)
    {
        $kuis = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblKuis')
                      ->find($id);
        
        if (!$kuis) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:checkkuisKelas3.html.twig', array('error' => 'data tidak tersedia'));
        }
        if($request->getMethod()=='POST'){
                $nilai = $request->get('nilai');
                $status = $request->get('status');
                
                $kuis->setNilai($nilai);
                $kuis->setStatus($status);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('check_kuis_kelas_tiga'));
            }
        return $this->render('SifoMainBundle:Kuis:inputnilai3.html.twig', array('kuis' => $kuis, 'message' => 'berhasil disimpan'));
            
    }
    
    public function nilaiAction()
    {
        $username = $this->getUser()->getUsername();
        $nilai = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblKuis')
                    //->findByUserGuru($username)->findByStatus('new');
                    ->findBy(array('userSiswa' => $username, 'status' => 'checked'));
        
        if (!$nilai) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Student:nilai.html.twig', array('nilai' => $nilai, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Student:nilai.html.twig', array('nilai' => $nilai));
    }
}
