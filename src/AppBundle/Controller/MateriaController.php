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
use AppBundle\Document\Director as Director;

class MateriaController extends Controller
{
    /**
    * @Rest\Post("/api/materia")
    */
    public function postAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();

        $director = new Director();
        $director->setNombre("Fidel");
        $director->setEmail("fidel@gmail.com");
        $director->setPassword("1234");

        $dm->persist($director);

        $materia = new Materia();
        $materia->setOrden(1);
        $materia->setNombre("Introduccion a la programacion");
        $comision = new Comision();
        $comision->setCupo(10);
        $comision->setComisionId(1);
        $comision->setNombre("C1");
        $comision->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision2 = new Comision();
        $comision2->setCupo(10);
        $comision2->setComisionId(2);
        $comision2->setNombre("C2");
        $comision2->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $comision3 = new Comision();
        $comision3->setCupo(10);
        $comision3->setComisionId(3);
        $comision3->setNombre("C3");
        $comision3->setDiaHorario(array('Miercoles' => '14 a 18', 'Viernes' => '14 a 18'));
        $comision4 = new Comision();
        $comision4->setCupo(10);
        $comision4->setComisionId(4);
        $comision4->setNombre("C4");
        $comision4->setDiaHorario(array('Jueves' => '18 a 22', 'Sabado' => '9 a 12'));
        $materia->addComision($comision);
        $materia->addComision($comision2);
        $materia->addComision($comision3);
        $materia->addComision($comision4);

        $materia2 = new Materia();
        $materia2->setOrden(1);
        $materia2->setNombre("Matematica I");
        $comision5 = new Comision();
        $comision5->setCupo(10);
        $comision5->setComisionId(5);
        $comision5->setNombre("C1");
        $comision5->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision6 = new Comision();
        $comision6->setCupo(10);
        $comision6->setComisionId(6);
        $comision6->setNombre("C2");
        $comision6->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia2->addComision($comision5);
        $materia2->addComision($comision6);

        $materia3 = new Materia();
        $materia3->setOrden(1);
        $materia3->setNombre("Organizacion de computadoras");
        $comision7 = new Comision();
        $comision7->setCupo(10);
        $comision7->setComisionId(7);
        $comision7->setNombre("C1");
        $comision7->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision8 = new Comision();
        $comision8->setCupo(10);
        $comision8->setComisionId(8);
        $comision8->setNombre("C2");
        $comision8->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $comision9 = new Comision();
        $comision9->setCupo(10);
        $comision9->setComisionId(9);
        $comision9->setNombre("C3");
        $comision9->setDiaHorario(array('Miercoles' => '14 a 18', 'Viernes' => '19 a 22'));
        $comision10 = new Comision();
        $comision10->setCupo(10);
        $comision10->setComisionId(10);
        $comision10->setNombre("C4");
        $comision10->setDiaHorario(array('Jueves' => '18 a 22', 'Viernes' => '18 a 22'));
        $materia3->addComision($comision7);
        $materia3->addComision($comision8);
        $materia3->addComision($comision9);
        $materia3->addComision($comision10);

        $materia4 = new Materia();
        $materia4->setOrden(2);
        $materia4->setNombre("Estructura de datos");
        $comision11 = new Comision();
        $comision11->setCupo(10);
        $comision11->setComisionId(11);
        $comision11->setNombre("C1");
        $comision11->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision12 = new Comision();
        $comision12->setCupo(10);
        $comision12->setComisionId(12);
        $comision12->setNombre("C2");
        $comision12->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia4->addComision($comision11);
        $materia4->addComision($comision12);

        $materia5 = new Materia();
        $materia5->setOrden(2);
        $materia5->setNombre("Programacion con objetos I");
        $comision13 = new Comision();
        $comision13->setCupo(10);
        $comision13->setComisionId(13);
        $comision13->setNombre("C1");
        $comision13->setDiaHorario(array('Martes' => '16 a 22'));
        $materia5->addComision($comision13);


        $materia6 = new Materia();
        $materia6->setOrden(2);
        $materia6->setNombre("Bases de datos");
        $comision14 = new Comision();
        $comision14->setCupo(10);
        $comision14->setComisionId(14);
        $comision14->setNombre("C1");
        $comision14->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision15 = new Comision();
        $comision15->setCupo(10);
        $comision15->setComisionId(15);
        $comision15->setNombre("C2");
        $comision15->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia6->addComision($comision14);
        $materia6->addComision($comision15);

