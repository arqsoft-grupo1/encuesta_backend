<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\Comision
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Comision
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var [string] $dias
     *
     * @ODM\Field(name="dias", type="string")
    */
    protected $dias;

    /**
     * @var [string] $hora
     *
     * @ODM\Field(name="hora", type="string")
    */
    protected $hora;

    /**
     * @var [string] $nombre
     *
     * @ODM\Field(name="nombre", type="string")
    */
    protected $nombre;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setDias($dias) {
        $this->dias = $dias;
    }

    public function getDias() {
        return $this->dias;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getHora() {
        return $this->getHora();
    }

    public static function createFromJson( $jsonString )
    {
        $object = json_decode( $jsonString, true);
        return new self( $object->nombre, $object->horario->dias, $object->horario->hora );
    }
}
