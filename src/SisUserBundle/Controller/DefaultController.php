<?php

namespace SisUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SisUserBundle:Default:index.html.twig');
    }
}