        $materia7 = new Materia();
        $materia7->setOrden(3);
        $materia7->setNombre("Matematica II");
        $comision16 = new Comision();
        $comision16->setCupo(10);
        $comision16->setComisionId(16);
        $comision16->setNombre("C1");
        $comision16->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision17 = new Comision();
        $comision17->setCupo(10);
        $comision17->setComisionId(17);
        $comision17->setNombre("C2");
        $comision17->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $comision18 = new Comision();
        $comision18->setCupo(10);
        $comision18->setComisionId(18);
        $comision18->setNombre("C3");
        $comision18->setDiaHorario(array('Miercoles' => '10 a 12', 'Jueves' => '18 a 22'));
        $comision19 = new Comision();
        $comision19->setCupo(10);
        $comision19->setComisionId(19);
        $comision19->setNombre("C4");
        $comision19->setDiaHorario(array('Viernes' => '18 a 22', 'Sabado' => '9 a 13'));
        $materia7->addComision($comision16);
        $materia7->addComision($comision17);
        $materia7->addComision($comision18);
        $materia7->addComision($comision19);

        $materia8 = new Materia();
        $materia8->setOrden(3);
        $materia8->setNombre("Programacion con objetos II");
        $comision20 = new Comision();
        $comision20->setCupo(10);
        $comision20->setComisionId(20);
        $comision20->setNombre("C1");
        $comision20->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision21 = new Comision();
        $comision21->setCupo(10);
        $comision21->setComisionId(21);
        $comision21->setNombre("C2");
        $comision21->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia8->addComision($comision20);
        $materia8->addComision($comision21);

        $materia9 = new Materia();
        $materia9->setOrden(3);
        $materia9->setNombre("Redes de computadoras");
        $comision22 = new Comision();
        $comision22->setCupo(10);
        $comision22->setComisionId(22);
        $comision22->setNombre("C1");
        $comision22->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision23 = new Comision();
        $comision23->setCupo(10);
        $comision23->setComisionId(23);
        $comision23->setNombre("C2");
        $comision23->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia9->addComision($comision22);
        $materia9->addComision($comision23);

        $materia10 = new Materia();
        $materia10->setOrden(3);
        $materia10->setNombre("Sistemas operativos");
        $comision24 = new Comision();
        $comision24->setCupo(10);
        $comision24->setComisionId(24);
        $comision24->setNombre("C1");
        $comision24->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision25 = new Comision();
        $comision25->setCupo(10);
        $comision25->setComisionId(25);
        $comision25->setNombre("C2");
        $comision25->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia10->addComision($comision24);
        $materia10->addComision($comision25);

        $materia11 = new Materia();
        $materia11->setOrden(3);
        $materia11->setNombre("Ingles I");
        $comision26 = new Comision();
        $comision26->setCupo(10);
        $comision26->setComisionId(26);
        $comision26->setNombre("C1");
        $comision26->setDiaHorario(array('Lunes' => '10 a 12'));
        $comision27 = new Comision();
        $comision27->setCupo(10);
        $comision27->setComisionId(27);
        $comision27->setNombre("C2");
        $comision27->setDiaHorario(array('Martes' => '18 a 22'));
        $comision28 = new Comision();
        $comision28->setCupo(10);
        $comision28->setComisionId(28);
        $comision28->setNombre("C3");
        $comision28->setDiaHorario(array('Miercoles' => '18 a 22'));
        $comision29 = new Comision();
        $comision29->setCupo(10);
        $comision29->setComisionId(29);
        $comision29->setNombre("C4");
        $comision29->setDiaHorario(array('Jueves' => '9 a 13'));
        $comision30 = new Comision();
        $comision30->setCupo(10);
        $comision30->setComisionId(30);
        $comision30->setNombre("C5");
        $comision30->setDiaHorario(array('Viernes' => '9 a 13'));
        $comision31 = new Comision();
        $comision31->setCupo(10);
        $comision31->setComisionId(31);
        $comision31->setNombre("C6");
        $comision31->setDiaHorario(array('Sabado' => '9 a 13'));
        $materia11->addComision($comision26);
        $materia11->addComision($comision27);
        $materia11->addComision($comision28);
        $materia11->addComision($comision29);
        $materia11->addComision($comision30);
        $materia11->addComision($comision31);

