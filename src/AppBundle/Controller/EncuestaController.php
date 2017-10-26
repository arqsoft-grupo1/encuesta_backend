<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;

class EncuestaController extends FosRestController
{
	 /**
	 * @Rest\Post("/api/encuesta")
	 */
	 public function postAction(Request $request)
	 {

		return new View("User Added Successfully", Response::HTTP_OK);
	 }




}
