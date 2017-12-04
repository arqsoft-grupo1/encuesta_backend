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
        foreach ($materias as $materia) {
            $this->ordenarComisiones($materia->getComisiones()->getValues());
        }
        usort($materias, array($this,'cmpMateriasMenorCupoDisponile'));
        return new View($materias, Response::HTTP_OK);
    }

    function ordenarComisiones($comisiones) {
        return usort($comisiones, array($this, 'cmpComision'));
    }

    function cmpMateriasMenorCupoDisponile($materia1, $materia2) {
        if ($materia1->getComisiones()[0]->getCupoDisponible() == $materia2->getComisiones()[0]->getCupoDisponible()) {
            return 0;
        }
        return ($materia1->getComisiones()[0]->getCupoDisponible() < $materia2->getComisiones()[0]->getCupoDisponible() ? -1 : 1);
    }

    function cmpComision($comision1, $comision2){
        if ($comision1->getCupoDisponible() == $comision2->getCupoDisponible()) {
            return 0;
        }
        return ($comision1->getCupoDisponible() < $comision1->getCupoDisponible() ? -1 : 1);
    }

    /**
    * @Rest\Post("/api/materia")
    */
    public function postAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $materia = new Materia();
        $materia->setOrden(1);
        $materia->setNombre("Introduccion a la programacion");

        $comision = new Comision();
        $comision->setCupo(30);
        $comision->setComisionId(1);
        $comision->setNombre("C1");
        $comision->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision2 = new Comision();
        $comision2->setCupo(30);
        $comision2->setComisionId(4);
        $comision2->setNombre("C2");
        $comision2->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $dm->persist($comision);
        $dm->persist($comision2);

        $materia->addComision($comision);
        $materia->addComision($comision2);
        $dm->persist($materia);
        $dm->flush();


        return new View($dm->getRepository('AppBundle:Materia')->findAll(), Response::HTTP_OK);
    }






}