        $materia12 = new Materia();
        $materia12->setOrden(4);
        $materia12->setNombre("Programacion funcional");
        $comision32 = new Comision();
        $comision32->setCupo(10);
        $comision32->setComisionId(32);
        $comision32->setNombre("C1");
        $comision32->setDiaHorario(array('Lunes' => '14 a 16', 'Miercoles' => '14 a 16'));
        $comision33 = new Comision();
        $comision33->setCupo(10);
        $comision33->setComisionId(33);
        $comision33->setNombre("C2");
        $comision33->setDiaHorario(array('Martes' => '14 a 16', 'Jueves' => '14 a 16'));
        $materia12->addComision($comision32);
        $materia12->addComision($comision33);

        $materia13 = new Materia();
        $materia13->setOrden(4);
        $materia13->setNombre("Construccion de interfaces de usuario");
        $comision34 = new Comision();
        $comision34->setCupo(10);
        $comision34->setComisionId(34);
        $comision34->setNombre("C1");
        $comision34->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision35 = new Comision();
        $comision35->setCupo(10);
        $comision35->setComisionId(35);
        $comision35->setNombre("C2");
        $comision35->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia13->addComision($comision34);
        $materia13->addComision($comision35);

        $materia14 = new Materia();
        $materia14->setOrden(4);
        $materia14->setNombre("Estrategias de persistencia");
        $comision36 = new Comision();
        $comision36->setCupo(10);
        $comision36->setComisionId(36);
        $comision36->setNombre("C1");
        $comision36->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision37 = new Comision();
        $comision37->setCupo(10);
        $comision37->setComisionId(37);
        $comision37->setNombre("C2");
        $comision37->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $materia14->addComision($comision36);
        $materia14->addComision($comision37);

        $materia15 = new Materia();
        $materia15->setOrden(4);
        $materia15->setNombre("Laboratorio de sistemas operativos y redes");
        $comision38 = new Comision();
        $comision38->setCupo(10);
        $comision38->setComisionId(38);
        $comision38->setNombre("C1");
        $comision38->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia15->addComision($comision38);

        $materia16 = new Materia();
        $materia16->setOrden(4);
        $materia16->setNombre("Ingles II");
        $comision39 = new Comision();
        $comision39->setCupo(10);
        $comision39->setComisionId(39);
        $comision39->setNombre("C1");
        $comision39->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision40 = new Comision();
        $comision40->setCupo(10);
        $comision40->setComisionId(40);
        $comision40->setNombre("C2");
        $comision40->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $comision41 = new Comision();
        $comision41->setCupo(10);
        $comision41->setComisionId(41);
        $comision41->setNombre("C3");
        $comision41->setDiaHorario(array('Jueves' => '10 a 12', 'Viernes' => '18 a 22'));
        $comision42 = new Comision();
        $comision42->setCupo(10);
        $comision42->setComisionId(42);
        $comision42->setNombre("C4");
        $comision42->setDiaHorario(array('Lunes' => '18 a 22', 'Sabados' => '9 a 12'));
        $materia16->addComision($comision39);
        $materia16->addComision($comision40);
        $materia16->addComision($comision41);
        $materia16->addComision($comision42);

        $materia17 = new Materia();
        $materia17->setOrden(5);
        $materia17->setNombre("Analisis matematico");
        $comision43 = new Comision();
        $comision43->setCupo(10);
        $comision43->setComisionId(43);
        $comision43->setNombre("C1");
        $comision43->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision44 = new Comision();
        $comision44->setCupo(10);
        $comision44->setComisionId(44);
        $comision44->setNombre("C2");
        $comision44->setDiaHorario(array('Martes' => '18 a 22', 'Jueves' => '18 a 22'));
        $comision45 = new Comision();
        $comision45->setCupo(10);
        $comision45->setComisionId(45);
        $comision45->setNombre("C3");
        $comision45->setDiaHorario(array('Miercoles' => '10 a 12', 'Viernes' => '18 a 22'));
        $comision46 = new Comision();
        $comision46->setCupo(10);
        $comision46->setComisionId(46);
        $comision46->setNombre("C4");
        $comision46->setDiaHorario(array('Jueves' => '18 a 22', 'Sabado' => '9 a 12'));
        $comision47 = new Comision();
        $comision47->setCupo(10);
        $comision47->setComisionId(47);
        $comision47->setNombre("C5");
        $comision47->setDiaHorario(array('Lunes' => '10 a 12', 'Viernes' => '18 a 22'));
        $comision48 = new Comision();
        $comision48->setCupo(10);
        $comision48->setComisionId(48);
        $comision48->setNombre("C6");
        $comision48->setDiaHorario(array('Jueves' => '18 a 22', 'Viernes' => '18 a 22'));
        $materia17->addComision($comision43);
        $materia17->addComision($comision44);
        $materia17->addComision($comision45);
        $materia17->addComision($comision46);
        $materia17->addComision($comision47);
        $materia17->addComision($comision48);

