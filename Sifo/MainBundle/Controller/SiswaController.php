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

class SiswaController extends Controller {
    
    public function profilestudentAction()
    {
        return $this->render('SifoMainBundle:Student:profilestudent.html.twig');
    }
    
    public function coursesAction()
    {
        $materi = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblMateri')
                    ->findAll();
                    
        
        if (!$materi) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Student:index.html.twig', array('materi' => $materi, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Student:index.html.twig', array('materi' => $materi));
    }
    
    public function viewcourseAction($id)
    {
        $materi = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblMateri')
                    ->find($id);
        
        if (!$materi) {
            throw $this->createNotFoundException('No data found');
            
        }
        return $this->render('SifoMainBundle:Student:course.html.twig', array('materi' => $materi));
    }
    
    public function listkuisAction()
    {
        $kelas = $this->getUser()->getClass();
        $kuis = $this->getDoctrine()
                    ->getRepository('SifoAdminBundle:TblKuis')
                    ->findBy(array('status' => 'new', 'kelas' => $kelas));
                    
        
        if (!$kuis) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Student:listkuis.html.twig', array('kuis' => $kuis, 'error' => 'data tidak tersedia'));
        }
        return $this->render('SifoMainBundle:Student:listkuis.html.twig', array('kuis' => $kuis));
    }
    
    public function openkuisAction(Request $request, $id)
    {
        $kuis = $this->getDoctrine()
                      ->getRepository('SifoAdminBundle:TblKuis')
                      ->find($id);
        
                
        if (!$kuis) {
            //throw $this->createNotFoundException('No data found');
            return $this->render('SifoMainBundle:Kuis:openkuis.html.twig', array('error' => 'data tidak tersedia'));
        }
        if($request->getMethod()=='POST'){
                $jawaban = $request->get('jawaban');
                $nis = $request->get('nis');
                $user = $request->get('user');
                $name = $request->get('name');
                $status = $request->get('status');
                
                $kuis->setJawaban($jawaban);
                $kuis->setNisSiswa($nis);
                $kuis->setUserSiswa($user);
                $kuis->setNamaSiswa($name);
                $kuis->setStatus($status);
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('sifo_list_kuispage'));
            }
        return $this->render('SifoMainBundle:Student:openkuis.html.twig', array('kuis' => $kuis));
            
    }
}
