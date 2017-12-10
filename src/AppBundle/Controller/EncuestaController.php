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
	/**
	* @Rest\Put("/api/encuesta/{token}")
	*/
	public function updateAction(Request $request, $token)
	{
	   $dm = $this->get('doctrine_mongodb')->getManager();
	   $encuesta =  $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('token' => $token));

	   $encuesta->setCuatrimestre('2017C2');
	   $encuesta->setLegajo($request->get('legajo'));
	   $encuesta->setToken($token);

	   $encuesta = $this->completarEncuesta($encuesta, $request);

	   $dm->persist($encuesta);
	   $dm->flush();
	   return new View(array("respuesta" => $encuesta), Response::HTTP_OK);
	}

	/**
	* @Rest\Get("/api/encuesta/porcentaje_respuestas/")
	*/
	public function getEncuestasCompletadasSobreAlumnosAction()
	{

		$dm = $this->get('doctrine_mongodb')->getManager();
		$encuestas_respondidas = count($dm->getRepository('AppBundle:Encuesta')->findBy(array('cuatrimestre' => '2017C2')));
		$alumnos_regulares = count($dm->getRepository('AppBundle:Alumno')->findAll());

		$rta = array('encuestas_respondidas'=> $encuestas_respondidas, 'alumnos_regulares' => $alumnos_regulares);

		return new View(array("respuesta" => $rta), Response::HTTP_OK);
	}

	/**
	* @Rest\Get("/api/encuesta/{token}")
	*/
	public function tokenAction($token)
	{
		$dm = $this->get('doctrine_mongodb')->getManager();
		$tmpEncuesta =  $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('token' => $token));

		if ($tmpEncuesta === null) {
			return new View("No existe una encuesta relacionada al token", Response::HTTP_NOT_FOUND);
		}
		return new View(array("respuesta" => $tmpEncuesta), Response::HTTP_OK);
	}

	private function generarEncuesta($encuesta, $materias) {
		$tmpmaterias = [];
		$dm = $this->get('doctrine_mongodb')->getManager();
		$alumno = $dm->getRepository('AppBundle:Alumno')->findOneBy(array('token' => $encuesta->getToken()));
		foreach ($materias as $tmpMateria) {
			$materia = $dm->getRepository('AppBundle:Materia')->findOneBy(array('nombre' => $tmpMateria['nombre']));
			$matEncuesta = new MateriaEncuesta();
			$matEncuesta->setMateria($materia);
			$matEncuesta->setEstado($tmpMateria['estado']);
			if(array_key_exists('comisionElegida', $tmpMateria)) {
				$tmpComisionElegida = $dm->getRepository('AppBundle:Comision')->findOneBy(array('comision_id' => $tmpMateria['comisionElegida']));
				$tmpComisionElegida->addInscripto($alumno);
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
		$materias_nopuedoporhorario = $request->get('materias_no_puedoporhorario');
		$mat_nopuedohorario = $this->generarEncuesta($encuesta, $materias_nopuedoporhorario);
		$encuesta->setMateriasNoPuedoporhorario($mat_nopuedohorario);

		// Agrega materias "nopuedohorario" en la encuesta //
		$materias_a_cursar = $request->get('materias_a_cursar');
		$mat_a_cursar = $this->generarEncuesta($encuesta, $materias_a_cursar);
		$encuesta->setMateriasACursar($mat_a_cursar);

		return $encuesta;
	}
}
