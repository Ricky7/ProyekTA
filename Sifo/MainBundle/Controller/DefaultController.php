<?php

namespace Sifo\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sifo\AdminBundle\Modals\Login;
use Sifo\AdminBundle\Entity\FosUser;
use Sifo\AdminBundle\Entity\Admin;
use Sifo\AdminBundle\Entity\Kelas;
use Sifo\AdminBundle\Entity\TblMateri;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SifoMainBundle:Default:welcome.html.twig');
    }
    
    public function studentAction()
    {
        return $this->render('SifoMainBundle:Student:index.html.twig');
    }
    
    public function teacherAction()
    {
        return $this->render('SifoMainBundle:Teacher:index.html.twig');
    }
    
    public function profileteacherAction()
    {
        return $this->render('SifoMainBundle:Teacher:profileteacher.html.twig');
    }
    
    public function cekAction()
    {
        return $this->render('SifoMainBundle::layout.html.twig');
    }
    
    public function viewmateriAction()
    {
        //$user = $this->get('security.context')->getToken()->getUser();
        //$user = getNoId();
        $nis = $this->getUser()->getUsername();
        $tbl = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblMateri')
                      //->findAll();
                      ->findByGuru($nis);
        
        
        if (!$tbl) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Teacher:viewmateri.html.twig', array('tbl' => $tbl, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Teacher:viewmateri.html.twig', array('tbl' => $tbl));
        //return $this->render('SifoMainBundle:Teacher:viewmateri.html.twig');
    }
    
    public function createmateriAction(Request $request)
    {
        if($request->getMethod()=='POST'){
            $judul=$request->get('judul');
            $isi=$request->get('isi');
            $kelas=$request->get('kelas');
            $guru=$request->get('guru');
            
            $c = new TblMateri();
            //$dateTime = new \DateTime();
            $c->setJudul($judul);
            $c->setIsi($isi);
            $c->setKelas($kelas);
            $c->setTanggal(new \DateTime("now"));
            $c->setGuru($guru);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($c);
            $em->flush();
            return $this->redirect($this->generateUrl('sifo_viewmateri'));
        }
        $kelas = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:Kelas')
                      ->findAll();
        
        if (!$kelas) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Teacher:createmateri.html.twig', array('kelas' => $kelas, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Teacher:createmateri.html.twig', array('kelas' => $kelas, 'message' => 'berhasil disimpan'));
        
        //return $this->render('SifoMainBundle:Teacher:createmateri.html.twig');
    }
    
    public function editmateriAction(Request $request, $id)
    {
        $materi = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:TblMateri')
                                ->find($id);
        
        $kelas = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:Kelas')
                      ->findAll();
        
        if (!$materi) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Teacher:createmateri.html.twig', array('kelas' => $kelas, 'error' => 'data tidak tersedia'));
        }
            if($request->getMethod()=='POST'){
                $judul = $request->get('judul');
                $isi = $request->get('isi');
                $kelas = $request->get('kelas');
                
                $materi->setJudul($judul);
                $materi->setIsi($isi);
                $materi->setKelas($kelas);
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('sifo_viewmateri'));
            }
        return $this->render('SifoMainBundle:Teacher:editmateri.html.twig', array('kelas' => $kelas, 'materi' => $materi, 'message' => 'berhasil disimpan'));
        
        //return $this->render('SifoMainBundle:Teacher:createmateri.html.twig');
    }
    
    public function deletemateriAction(Request $request, $id)
    {
        $materi = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:TblMateri')
                                ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($materi);
        $em->flush();
           
        return $this->redirect($this->generateUrl('sifo_viewmateri'));
        
        //return $this->render('SifoMainBundle:Teacher:createmateri.html.twig');
    }
}