        $materia18 = new Materia();
        $materia18->setOrden(5);
        $materia18->setNombre("Logica y programacion");
        $comision49 = new Comision();
        $comision49->setCupo(10);
        $comision49->setComisionId(49);
        $comision49->setNombre("C1");
        $comision49->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia18->addComision($comision49);

        $materia19 = new Materia();
        $materia19->setOrden(5);
        $materia19->setNombre("Ingenieria de software");
        $comision50 = new Comision();
        $comision50->setCupo(10);
        $comision50->setComisionId(50);
        $comision50->setNombre("C1");
        $comision50->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia19->addComision($comision50);

        $materia20 = new Materia();
        $materia20->setOrden(5);
        $materia20->setNombre("Seguridad de la informacion");
        $comision51 = new Comision();
        $comision51->setCupo(10);
        $comision51->setComisionId(51);
        $comision51->setNombre("C1");
        $comision51->setDiaHorario(array('Sabado' => '9 a 14'));
        $materia20->addComision($comision51);

        $materia21 = new Materia();
        $materia21->setOrden(6);
        $materia21->setNombre("Matematica III");
        $comision52 = new Comision();
        $comision52->setCupo(10);
        $comision52->setComisionId(52);
        $comision52->setNombre("C1");
        $comision52->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia21->addComision($comision52);

        $materia22 = new Materia();
        $materia22->setOrden(6);
        $materia22->setNombre("Programacion concurrente");
        $comision53 = new Comision();
        $comision53->setCupo(10);
        $comision53->setComisionId(53);
        $comision53->setNombre("C1");
        $comision53->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia22->addComision($comision53);

        $materia23 = new Materia();
        $materia23->setOrden(6);
        $materia23->setNombre("Practica del desarrollo de software");
        $comision54 = new Comision();
        $comision54->setCupo(10);
        $comision54->setComisionId(54);
        $comision54->setNombre("C1");
        $comision54->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia23->addComision($comision54);

        $materia24 = new Materia();
        $materia24->setOrden(6);
        $materia24->setNombre("Ingenieria de requerimientos");
        $comision55 = new Comision();
        $comision55->setCupo(10);
        $comision55->setComisionId(55);
        $comision55->setNombre("C1");
        $comision55->setDiaHorario(array('Lunes' => '10 a 12', 'Jueves' => '18 a 22'));
        $materia24->addComision($comision55);

        $materia25 = new Materia();
        $materia25->setOrden(7);
        $materia25->setNombre("Probabilidad y estadistica");
        $comision56 = new Comision();
        $comision56->setCupo(10);
        $comision56->setComisionId(56);
        $comision56->setNombre("C1");
        $comision56->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $comision57 = new Comision();
        $comision57->setCupo(10);
        $comision57->setComisionId(57);
        $comision57->setNombre("C2");
        $comision57->setDiaHorario(array('Martes' => '10 a 12', 'Jueves' => '18 a 22'));
        $comision58 = new Comision();
        $comision58->setCupo(10);
        $comision58->setComisionId(58);
        $comision58->setNombre("C3");
        $comision58->setDiaHorario(array('Martes' => '10 a 12', 'Viernes' => '18 a 22'));
        $materia25->addComision($comision56);
        $materia25->addComision($comision57);
        $materia25->addComision($comision58);

        $materia26 = new Materia();
        $materia26->setOrden(7);
        $materia26->setNombre("Lenguajes formales y automatas");
        $comision59 = new Comision();
        $comision59->setCupo(10);
        $comision59->setComisionId(59);
        $comision59->setNombre("C1");
        $comision59->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia26->addComision($comision59);

        $materia27 = new Materia();
        $materia27->setOrden(7);
        $materia27->setNombre("Algoritmos");
        $comision60 = new Comision();
        $comision60->setCupo(10);
        $comision60->setComisionId(60);
        $comision60->setNombre("C1");
        $comision60->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia27->addComision($comision60);

        $materia28 = new Materia();
        $materia28->setOrden(7);
        $materia28->setNombre("Gestion de proyectos de desarrollos de software");
        $comision61 = new Comision();
        $comision61->setCupo(10);
        $comision61->setComisionId(61);
        $comision61->setNombre("C1");
        $comision61->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia28->addComision($comision61);

