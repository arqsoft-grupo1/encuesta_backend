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
     * @var string $nombre
     *
     * @ODM\Field(name="nombre", type="string")
     */
     protected $nombre;

    /**
     * @var hash $dia_horario
     *
     * @ODM\Field(name="dia_horario", type="hash")
     */
    protected $dia_horario;

    /**
     * @var int $comision_id
     *
     * @ODM\Field(name="comision_id", type="int")
     */
    protected $comision_id;

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

    protected $cantidadInscriptos;

    /**
     * @var Materia $materia
     *
     * @ODM\ReferenceOne(targetDocument="Materia")
     */
    protected $materia;

    public function __construct()
    {
        $this->inscriptos = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Set comisionId
     *
     * @param int $comisionId
     * @return $this
     */
    public function setComisionId($comisionId)
    {
        $this->comision_id = $comisionId;
        return $this;
    }

    /**
     * Get comisionId
     *
     * @return int $comisionId
     */
    public function getComisionId()
    {
        return $this->comision_id;
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
     * Set materia
     *
     * @param AppBundle\Document\Materia $materia
     * @return $this
     */
    public function setMateria(\AppBundle\Document\Materia $materia)
    {
        $this->materia = $materia;
        return $this;
    }

    /**
     * Get materia
     *
     * @return AppBundle\Document\Materia $materia
     */
    public function getMateria()
    {
        return $this->materia;
    }

    public function getCantidadInscriptos() {
        return count($this->getInscriptos());
    }    
}
