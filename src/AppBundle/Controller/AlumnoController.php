<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use AppBundle\Document\Director as Director;

class AlumnoController extends Controller{

    /**
    * @Rest\Put("/api/alumno/{legajo}/{mail}")
    */
    public function updateAction(Request $request, $legajo, $mail)
    {
       $dm = $this->get('doctrine_mongodb')->getManager();
       $alumno =  $dm->getRepository('AppBundle:Alumno')->findOneBy(array('legajo' => +$legajo));
       if ($alumno === null) {
           return new View(array("respuesta" => +$legajo), Response::HTTP_NOT_FOUND);
       }

       $alumno->setMail($mail);


       $dm->persist($alumno);
       $dm->flush();
       return new View($alumno, Response::HTTP_OK);
    }

    /**
    * @Rest\Get("/api/alumno/{token}")
    */
    public function getAction($token){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $alumno =  $dm->getRepository('AppBundle:Alumno')->findOneBy(array('token' => $token));
        if ($alumno === null) {
            return new View(array("respuesta" => "No existe el alumno"), Response::HTTP_NOT_FOUND);
        }
        return new View(array("alumno" => $alumno), Response::HTTP_OK);
    }
}
