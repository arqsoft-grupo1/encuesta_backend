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

class ComisionController extends Controller
{
    /**
    * @Rest\Get("/api/comision/")
    */
    public function getComisionesPorOrdenInscriptosAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $comisiones =  $dm->getRepository('AppBundle:Comision')->findAll();
        usort($comisiones, array($this, 'cmpInscriptos'));
        return new View($comisiones, Response::HTTP_OK);
    }

    function cmpInscriptos($comision1, $comision2) {
        if ($comision1->getCupoDisponible() == $comision2->getCupoDisponible()) {
            return 0;
        }
        return ($comision2->getCupoDisponible() > $comision1->getCupoDisponible() ? -1 : 1);
    }
}
