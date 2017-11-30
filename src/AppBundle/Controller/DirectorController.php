<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use AppBundle\Document\Director as Director;

class DirectorController extends Controller{

    /**
    * @Rest\Get("/api/director/{email}")
    */
    public function getAction($email){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $director =  $dm->getRepository('AppBundle:Director')->findOneBy(array('email' => $email));
        if ($director === null) {
            // return new View("No existe el director", Response::HTTP_NOT_FOUND);
        }
        return new View($director, Response::HTTP_OK);
    }

}
