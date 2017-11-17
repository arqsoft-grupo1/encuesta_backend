<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\Carrera
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Carrera
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
     * @var [Oferta] $oferta
      * @ODM\ReferenceMany(targetDocument="Oferta")
      */
    protected $oferta;


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
     * Set oferta
     *
     * @param string $oferta
     * @return $this
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
        return $this;
    }

    /**
     * Get oferta
     *
     * @return [Oferta] $oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }
    public function __construct()
    {
        $this->oferta = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add ofertum
     *
     * @param AppBundle\Document\Oferta $ofertum
     */
    public function addOfertum(\AppBundle\Document\Oferta $ofertum)
    {
        $this->oferta[] = $ofertum;
    }

    /**
     * Remove ofertum
     *
     * @param AppBundle\Document\Oferta $ofertum
     */
    public function removeOfertum(\AppBundle\Document\Oferta $ofertum)
    {
        $this->oferta->removeElement($ofertum);
    }
}
