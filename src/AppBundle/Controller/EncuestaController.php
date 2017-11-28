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
use AppBundle\Document\Encuesta as Encuesta;
use AppBundle\Document\Materia as Materia;
use AppBundle\Document\Comision as Comision;
use AppBundle\Document\MateriaEncuesta as MateriaEncuesta;

class EncuestaController extends Controller
{
	private function generarEncuesta($encuesta, $materias) {
		$tmpmaterias = [];
		foreach ($materias as $tmpMateria) {
			$dm = $this->get('doctrine_mongodb')->getManager();
			$materia = $dm->getRepository('AppBundle:Materia')->findOneBy(array('nombre' => $tmpMateria['nombre']));
			$matEncuesta = new MateriaEncuesta();
			$matEncuesta->setMateria($materia);

			if(array_key_exists('comisionElegida', $tmpMateria)) {
				$tmpComisionElegida = $dm->getRepository('AppBundle:Comision')->findOneBy(array('comision_id' => $tmpMateria['comisionElegida']));
				$matEncuesta->setComisionElegida($tmpComisionElegida);
			}

			$tmpmaterias[] = $matEncuesta;
		}

		return $tmpmaterias;
	}
	private function completarEncuesta($encuesta, $request) {
		// Agrega materias aprobadas en la encuesta //
		$materias_aprobadas = $request->get('materias_aprobadas');
		$mat_aprob = $this->generarEncuesta($encuesta, $materias_aprobadas);
		$encuesta->setMateriasAprobadas($mat_aprob);

		//Agrega materias "todaviano" en la encuesta //
		$materias_todaviano = $request->get('materias_todaviano');
		$mat_todaviano = $this->generarEncuesta($encuesta, $materias_todaviano);
		$encuesta->setMateriasTodaviaNo($mat_todaviano);

		// Agrega materias "nopuedohorario" en la encuesta //
		$materias_nopuedohorario = $request->get('materias_no_puedoporhorario');
		$mat_nopuedohorario = $this->generarEncuesta($encuesta, $materias_nopuedohorario);
		$encuesta->setMateriasNoPuedoporhorario($mat_nopuedohorario);

		// Agrega materias "nopuedohorario" en la encuesta //
		$materias_a_cursar = $request->get('materias_a_cursar');
		$mat_a_cursar = $this->generarEncuesta($encuesta, $materias_a_cursar);
		$encuesta->setMateriasACursar($mat_a_cursar);

		return $encuesta;
	}
	 /**
	 * @Rest\Post("/api/encuesta/{token}")
	 */
	 public function postAction(Request $request, $token)
	 {
		$dm = $this->get('doctrine_mongodb')->getManager();
		$tmpEncuesta =  $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('token' => $token));
		if (is_null($tmpEncuesta)) {
			// $service = new EncuestaService();
			$service = $this->get(EncuestaService::class);
			$encuesta = new Encuesta();

			$encuesta->setToken($token);

			$encuesta = $this->completarEncuesta($encuesta, $request);

			$dm->persist($encuesta);
			$dm->flush();
			return new View($encuesta, Response::HTTP_OK);
		} else {
			return new View($tmpEncuesta, Response::HTTP_OK);

		}
	 }

	 /**
	 * @Rest\Get("/api/encuesta/{token}")
	 */
	 public function tokenAction($token)
	 {
		//  $e = new DEncuesta();
		//  $e->setLegajo("123");
		//  $dm = $this->get('doctrine_mongodb')->getManager();
	    //  $dm->persist($e);
		//  $dm->flush();
		//  return new View($e->getId(), Response::HTTP_OK);
		//  var_dump($token);

		//  $service = $this->get(EncuestaService::class);
		//  $restresult = json_decode($service->getEncuestaByToken($token));
		//  if ($restresult === null) {
		// 	 return new View("No existe una encuesta relacionada al token", Response::HTTP_NOT_FOUND);
		//  }
		//  return new JsonResponse($restresult);

	 }



	 /**
	* @Rest\Put("/api/encuesta/{token}")
	*/
	public function updateAction(Request $request, $token)
	{
		// $service = $this->get(EncuestaService::class);
		$dm = $this->get('doctrine_mongodb')->getManager();
		$encuesta = $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('token' => $token));
		if (empty($encuesta)) {
		    return new View("La encuesta no ha sido respondida aun", Response::HTTP_NOT_FOUND);
		}
		$encuesta = $this->completarEncuesta($encuesta, $request);

		return new View($encuesta, Response::HTTP_OK);
		// $legajo = $request->get('legajo');
		// $encuesta = $request->get('encuesta');
		// // Devuelve la encuesta guardada para dicho Legajo //
		// $encuesta_guardada = $service->getEncuestaByLegajo($legajo);
		//

		// {
		// 	$encuesta_guardada->setLegajo($legajo);
		// 	$encuesta_guardada->setEncuesta($encuesta);
		//
		// 	$servicio->guardarEncuesta();
		//
		// }
	}
}
