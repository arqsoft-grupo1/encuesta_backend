<?php

namespace EncuestaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EncuestaBundle:Default:index.html.twig');
    }
}
