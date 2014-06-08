<?php

namespace Sifo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sifo\AdminBundle\Modals\Login;
use Sifo\AdminBundle\Entity\FosUser;
use Sifo\AdminBundle\Entity\Admin;
use Sifo\AdminBundle\Entity\Kelas;

class AdminController extends Controller {
    
    public function editkelasAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                   
                    $kelas = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:Kelas')
                                ->find($id);
                            if (!$kelas) {
                              throw $this->createNotFoundException('No product found for id '.$id);
                                //return $this->render('SifoAdminBundle:Admin:editkelas.html.twig', array('name' => $user->getFirstName(), 'kelas' => $kelas, 'error' => 'data tidak tersedia'));
                            }
                            if($request->getMethod()=='POST'){
                                    $kode=$request->get('kode');
                                    $name=$request->get('nama');
                                    
                                    $kelas->setKodeKelas($kode);
                                    $kelas->setNamaKelas($name);
                                    
                                    $em->flush();
                                    return $this->redirect($this->generateUrl('admin_datakelas'));
                            }
                    return $this->render('SifoAdminBundle:Admin:editkelas.html.twig', array('name' => $user->getFirstName(),'kelas' => $kelas));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function editguruAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                   
                    $guru = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:FosUser')
                                ->find($id);
                    
                    $kelas = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:Kelas')
                                ->findAll();
                    
                    if (!$guru) {
                        throw $this->createNotFoundException('No product found for id '.$id);
                        //return $this->render('SifoAdminBundle:Admin:editkelas.html.twig', array('name' => $user->getFirstName(), 'kelas' => $kelas, 'error' => 'data tidak tersedia'));
                    }
                            if($request->getMethod()=='POST'){
                                    $userManager = $this->get('fos_user.user_manager');
                                    $username = $request->get('username');
                                    $email = $request->get('email');
                                    $kelas = $request->get('kelas[]');
                                    
                                    //$guru = $userManager->createUser();
                                    //$guru->setPlainPassword($password);
                                    //$userManager->updatePassword($user);
                                    $guru->setUsername($username);
                                    $guru->setEmail($email);
                                    $guru->setClass($kelas);
                                    $em->flush();
                                    return $this->redirect($this->generateUrl('admin_dataguru'));
                            }
                    return $this->render('SifoAdminBundle:Admin:editguru.html.twig', array('name' => $user->getFirstName(),'guru' => $guru, 'kelas' => $kelas));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function editsiswaAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                   
                    $siswa = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:FosUser')
                                ->find($id);
                    
                    $kelas = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:Kelas')
                                ->findAll();
                    
                    if (!$siswa) {
                        throw $this->createNotFoundException('No product found for id '.$id);
                        //return $this->render('SifoAdminBundle:Admin:editkelas.html.twig', array('name' => $user->getFirstName(), 'kelas' => $kelas, 'error' => 'data tidak tersedia'));
                    }
                            if($request->getMethod()=='POST'){
                                    $userManager = $this->get('fos_user.user_manager');
                                    $email = $request->get('email');
                                    $jurusan = $request->get('jurusan');
                                    $kelas = $request->get('kelas');
                                    
                                    //$guru = $userManager->createUser();
                                    //$userManager->updatePassword($user);
                                    $siswa->setEmail($email);
                                    $siswa->setJurusan($jurusan);
                                    $siswa->setClass($kelas);
                                    $em->flush();
                                    return $this->redirect($this->generateUrl('admin_datasiswa'));
                            }
                    return $this->render('SifoAdminBundle:Admin:editsiswa.html.twig', array('name' => $user->getFirstName(),'siswa' => $siswa, 'kelas' => $kelas));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function deleteguruAction(Request $request, $id)
    {
        $guru = $this->getDoctrine()
                     ->getRepository('SifoAdminBundle:FosUser')
                     ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($guru);
        $em->flush();
           
        return $this->redirect($this->generateUrl('admin_dataguru'));
    }
    
    public function deletesiswaAction(Request $request, $id)
    {
        $siswa = $this->getDoctrine()
                     ->getRepository('SifoAdminBundle:FosUser')
                     ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($siswa);
        $em->flush();
           
        return $this->redirect($this->generateUrl('admin_datasiswa'));
    }
    
    public function deleteadminAction(Request $request, $id)
    {
        $admin = $this->getDoctrine()
                     ->getRepository('SifoAdminBundle:Admin')
                     ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($admin);
        $em->flush();
           
        return $this->redirect($this->generateUrl('admin_dataadmin'));
    }
}