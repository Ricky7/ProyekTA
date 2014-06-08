<?php

namespace Sifo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sifo\AdminBundle\Modals\Login;
use Sifo\AdminBundle\Entity\FosUser;
use Sifo\AdminBundle\Entity\Admin;
use Sifo\AdminBundle\Entity\Kelas;
use Sifo\AdminBundle\Entity\TblBerita;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        if ($request->getMethod() == 'POST') {
            $session->clear();
            $username = $request->get('username');
            $password = $request->get('password');
            $remember = $request->get('remember');
            $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
            if ($user) {
                if ($remember == 'remember-me') {
                    $login = new login();
                    $login->setUsername($username);
                    $login->setPassword($password);
                    $session->set('login', $login);
                }
                return $this->render('SifoAdminBundle:Admin:adminhome.html.twig', array('name' => $user->getFirstName()));
            } else {
                return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Login Error!!'));
            }
        } else {
            if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                    return $this->render('SifoAdminBundle:Admin:adminhome.html.twig', array('name' => $user->getFirstName()));
                }
            }
        }
        return $this->render('SifoAdminBundle:Default:index.html.twig');
    }

    public function adminlogoutAction(Request $request) {
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Logout berhasil'));
    }

    public function signupAction(Request $request) {
        if($request->getMethod()=='POST'){
            $user = new FosUser();
            $userManager = $this->get('fos_user.user_manager');
            $username = $request->get('username');
            //$usernameCanonical = $request->get('username');
            $password = $request->get('password');
            $email = $request->get('email');
            $roles = $request->get('roles');

            $user = $userManager->createUser();
            $user->setUsername($username);
            $user->setPlainPassword($password);
            $userManager->updatePassword($user);
            $user->setEmail($email);
            $user->setEnabled(true);
            $user->setRoles(array($roles));

            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        
        return $this->render('SifoAdminBundle:Admin:adminhome.html.twig');
    }
    
    public function adminhomeAction(Request $request) 
    {
        //$session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                    return $this->render('SifoAdminBundle:Admin:adminhome.html.twig', array('name' => $user->getFirstName()));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function dataguruAction(Request $request) 
    {
        if($request->getMethod()=='POST'){
            $user = new FosUser();
            $userManager = $this->get('fos_user.user_manager');
            $username = $request->get('username');
            $password = $request->get('password');
            $name = $request->get('name');
            $nip = $request->get('nip');
            $email = $request->get('email');
            $roles = $request->get('roles');
            $mapel = $request->get('mapel');
            $grup = $request->get('grup');
            
            $user = $userManager->createUser();
            $user->setUsername($username);
            $user->setPlainPassword($password);
            $userManager->updatePassword($user);
            
            $user->setEmail($email);
            $user->setEnabled(true);
            $user->setRoles(array($roles));
            $user->setName($name);
            $user->setNoId($nip);
            $user->setMataPelajaran($mapel);
            $user->setGrup($grup);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        //return $this->render('SifoAdminBundle:Default:dataguru.html.twig');
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
                                ->findByGrup('guru');
                    
                    if (!$guru) {
                        //throw $this->createNotFoundException('No data found');
                        return $this->render('SifoAdminBundle:Admin:dataguru.html.twig', array('name' => $user->getFirstName(), 'guru' => $guru, 'kelas' => $kelas, 'error' => 'data tidak tersedia'));
                    }
                }
                return $this->render('SifoAdminBundle:Admin:dataguru.html.twig', array('name' => $user->getFirstName(),'guru' => $guru));
                
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
        
    }
    
    public function datasiswaAction(Request $request) 
    {
        if($request->getMethod()=='POST'){
            $user = new FosUser();
            $userManager = $this->get('fos_user.user_manager');
            $username = $request->get('username');
            $password = $request->get('password');
            $name = $request->get('name');
            $nis = $request->get('nis');
            $email = $request->get('email');
            $roles = $request->get('roles');
            $jurusan = $request->get('jurusan');
            $grup = $request->get('grup');
            $kelas = $request->get('kelas');

            $user = $userManager->createUser();
            $user->setUsername($username);
            $user->setPlainPassword($password);
            $userManager->updatePassword($user);
            $user->setEmail($email);
            $user->setEnabled(true);
            $user->setRoles(array($roles));
            $user->setName($name);
            $user->setNoId($nis);
            $user->setJurusan($jurusan);
            $user->setGrup($grup);
            $user->setClass($kelas);
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
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
                                ->findByGrup('siswa');
                    
                    $kelas = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:Kelas')
                                ->findAll();
                    
                    if (!$siswa) {
                        //throw $this->createNotFoundException('No data found');
                        return $this->render('SifoAdminBundle:Admin:datasiswa.html.twig', array('name' => $user->getFirstName(), 'siswa' => $siswa, 'error' => 'data tidak tersedia'));
                    }
                    return $this->render('SifoAdminBundle:Admin:datasiswa.html.twig', array('name' => $user->getFirstName(),'siswa' => $siswa, 'kelas' => $kelas));
                }
        }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function datakelasAction(Request $request) 
    {
        if($request->getMethod()=='POST'){
            $kode=$request->get('kode');
            $name=$request->get('nama');
            
            $user = new Kelas();
            $user->setKodeKelas($kode);
            $user->setNamaKelas($name);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
        }
        
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
                                ->findAll();
                    if (!$kelas) {
                        //throw $this->createNotFoundException('No data found');
                        return $this->render('SifoAdminBundle:Admin:datakelas.html.twig', array('name' => $user->getFirstName(), 'kelas' => $kelas, 'error' => 'data tidak tersedia'));
                    }
                    return $this->render('SifoAdminBundle:Admin:datakelas.html.twig', array('name' => $user->getFirstName(),'kelas' => $kelas));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function databeritaAction(Request $request) 
    {
        if($request->getMethod()=='POST'){
            $judul=$request->get('judul');
            $isi=$request->get('isi');
            $sumber=$request->get('sumber');
            
            $c = new TblBerita();
            $c->setJudul($judul);
            $c->setIsi($isi);
            $c->setSumber($sumber);
            $c->setTanggal(new \DateTime("now"));
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($c);
            $em->flush();
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                    
                    $berita = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:TblBerita')
                                ->findAll();
                    if (!$berita) {
                        //throw $this->createNotFoundException('No data found');
                        return $this->render('SifoAdminBundle:Admin:databerita.html.twig', array('name' => $user->getFirstName(),'error' => 'data tidak tersedia'));
                    }
                    return $this->render('SifoAdminBundle:Admin:databerita.html.twig', array('name' => $user->getFirstName(), 'berita' => $berita));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function deleteberitaAction(Request $request, $id)
    {
        $berita = $this->getDoctrine()
                     ->getRepository('SifoAdminBundle:TblBerita')
                     ->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($berita);
        $em->flush();
           
        return $this->redirect($this->generateUrl('admin_databerita'));
    }
    
    public function dataadminAction(Request $request) 
    {
        if($request->getMethod()=='POST'){
            $username=$request->get('username');
            $firstname=$request->get('firstname');
            $password=$request->get('password');
            
            $user = new Admin();
            $user->setFirstName($firstname);
            $user->setPassword($password);
            $user->setUserName($username);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
            
        }
        
        //return $this->render('SifoAdminBundle:Admin:dataadmin.html.twig');
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                    
                    $admin = $this->getDoctrine()
                                ->getRepository('SifoAdminBundle:Admin')
                                ->findAll();
                            if (!$admin) {
                              //throw $this->createNotFoundException('No data found');
                                return $this->render('SifoAdminBundle:Admin:dataadmin.html.twig', array('name' => $user->getFirstName(), 'admin' => $admin, 'error' => 'data tidak tersedia'));
                            }
                    return $this->render('SifoAdminBundle:Admin:dataadmin.html.twig', array('name' => $user->getFirstName(),'admin' => $admin));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
        
}
