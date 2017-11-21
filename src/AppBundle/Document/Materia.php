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
     * @var [Comision] $comisiones
      * @ODM\ReferenceMany(targetDocument="Comision")
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
    public function __construct()
    {
        $this->comisiones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add comisione
     *
     * @param AppBundle\Document\Comision $comisione
     */
    public function addComisione(\AppBundle\Document\Comision $comisione)
    {
        $this->comisiones[] = $comisione;
    }

    /**
     * Remove comisione
     *
     * @param AppBundle\Document\Comision $comisione
     */
    public function removeComisione(\AppBundle\Document\Comision $comisione)
    {
        $this->comisiones->removeElement($comisione);
    }

    /**
     * Get comisiones
     *
     * @return \Doctrine\Common\Collections\Collection $comisiones
     */
    public function getComisiones()
    {
        return $this->comisiones;
    }

    public function setComisiones($comisiones)
    {
        return $this->comisiones = $comisiones;
    }
}
