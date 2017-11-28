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
     * @var Materia $materia
     *
     * @ODM\ReferenceOne(targetDocument="Materia")
     */
    protected $materia;

    /**
     * @var string $comisionElegida
     *
     * @ODM\ReferenceOne(targetDocument="Comision")
     */
    protected $comisionElegida;

    /**
     * @var string $estado
     *
     * @ODM\Field(name="estado")
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
     * Set materia
     *
     * @param string $materia
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
     * @return string $materia
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set comisionElegida
     *
     * @param string $comisionElegida
     * @return $this
     */
    public function setComisionElegida($comisionElegida)
    {
        $this->comisionElegida = $comisionElegida;
        return $this;
    }

    /**
     * Get comisionElegida
     *
     * @return string $comisionElegida
     */
    public function getComisionElegida()
    {
        return $this->comisionElegida;
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
}
