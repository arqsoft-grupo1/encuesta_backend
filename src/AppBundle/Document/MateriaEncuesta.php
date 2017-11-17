<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\MateriaEncuesta
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class MateriaEncuesta
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $materia
     *@ODM\ReferenceOne(targetDocument="Materia")
     */
    protected $materia;

    /**
     * @var Comision $comisionElegida
     *@ODM\ReferenceOne(targetDocument="Comision")
     */
    protected $comisionElegida;

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
     * Set materia
     *
     * @param Materia $materia
     * @return $this
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;
        return $this;
    }

    /**
     * Get materia
     *
     * @return Materia $materia
     */
    public function getMateria()
    {
        return $this->materia;
    }
}
