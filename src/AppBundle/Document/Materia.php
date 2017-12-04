<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\Materia
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Materia
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $nombre
     *
     * @ODM\Field(name="nombre", type="string")
     */
    protected $nombre;

    /**
     * @var int $orden
     *
     * @ODM\Field(name="orden", type="int")
     */
    protected $orden;

    /**
     * @var collection $comisiones
     *
     * @ODM\Field(name="comisiones", type="collection")
     */
    protected $comisiones;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return $this
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set orden
     *
     * @param int $orden
     * @return $this
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
        return $this;
    }

    /**
     * Get orden
     *
     * @return int $orden
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set comisiones
     *
     * @param collection $comisiones
     * @return $this
     */
    public function setComisiones($comisiones)
    {
        $this->comisiones = $comisiones;
        return $this;
    }

    /**
     * Get comisiones
     *
     * @return collection $comisiones
     */
    public function getComisiones()
    {
        return $this->comisiones;
    }

    /**
     * Add comision
     *
     * @param AppBundle\Document\Comision $comision
     */
    public function addComision(\AppBundle\Document\Comision $comision)
    {
        $this->comisiones[] = $comision;
    }
}
