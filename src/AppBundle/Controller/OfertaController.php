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
use AppBundle\Document\MateriaOferta;


class OfertaController extends FosRestController
{
     /**
     * @Rest\Get("/api/oferta/{mail}")
     */
    public function getAction($mail)
    {
        // $service = $this->get(OfertaService::class);
        // $restresult = json_decode($service->getOferta());
        $dm = $this->get('doctrine_mongodb')->getManager();
        $oferta = $dm->getRepository('AppBundle:Oferta')->findAll()[0];
        $restresult['oferta'] = $oferta->getMaterias();
        $restresult['token'] = uniqid();
        if ($restresult === null) {
            return new View("No existe una oferta", Response::HTTP_NOT_FOUND);
        }

        // $this->sendMail($mail, $restresult->token);

        return new View($restresult, Response::HTTP_OK);
    }


    // {
    //   "oferta": [
    //     {
    //       "id": 1,
    //       "nombre": "Introduccion a la programacion",
    //       "orden": 1,
    //       "comisiones": [
    //         {
    //           "comision_id": 1,
    //           "nombre": "Comision 1",
    //           "horario": {
    //             "dias": [
    //               "martes, viernes"
    //             ],
    //             "hora": [
    //               "16:00 a 18:00",
    //               "18:00 a 21:00"
    //             ]
    //           }
    //         },
    //         {
    //           "comision_id": 2,
    //           "nombre": "Comision 2",
    //           "horario": {
    //             "dias": [
    //               "jueves",
    //               "sabado"
    //             ],
    //             "hora": [
    //               "17:00 a 19:00",
    //               "08:00 a 13:00"
    //             ]
    //           }
    //         }
    //       ],
    //       "aprobada": true
    //     }]
    // }

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
