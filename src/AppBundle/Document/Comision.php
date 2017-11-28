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
     * @var hash $dia_horario
     *
     * @ODM\Field(name="dia_horario", type="hash")
     */
    protected $dia_horario;


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
     * Set diaHorario
     *
     * @param hash $diaHorario
     * @return $this
     */
    public function setDiaHorario($diaHorario)
    {
        $this->dia_horario = $diaHorario;
        return $this;
    }

    /**
     * Get diaHorario
     *
     * @return hash $diaHorario
     */
    public function getDiaHorario()
    {
        return $this->dia_horario;
    }
}
