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
		foreach ($materias as $tmpMateria) {
			$dm = $this->get('doctrine_mongodb')->getManager();
			$materia = $dm->getRepository('AppBundle:Materia')->findOneBy(array('nombre' => $tmpMateria['nombre']));
			$matEncuesta = new MateriaEncuesta();
			$matEncuesta->setMateria($materia);
			// $tmp = $tmpMateria['comisionElegida']['codigo'];
			$comisionElegida = $dm->getRepository('AppBundle:Comision')->findOneBy(array('codigo'=> $tmpMateria['comisionElegida']));
			$matEncuesta->setComisionElegida($comisionElegida);
			// $encuesta->addMateriasACursar($matEncuesta);
			// $encuesta->addMateriasAprobada($matEncuesta);

		}

		return $encuesta;
	}
	 /**
	 * @Rest\Post("/api/encuesta/{token}")
	 */
	 public function postAction(Request $request, $token)
	 {
		// $service = new EncuestaService();
		$service = $this->get(EncuestaService::class);
		$encuesta = new Encuesta();

		$encuesta->setToken($token);



		// $encuesta->setMateriasACursar($request->get('materias_a_cursar'));
		$materias_a_cursar = $request->get('materias_a_cursar');
		$materias_todaviano = $request->get('materias_todaviano');
		// $materias_aprobadas = $request->get('materias_aprobadas');


		// $tmp2 = $tmpMaterias[0];

		// $this->generarEncuesta($encuesta, $materias_a_cursar);
		$this->generarEncuesta($encuesta, $materias_todaviano);
		// $this->generarEncuesta($encuesta, $materias_aprobadas);
		// foreach ($tmpMaterias as $tmpMateria) {
		// 	$dm = $this->get('doctrine_mongodb')->getManager();
		// 	$materia = $dm->getRepository('AppBundle:Materia')->findOneBy(array('nombre' => $tmpMateria['nombre']));
		// 	$matEncuesta = new MateriaEncuesta();
		// 	$matEncuesta->setMateria($materia);
		// 	// $tmp = $tmpMateria['comisionElegida']['codigo'];
		// 	$comisionElegida = $dm->getRepository('AppBundle:Comision')->findOneBy(array('codigo'=> 2));
		// 	$matEncuesta->setComisionElegida($comisionElegida);
		// 	$encuesta->addMateriasACursar($matEncuesta);
		//
		// }

		$dm = $this->get('doctrine_mongodb')->getManager();
		$dm->persist($encuesta);
		$dm->flush();

		return new View($encuesta, Response::HTTP_OK);
		// return new View("Se creo correctamente la encuesta", Response::HTTP_OK);

	 }

	 function generarComisiones($comisiones) {
		 $tmpComisiones = array();
		 foreach($comisiones as $comision) {
			 $tmpComision = new Comision();
			 $tmpComision->setNombre($comision['nombre']);
			 $tmpComision->setDias($comision['horario']['dias']);
			 $tmpComision->setHora($comision['horario']['hora']);


			 $tmpComisiones[] = $tmpComision;
		 }

		 return $tmpComisiones;

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
