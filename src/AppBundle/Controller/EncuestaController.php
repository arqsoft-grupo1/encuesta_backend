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

class EncuestaController extends Controller
{
	 /**
	 * @Rest\Post("/api/encuesta")
	 */
	 public function postAction(Request $request)
	 {
		$service = new EncuestaService();
		$data = new Encuesta;

		$legajo = $request->get('legajo');
		$encuesta = $request->get('encuesta');

		if(empty($name) || empty($role))
		{
			return new View("Los datos son requeridos", Response::HTTP_NOT_ACCEPTABLE);
		}

		$data->setLegajo($legajo);
		$data->setEncuesta($encuesta);

		$service->guardarEncuesta($data);


		return new View("User Added Successfully", Response::HTTP_OK);
	 }




}
