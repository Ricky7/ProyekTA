<?php

namespace Sifo\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SifoMainBundle::layout.html.twig');
    }
    
    public function studentAction()
    {
        return $this->render('SifoMainBundle:Student:index.html.twig');
    }
    
    public function teacherAction()
    {
        return $this->render('SifoMainBundle:Teacher:index.html.twig');
    }
    
}
