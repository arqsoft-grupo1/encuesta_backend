<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testTransversal()
    {
        /*
            1- Login / Solicitud de oferta personalizada
                El alumno mediante el web service http://localhost:8000/api/oferta/token/{email}
                solicita la generación de la oferta.
                Es equivalente al login en el frontend. Esta operacion envia un mail con la URL correspondiente
            2- Ingresa a la URL especificada en el mail
                El alumno debe ingresar a la url especificada por mail, esto equivale a la solicitud de encuesta a
                http://localhost:8000/api/encuesta/{token}
            3- Cambio de estado de las materias de la encuesta
                Las materias tienen estado, el alumno debera modificar el estado de cada una de ellas y presionar el boton enviar encuesta
                Equivale a
                http://localhost:8999/api/encuesta/{token} enviando el en body todas las listas de materias, aprobadas, a cursar, y todavia no
        */
    }
}
