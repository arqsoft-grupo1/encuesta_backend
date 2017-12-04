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
     * @ODM\ReferenceMany(name="comisiones")
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
    public function __construct()
    {
        $this->comisiones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comisione
     *
     * @param $comisione
     */
    public function addComisione($comisione)
    {
        $this->comisiones[] = $comisione;
    }

    /**
     * Remove comisione
     *
     * @param $comisione
     */
    public function removeComisione($comisione)
    {
        $this->comisiones->removeElement($comisione);
    }
}
