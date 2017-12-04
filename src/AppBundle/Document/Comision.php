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
     * @var int $cupo
     *
     * @ODM\Field(name="cupo", type="int")
     */
    protected $cupo;

    /**
     * @var collection $inscriptos
     *
     * @ODM\ReferenceMany(targetDocument="Alumno", cascade="all")
     */
    protected $inscriptos;

    protected $dias;

    protected $hora;

    protected $nombre;


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

    public function __construct()
    {
        $this->inscriptos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add inscripto
     *
     * @param AppBundle\Document\Alumno $inscripto
     */
    public function addInscripto(\AppBundle\Document\Alumno $inscripto)
    {
        $this->inscriptos[] = $inscripto;
    }

    /**
     * Remove inscripto
     *
     * @param AppBundle\Document\Alumno $inscripto
     */
    public function removeInscripto(\AppBundle\Document\Alumno $inscripto)
    {
        $this->inscriptos->removeElement($inscripto);
    }

    /**
     * Get inscriptos
     *
     * @return \Doctrine\Common\Collections\Collection $inscriptos
     */
    public function getInscriptos()
    {
        return $this->inscriptos;
    }

    /**
     * Set cupo
     *
     * @param int $cupo
     * @return $this
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;
        return $this;
    }

    /**
     * Get cupo
     *
     * @return int $cupo
     */
    public function getCupo()
    {
        return $this->cupo;
    }

    public function getCupoDisponible() {
        return $this->getCupo() - count($this->getInscriptos());
    }

}
