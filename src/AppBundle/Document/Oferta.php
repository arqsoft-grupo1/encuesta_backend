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
     * @var string $carrera
     *
     * @ODM\Field(name="carrera", type="string")
     */
    protected $carrera;

    /**
     * @var string $materias
     *
     * @ODM\Field(name="materias", type="string")
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
     * Set carrera
     *
     * @param string $carrera
     * @return $this
     */
    public function setCarrera($carrera)
    {
        $this->carrera = $carrera;
        return $this;
    }

    /**
     * Get carrera
     *
     * @return string $carrera
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    /**
     * Set materias
     *
     * @param string $materias
     * @return $this
     */
    public function setMaterias($materias)
    {
        $this->materias = $materias;
        return $this;
    }

    /**
     * Get materias
     *
     * @return string $materias
     */
    public function getMaterias()
    {
        return $this->materias;
    }
}
