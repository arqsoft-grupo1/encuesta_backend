<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\MateriaOferta
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class MateriaOferta
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $materia
     *
     * @ODM\ReferenceMany(name="materia")
     */
    protected $materia;

    /**
     * @var string $estado
     *
     * @ODM\Field(name="estado", type="string")
     */
    protected $estado;


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
     * Set estado
     *
     * @param string $estado
     * @return $this
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * Get estado
     *
     * @return string $estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    public function __construct()
    {
        $this->materia = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add materium
     *
     * @param $materium
     */
    public function addMaterium($materium)
    {
        $this->materia[] = $materium;
    }

    /**
     * Remove materium
     *
     * @param $materium
     */
    public function removeMaterium($materium)
    {
        $this->materia->removeElement($materium);
    }

    /**
     * Get materia
     *
     * @return \Doctrine\Common\Collections\Collection $materia
     */
    public function getMateria()
    {
        return $this->materia;
    }
}
