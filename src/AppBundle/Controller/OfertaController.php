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


class OfertaController extends FosRestController
{
     /**
     * @Rest\Get("/api/oferta/{mail}")
     */
    public function getAction($mail)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $alumno = $dm->getRepository('AppBundle:Alumno')->findOneBy(array('email' => $mail));

        /*
            Valida que el mail se encuentre registrado para un alumno en la base de datos, de lo
            contrario retorna Not Found
        */
        if (is_null($alumno)) {
            return new View(array("estado"=> "Alumno inexistente"), Response::HTTP_NOT_FOUND);
        } else {

            /* Valida si existe una encuesta para esta persona en este cuatrimestre */
            $oferta = new Oferta();
            $encuesta_guardada  = $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('legajo' => $alumno->getLegajo(), 'cuatrimestre' => '2017C2'));
            if (!$this->hayEncuestaGuardadaEnCuatrimestre($encuesta_guardada)) {
                $encuesta_anterior = $dm->getRepository('AppBundle:Encuesta')->findOneBy(array('legajo' => $alumno->getLegajo()));
                if ($this->tieneEncuestaAnterior($encuesta_anterior)) {
                    /*Su tiene encuesta anterior, en base a las respuestas arma la nueva oferta */
                    $restresult = $this->generarOfertaDesdeEncuestaAnterior($oferta, $encuesta_anterior);
                    return new View($restresult, Response::HTTP_OK);
                } else {
                    /* Si no tiene encuesta anterior genera una nueva encuesta en base a las materias */
                    $restresult = $this->generarPrimerOfertaDeLaCarrera($oferta);
                    // $this->sendMail($mail, $token);
                    return new View($restresult, Response::HTTP_OK);
                }
                // return new View(array("estado"=> "Se creara una nueva Oferta", "token" => $token), Response::HTTP_NOT_FOUND);
            } else  {
                // return new View(array("estado"=> "Esta modificando"), Response::HTTP_OK);
                $restresult = $this->generarOfertaConEncuestaModificacion($encuesta_guardada, $oferta);
                return new View($restresult, Response::HTTP_OK);
            }
        }
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

    private function generarPrimerOfertaDeLaCarrera($oferta) {
        $token = uniqid();
        $dm = $this->get('doctrine_mongodb')->getManager();
        $materias = $dm->getRepository('AppBundle:Materia')->findAll();
        foreach ($materias as $materia) {
            $materia->setEstado('todaviano');
            $oferta->addMateria($materia);
        }

        $restresult['oferta'] = $oferta->getMaterias();
        $restresult['token'] = $token;
        $encuesta = new Encuesta();
        $encuesta->setToken($token);
        $dm->persist($encuesta);
        $dm->flush();

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
        $restresult['oferta'] = $oferta->getMaterias();
        $restresult['token'] = $token;
        return new View($restresult, Response::HTTP_OK);
        return $restresult;
    }

    private function agregarMateriasAOferta($oferta, $materias, $estado) {
        foreach ($materias as $materia) {
            $materia->getMateria()->setEstado($estado);
            $oferta->addMateria($materia->getMateria());
        }
    }

    public function sendMail($mail, $token)
       {
           $message = \Swift_Message::newInstance()
                           ->setSubject('Martin ramos')
                           ->setFrom('admin_encuesta@gmail.com')
                           ->setTo($mail)
                           ->setBody("
                                <span lang='ES-AR'>
                                    <a href='http://arq-sof-encuesta-backend.herokuapp.com/api/encuesta/$token' target='_blank' rel='noreferrer'>
                                    <b>
                                        <span style='font-size: 16.0pt; font-family: &quot;Arial&quot;,&quot;sans-serif&quot;; color: #0070C0'>
                                            CLICK AQUÍ: ACCESO A LA ENCUESTA
                                        </span>
                                    </b>
                                    </a>
                                </span>"
                           , 'text/html');
        //    var_dump($message);
           $this->get('mailer')->send($message);

       }

       /**
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

     public function hayEncuestaGuardadaEnCuatrimestre($encuesta_guardada){
         return !is_null($encuesta_guardada);
     }

     public function tieneEncuestaAnterior($encuesta_anterior){
         return !is_null($encuesta_anterior);
     }

    /**
	 * @Rest\Get("/api/oferta/{id}")
	 */
	 public function idAction($id)
	 {
    	//    $singleresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
    	//    if ($singleresult === null) {
    	//           return new View("user no encontrado", Response::HTTP_NOT_FOUND);
    	//    }
        //    return $singleresult;

	 }

}
