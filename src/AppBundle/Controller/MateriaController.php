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

class MateriaController extends Controller
{
    /**
    * @Rest\Get("/api/materia/")
    */
    public function getAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $materias =  $dm->getRepository('AppBundle:Materia')->findAll();
        usort($materias, array($this, 'cmpMayorInscriptos'));

        return new View($materias, Response::HTTP_OK);
    }

    /**
    * @Rest\Post("/api/materia")
    */
    public function postAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $materia = new Materia();
        $materia->setOrden(1);
        $materia->setNombre("Base de datos");

        $comision = new Comision();
        $comision->setCupo(30);
        $comision->setNombre("C1");
        $comision->setDiaHorario(array('Martes' => '18 a 22', 'Viernes' => '18 a 22'));
        $comision2 = new Comision();
        $comision2->setCupo(30);
        $comision2->setNombre("C2");
        $comision2->setDiaHorario(array('Lunes' => '18 a 22', 'Jueves' => '18 a 22'));
        $dm->persist($comision);
        $dm->persist($comision2);

        $materia->addComision($comision);
        $materia->addComision($comision2);
        $dm->persist($materia);
        $dm->flush();


        return new View($dm->getRepository('AppBundle:Materia')->findAll(), Response::HTTP_OK);
    }




    function cmpMayorInscriptos($materia1, $materia2) {
        $tmpcomisiones = $materia1->getComisiones();
        usort($tmpcomisiones, array($this, 'ordenarCupoDisponible'));
        $tmp2comisiones = $materia2->getComisiones();
        usort($tmp2comisiones, array($this, 'ordenarCupoDisponible'));
        foreach ($tmpcomisiones as $comision) {
                if($tmpcomisiones[0]->getCupoDisponible() == $tmp2comisiones[0]->getCupoDisponible()) {
                    return 0;
                }

                return ($tmpcomisiones[0]->getCupoDisponible() > $tmp2comisiones[0]->getCupoDisponible() ? -1 : 1);
        }

    }

    function ordenarCupoDisponible($comision1, $comision2){
        if ($comision1->getCupoDisponible() == $comision2->getCupoDisponible()) {
            return 0;
        }
        return ($comision2->getCupoDisponible() < $comision1->getCupoDisponible() ? -1 : 1);
    }

}
