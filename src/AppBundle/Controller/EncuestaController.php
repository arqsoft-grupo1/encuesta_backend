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
use AppBundle\Services\EncuestaService;
use AppBundle\Entity\Encuesta;
use AppBundle\Document\Encuesta as DEncuesta;

class EncuestaController extends Controller
{
	 /**
	 * @Rest\Post("/api/encuesta")
	 */
	 public function postAction(Request $request)
	 {
		// $service = new EncuestaService();
		$service = $this->get(EncuestaService::class);
		$data = new Encuesta();

		$legajo = $request->get('legajo');
		$encuesta = $request->get('encuesta');

		if(empty($legajo) || empty($encuesta))
		{
			return new View("Los datos son requeridos", Response::HTTP_NOT_ACCEPTABLE);
		}

		$data->setLegajo($legajo);
		$data->setEncuesta($encuesta);

		$service->guardarEncuesta($data);


		return new View("Se creo correctamente la encuesta", Response::HTTP_OK);
	 }

	 /**
	 * @Rest\Get("/api/encuesta/{token}")
	 */
	 public function tokenAction($token)
	 {
		 $e = new DEncuesta();
		 $e->setLegajo("123");
		 $dm = $this->get('doctrine_mongodb')->getManager();
	     $dm->persist($e);
		 $dm->flush();
		 return new View($e->getId(), Response::HTTP_OK);
		//  var_dump($token);

		//  $service = $this->get(EncuestaService::class);
		//  $restresult = json_decode($service->getEncuestaByToken($token));
		//  if ($restresult === null) {
		// 	 return new View("No existe una encuesta relacionada al token", Response::HTTP_NOT_FOUND);
		//  }
		//  return new JsonResponse($restresult);

	 }



	 /**
	* @Rest\Put("/api/encuesta/{id}")
	*/
	public function updateAction($id,Request $request)
	{
		$service = new EncuestaService();
		$data = new Encuesta;
		$legajo = $request->get('legajo');
		$encuesta = $request->get('encuesta');
		// Devuelve la encuesta guardada para dicho Legajo //
		$encuesta_guardada = $service->getEncuestaByLegajo($legajo);

		if (empty($encuesta_guardada)) {
		    return new View("La encuesta no ha sido respondida aun", Response::HTTP_NOT_FOUND);
		} elseif(!empty($legajo) && !empty($encuesta))
		{
			$encuesta_guardada->setLegajo($legajo);
			$encuesta_guardada->setEncuesta($encuesta);

			$servicio->guardarEncuesta();
			return new View("Se actualizo correctamente la encuesta", Response::HTTP_OK);
		}
	}
}
