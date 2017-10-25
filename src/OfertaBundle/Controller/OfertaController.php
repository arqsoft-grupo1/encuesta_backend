<?php

namespace OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use OfertaBundle\Services\OfertaService;


class OfertaController extends Controller
{
     /**
     * @Rest\Get("/api/oferta")
     */
    public function getAction()
    {
        $service = new OfertaService();
        $restresult = $service -> getOferta();
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
