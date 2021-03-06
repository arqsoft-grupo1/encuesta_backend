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
use AppBundle\Services\OfertaService;
use AppBundle\Document\Oferta;
use AppBundle\Document\Encuesta;
use AppBundle\Document\MateriaOferta;
use AppBundle\Document\MateriaEncuesta;


class OfertaController extends FosRestController
{
    /**
    * Crea la Oferta academica general
    * @Rest\Post("/api/oferta")
    */
    public function postAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $oferta = new Oferta();
        $materias = $dm->getRepository('AppBundle:Materia')->findAll();
        foreach ($materias as $materia) {
            $materia_oferta = new MateriaOferta();
            $materia_oferta->addMaterium($materia);
            $oferta->addMateria($materia);
        }
        $dm->persist($oferta);
        $dm->flush();


        return new View($dm->getRepository('AppBundle:Oferta')->findAll(), Response::HTTP_OK);
    }

    /**
    * Genera la oferta solicitada y le setea el token
    * Armando los tres grupos de materias, aprobadas, a cursar y
    * no voy a cursar para dicho legajo
    * @Rest\Put("/api/oferta/{token}")
    */
   public function putAction($token)
   {
       $dm = $this->get('doctrine_mongodb')->getManager();
       $encuesta = $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('token' => $token));
       $alumno = $dm->getRepository('AppBundle:Alumno')->findOneBy(array('token' => $token));

       if(!is_null($alumno)) {
           if (is_null($encuesta)) {
               $encuesta = new Encuesta();
               $encuesta->setToken($token);
               $dm->persist($encuesta);
               $dm->flush();

               $oferta = new Oferta();
               $this->generarPrimerOfertaDeLaCarrera($encuesta, $oferta, $token);

               return new View(array("oferta"=> $oferta->getMaterias()), Response::HTTP_OK);
           } else {
               if($this->ExisteEncuestaCompleta($encuesta)) {
                   /*Modificacion de encuesta*/
                   $oferta = new Oferta();
                   $this->generarOfertaConEncuestaModificacion($encuesta, $oferta);
                   return new View(array("oferta"=> $oferta->getMaterias()), Response::HTTP_OK);
               } else {
                   /*Genera la primer oferta de la carrera, ya que no existen anteriores ni actuales*/
                   $oferta = new Oferta();
                   $this->generarPrimerOfertaDeLaCarrera($encuesta, $oferta, $token);
                   return new View(array("oferta"=> $oferta->getMaterias()), Response::HTTP_OK);
               }

               return new View(array("respuesta"=> "Hay encuesta"), Response::HTTP_OK);
           }
       } else {
           return new View("No existe el alumno", Response::HTTP_NOT_FOUND);
       }

   }
    /**
    * Devuelve el token generado para el email solicitante
    * A su vez envia el mail correspondiente a la encuesta al mail que lo solicitante
    *
    * @Rest\Get("/api/oferta/token/{mail}")
    */
    public function getTokenAction($mail) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $alumno = $dm->getRepository('AppBundle:Alumno')->findOneBy(array('mail' => $mail));
        /*
            Valida que el mail se encuentre registrado para un alumno en la base de datos, de lo
            contrario retorna Not Found
        */
        if (is_null($alumno)) {
            return new View(array("estado"=> "Alumno inexistente"), Response::HTTP_NOT_FOUND);
        } else {
            if(is_null($alumno->getToken())) {
                $token = uniqid();
                $alumno->setToken($token);
                $dm->persist($alumno);
                $dm->flush();
            }

            //$this->sendMail($mail, $alumno->getToken());

            return new View($alumno->getToken(), Response::HTTP_OK);
        }
    }
    private function ExisteEncuestaCompleta($encuesta) {
        if (is_null($encuesta)) {
            return false;
        }
        if ($encuesta->getCuatrimestre() == '') {
            return false;
        }
        return true;
    }


    private function generarOfertaDesdeEncuestaAnterior($oferta, $encuesta_anterior) {
        $token = uniqid();
        $this->agregarMateriasAOferta($oferta, $encuesta_anterior->getMateriasAprobadas(), 'yaaprobe');
        $this->agregarMateriasAOferta($oferta, $encuesta_anterior->getMateriasACursar(), 'todaviano');
        $this->agregarMateriasAOferta($oferta, $encuesta_anterior->getMateriasTodaviano(), 'todaviano');
        $this->agregarMateriasAOferta($oferta, $encuesta_anterior->getMateriasNoPuedoporhorario(), 'todaviano');
        $restresult['oferta'] = $oferta->getMaterias();
        $restresult['token'] = $token;

        return $restresult;
    }

    private function generarPrimerOfertaDeLaCarrera($encuesta, $oferta, $token) {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $materias = $dm->getRepository('AppBundle:Materia')->findAll();
        foreach ($materias as $materia) {
            $materia->setEstado('todaviano');
            $oferta->addMateria($materia);
            $materiaEncuesta = new materiaEncuesta();
            $materiaEncuesta->setMateria($materia);
            $materiaEncuesta->setEstado('todaviano');
            $encuesta->addMateriasTodaviano($materiaEncuesta);
        }
        $encuesta->setCuatrimestre('2017C2');

        $dm->persist($encuesta);
        $dm->flush();

        $restresult['oferta'] = $oferta->getMaterias();
        $restresult['token'] = $token;


        return $restresult;
    }

    private function generarOfertaConEncuestaModificacion($encuesta_guardada, $oferta) {
        /* Si llega aca es porque ya respondio la encuesta en este cuatrimestre por lo cual la editaria */
        $token = $encuesta_guardada->getToken();
        /*Arma la oferta en base a la encuesta anterior*/
        $this->agregarMateriasAOferta($oferta, $encuesta_guardada->getMateriasAprobadas(), 'yaaprobe');
        $this->agregarMateriasAOferta($oferta, $encuesta_guardada->getMateriasACursar(), 'voyacursar');
        $this->agregarMateriasAOferta($oferta, $encuesta_guardada->getMateriasTodaviano(), 'todaviano');
        $this->agregarMateriasAOferta($oferta, $encuesta_guardada->getMateriasNoPuedoporhorario(), 'nopuedohorario');


        return array('oferta' => $oferta->getMaterias(), 'token'=> $token);
    }

    private function agregarMateriasAOferta($oferta, $materias, $estado) {
        foreach ($materias as $materia) {
            if(!is_null($materia->getMateria())) {
                $materia->getMateria()->setEstado($estado);
                $oferta->addMateria($materia->getMateria());
            }
        }
    }

// <a href='http://arq-soft-encuesta-frontend.herokuapp.com/encuesta/$token' target='_blank' rel='noreferrer'>
    public function sendMail($mail, $token)
       {
           $message = (new \Swift_Message('Encuesta UNQ'))
                           ->setSubject('')
                           ->setFrom('admin_encuesta@gmail.com')
                           ->setTo($mail)
                           ->setBody("
                                <span lang='ES-AR'>
                                    <a href='http://arq-soft-encuesta-frontend.herokuapp.com/encuesta/$token' target='_blank' rel='noreferrer'>
                                    <b>
                                        <span style='font-size: 16.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;; color: #0070C0'>
                                            CLICK AQUÍ: ACCESO A LA ENCUESTA
                                        </span>
                                    </b>
                                    </a>
                                </span>"
                           , 'text/html');
           $this->get('mailer')->send($message);

       }


     public function hayEncuestaGuardadaEnCuatrimestre($encuesta_guardada){
         return !is_null($encuesta_guardada);
     }

     public function tieneEncuestaAnterior($encuesta_anterior){
         return !is_null($encuesta_anterior);
     }

}
