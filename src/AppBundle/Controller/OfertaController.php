<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use AppBundle\Services\OfertaService;


class OfertaController extends FosRestController
{
     /**
     * @Rest\Get("/api/oferta")
     */
    public function getAction()
    {
        $service = $this->get(OfertaService::class);
        $restresult = json_decode($service->getOferta());
        $restresult->token = uniqid();
        if ($restresult === null) {
            return new View("No existe una oferta", Response::HTTP_NOT_FOUND);
        }
        // 59ffa6967fed3
        // return $restresult;
        return new JsonResponse($restresult);
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