        $materia29 = new Materia();
        $materia29->setOrden(8);
        $materia29->setNombre("Complementaria I - Tv digital");
        $comision62 = new Comision();
        $comision62->setCupo(10);
        $comision62->setComisionId(62);
        $comision62->setNombre("C1");
        $comision62->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia29->addComision($comision62);

        $materia30 = new Materia();
        $materia30->setOrden(8);
        $materia30->setNombre("Teoria de la computacion");
        $comision63 = new Comision();
        $comision63->setCupo(10);
        $comision63->setComisionId(63);
        $comision63->setNombre("C1");
        $comision63->setDiaHorario(array('Lunes' => '10 a 12', 'Jueves' => '14 a 16'));
        $materia30->addComision($comision63);

        $materia31 = new Materia();
        $materia31->setOrden(8);
        $materia31->setNombre("Programacion con objetos III");
        $comision64 = new Comision();
        $comision64->setCupo(10);
        $comision64->setComisionId(64);
        $comision64->setNombre("C1");
        $comision64->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia31->addComision($comision64);

        $materia32 = new Materia();
        $materia32->setOrden(8);
        $materia32->setNombre("Arquitectura de software I");
        $comision65 = new Comision();
        $comision65->setCupo(10);
        $comision65->setComisionId(65);
        $comision65->setNombre("C1");
        $comision65->setDiaHorario(array('Lunes' => '10 a 12', 'Viernes' => '18 a 22'));
        $materia32->addComision($comision65);

        $materia33 = new Materia();
        $materia33->setOrden(8);
        $materia33->setNombre("Sistemas distribuidos");
        $comision66 = new Comision();
        $comision66->setCupo(10);
        $comision66->setComisionId(66);
        $comision66->setNombre("C1");
        $comision66->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia33->addComision($comision66);

        $materia34 = new Materia();
        $materia34->setOrden(9);
        $materia34->setNombre("Complementaria II - Arduino");
        $comision67 = new Comision();
        $comision67->setCupo(10);
        $comision67->setComisionId(67);
        $comision67->setNombre("C1");
        $comision67->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia34->addComision($comision67);

        $materia35 = new Materia();
        $materia35->setOrden(9);
        $materia35->setNombre("Caracteristicas de lenguajes de programacion");
        $comision68 = new Comision();
        $comision68->setCupo(10);
        $comision68->setComisionId(68);
        $comision68->setNombre("C1");
        $comision68->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia35->addComision($comision68);

        $materia36 = new Materia();
        $materia36->setOrden(9);
        $materia36->setNombre("Arquitectura de software II");
        $comision69 = new Comision();
        $comision69->setCupo(10);
        $comision69->setComisionId(69);
        $comision69->setNombre("C1");
        $comision69->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia36->addComision($comision69);

        $materia37 = new Materia();
        $materia37->setOrden(9);
        $materia37->setNombre("Arquitectura de computadoras");
        $comision70 = new Comision();
        $comision70->setCupo(10);
        $comision70->setComisionId(70);
        $comision70->setNombre("C1");
        $comision70->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia37->addComision($comision70);

        $materia38 = new Materia();
        $materia38->setOrden(10);
        $materia38->setNombre("Complementaria III - Programacion de videojuegos");
        $comision71 = new Comision();
        $comision71->setCupo(10);
        $comision71->setComisionId(71);
        $comision71->setNombre("C1");
        $comision71->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia38->addComision($comision71);

        $materia39 = new Materia();
        $materia39->setOrden(10);
        $materia39->setNombre("Parseo y generacion de codigo");
        $comision72 = new Comision();
        $comision72->setCupo(10);
        $comision72->setComisionId(72);
        $comision72->setNombre("C1");
        $comision72->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia39->addComision($comision72);

        $materia40 = new Materia();
        $materia40->setOrden(10);
        $materia40->setNombre("Aspectos legales y sociales");
        $comision73 = new Comision();
        $comision73->setCupo(10);
        $comision73->setComisionId(73);
        $comision73->setNombre("C1");
        $comision73->setDiaHorario(array('Lunes' => '10 a 12', 'Miercoles' => '18 a 22'));
        $materia40->addComision($comision73);

