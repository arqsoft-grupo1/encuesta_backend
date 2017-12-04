<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\Oferta
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Oferta
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $cuatrimestre
     *
     * @ODM\Field(name="cuatrimestre", type="string")
     */
    protected $cuatrimestre;

    /**
     * @var collection $materias
     *
     * @ODM\ReferenceMany(name="materias")
     */
    protected $materias;


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
     * Set cuatrimestre
     *
     * @param string $cuatrimestre
     * @return $this
     */
    public function setCuatrimestre($cuatrimestre)
    {
        $this->cuatrimestre = $cuatrimestre;
        return $this;
    }

    /**
     * Get cuatrimestre
     *
     * @return string $cuatrimestre
     */
    public function getCuatrimestre()
    {
        return $this->cuatrimestre;
    }

    public function __construct()
    {
        $this->materias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add materia
     *
     * @param $materia
     */
    public function addMateria($materia)
    {
        $this->materias[] = $materia;
    }

    /**
     * Remove materia
     *
     * @param $materia
     */
    public function removeMateria($materia)
    {
        $this->materias->removeElement($materia);
    }

    /**
     * Get materias
     *
     * @return \Doctrine\Common\Collections\Collection $materias
     */
    public function getMaterias()
    {
        return $this->materias;
    }
}
