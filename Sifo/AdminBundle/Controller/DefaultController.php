<?php

namespace Sifo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sifo\AdminBundle\Modals\Login;
use Sifo\AdminBundle\Entity\FosUser;

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
                    return $this->render('SifoAdminBundle:Default:main.html.twig', array('name' => $user->getFirstName()));
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

        //$manager->$this->getDoctrine()->getEntityManager();
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        }
        /* $user = new FosUser();
          $userManager = $this->get('fos_user.user_manager');
          $user = $userManager->createUser();

          $user->setUsername(ucfirst($user->get('username')->getData()));
          $user->setEmail($email);
          $user->setPlainPassword($newform->get('password')->getData());
          $user->setRoles(array($newform->get('roles')->getData()));
          $user->setEnabled($newform->get('enabled')->getData());
          $userManager->updateUser($user);



          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();
          /*if($request->getMethod()=='POST'){
          $username=$request->get('username');
          $usernameCanonical=$request->get('username');
          $password=$request->get('password');
          $email=$request->get('email');
          $emailCanonical=$request->get('email');
          //$enabled=$request->get('enabled');
          $roles=$request->get('roles');
          $salt=$request->get('password');
          $locked=$request->get('locked');
          $expired=$request->get('expired');
          $credentialsExpired=$request->get('credentialsExpired');

          $user = new FosUser();
          $user->setUsername($username);
          $user->setUsernameCanonical($usernameCanonical);
          $user->setPassword(sha($password));
          $user->setEmail($email);
          $user->setEmailCanonical($emailCanonical);
          $user->setEnabled(true);
          $user->setRoles(Array($roles));
          $user->setSalt(sha1($salt));
          $user->setLocked($locked);
          $user->setExpired($expired);
          $user->setCredentialsExpired($credentialsExpired);
          $em=$this->getDoctrine()->getEntityManager();
          $em->persist($user);
          $em->flush();
          } */
        return $this->render('SifoAdminBundle:Default:signup.html.twig');
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
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SifoAdminBundle:Admin');
        $session = $this->getRequest()->getSession();
        if ($session->has('login')) {
                $login = $session->get('login');
                $username = $login->getUsername();
                $password = $login->getPassword();
                $user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
                if ($user) {
                    return $this->render('SifoAdminBundle:Admin:dataguru.html.twig', array('name' => $user->getFirstName()));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function datasiswaAction(Request $request) 
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
                    return $this->render('SifoAdminBundle:Admin:datasiswa.html.twig', array('name' => $user->getFirstName()));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function datakelasAction(Request $request) 
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
                    return $this->render('SifoAdminBundle:Admin:datakelas.html.twig', array('name' => $user->getFirstName()));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    
    public function databeritaAction(Request $request) 
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
                    return $this->render('SifoAdminBundle:Admin:databerita.html.twig', array('name' => $user->getFirstName()));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }
    public function dataadminAction(Request $request) 
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
                    return $this->render('SifoAdminBundle:Admin:dataadmin.html.twig', array('name' => $user->getFirstName()));
                }
            }
        return $this->render('SifoAdminBundle:Default:index.html.twig', array('name' => 'Expired'));
    }

}
