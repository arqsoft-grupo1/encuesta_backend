<?php

namespace OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;

class OfertaController extends Controller
{
     /**
     * @Rest\Get("/api/oferta")
     */
    public function getAction()
    {
        // $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        //$restresult deberia devolver el string que contiene oferta.json
        $appPath = $this->getParameter('kernel.root_dir');
        $file = realpath($appPath . '/../var/oferta.json');
        $restresult = file_get_contents($file);
        // $restresult = '[{"id":1,"name":"tony","role":"community manager"},{"id":2,"name":"sandy","role":"digital content producer"}]';
        if ($restresult === null) {
            return new View("No existe una oferta", Response::HTTP_NOT_FOUND);
        }
        // return $restresult;
        return new JsonResponse(json_decode($restresult));
    }

    /**
	 * @Rest\Get("/api/oferta/{id}")
	 */
	 public function idAction($id)
	 {
    	//    $singleresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
    	//    if ($singleresult === null) {
    	//           return new View("user no encontrado", Response::HTTP_NOT_FOUND);
    	//    }
        //    return $singleresult;

	 }

}