        $dm->persist($comision);
        $dm->persist($comision2);
        $dm->persist($comision3);
        $dm->persist($comision4);
        $dm->persist($comision5);
        $dm->persist($comision6);
        $dm->persist($comision7);
        $dm->persist($comision8);
        $dm->persist($comision9);
        $dm->persist($comision10);
        $dm->persist($comision11);
        $dm->persist($comision12);
        $dm->persist($comision13);
        $dm->persist($comision14);
        $dm->persist($comision15);
        $dm->persist($comision16);
        $dm->persist($comision17);
        $dm->persist($comision18);
        $dm->persist($comision19);
        $dm->persist($comision20);
        $dm->persist($comision21);
        $dm->persist($comision22);
        $dm->persist($comision23);
        $dm->persist($comision24);
        $dm->persist($comision25);
        $dm->persist($comision26);
        $dm->persist($comision27);
        $dm->persist($comision28);
        $dm->persist($comision29);
        $dm->persist($comision30);
        $dm->persist($comision31);
        $dm->persist($comision32);
        $dm->persist($comision33);
        $dm->persist($comision34);
        $dm->persist($comision35);
        $dm->persist($comision36);
        $dm->persist($comision37);
        $dm->persist($comision38);
        $dm->persist($comision39);
        $dm->persist($comision40);
        $dm->persist($comision41);
        $dm->persist($comision42);
        $dm->persist($comision43);
        $dm->persist($comision44);
        $dm->persist($comision45);
        $dm->persist($comision46);
        $dm->persist($comision47);
        $dm->persist($comision48);
        $dm->persist($comision49);
        $dm->persist($comision50);
        $dm->persist($comision51);
        $dm->persist($comision52);
        $dm->persist($comision53);
        $dm->persist($comision54);
        $dm->persist($comision55);
        $dm->persist($comision56);
        $dm->persist($comision57);
        $dm->persist($comision58);
        $dm->persist($comision59);
        $dm->persist($comision60);
        $dm->persist($comision61);
        $dm->persist($comision62);
        $dm->persist($comision63);
        $dm->persist($comision64);
        $dm->persist($comision65);
        $dm->persist($comision66);
        $dm->persist($comision67);
        $dm->persist($comision68);
        $dm->persist($comision69);
        $dm->persist($comision70);
        $dm->persist($comision71);
        $dm->persist($comision72);
        $dm->persist($comision73);

        $dm->persist($materia);
        $dm->persist($materia2);
        $dm->persist($materia3);
        $dm->persist($materia4);
        $dm->persist($materia5);
        $dm->persist($materia6);
        $dm->persist($materia7);
        $dm->persist($materia8);
        $dm->persist($materia9);
        $dm->persist($materia10);
        $dm->persist($materia11);
        $dm->persist($materia12);
        $dm->persist($materia13);
        $dm->persist($materia14);
        $dm->persist($materia15);
        $dm->persist($materia16);
        $dm->persist($materia17);
        $dm->persist($materia18);
        $dm->persist($materia19);
        $dm->persist($materia20);
        $dm->persist($materia21);
        $dm->persist($materia22);
        $dm->persist($materia23);
        $dm->persist($materia24);
        $dm->persist($materia25);
        $dm->persist($materia26);
        $dm->persist($materia27);
        $dm->persist($materia28);
        $dm->persist($materia29);
        $dm->persist($materia30);
        $dm->persist($materia31);
        $dm->persist($materia32);
        $dm->persist($materia33);
        $dm->persist($materia34);
        $dm->persist($materia35);
        $dm->persist($materia36);
        $dm->persist($materia37);
        $dm->persist($materia38);
        $dm->persist($materia39);
        $dm->persist($materia40);
        $dm->flush();

        return new View($dm->getRepository('AppBundle:Materia')->findAll(), Response::HTTP_OK);
    }

    /**
    * @Rest\Get("/api/materia/")
    */
    public function getAction(){
        $dm = $this->get('doctrine_mongodb')->getManager();
        $materias =  $dm->getRepository('AppBundle:Materia')->findAll();

        usort($materias, array($this,'cmpMateriasMenorCupoDisponile'));
        return new View($materias, Response::HTTP_OK);
    }

    function cmpMateriasMenorCupoDisponile($materia1, $materia2) {
        if ($materia1->getComisionMayorCantidadInscriptos()->getCantidadInscriptos() == $materia2->getComisionMayorCantidadInscriptos()->getCantidadInscriptos()) {
            return 0;
        }
        return ($materia1->getComisionMayorCantidadInscriptos()->getCantidadInscriptos() > $materia2->getComisionMayorCantidadInscriptos()->getCantidadInscriptos() ? -1 : 1);
    }










}
