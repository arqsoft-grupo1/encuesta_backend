<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use AppBundle\Services\OfertaService;


class OfertaController extends FosRestController
{
     /**
     * @Rest\Get("/api/oferta/{mail}")
     */
    public function getAction($mail)
    {
        $service = $this->get(OfertaService::class);
        $restresult = json_decode($service->getOferta());
        $restresult->token = uniqid();
        if ($restresult === null) {
            return new View("No existe una oferta", Response::HTTP_NOT_FOUND);
        }

        $this->sendMail($mail, $restresult->token);
        return new JsonResponse($restresult);
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
