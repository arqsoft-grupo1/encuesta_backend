<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * AppBundle\Document\Encuesta
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Encuesta
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int $legajo
     *
     * @ODM\Field(name="legajo", type="int")
     */
    protected $legajo;

    /**
     * @var string $token
     *
     * @ODM\Field(name="token", type="string")
     */
    protected $token;

    /**
     * @var collection $materias_aprobadas
     *
     * @ODM\ReferenceMany(targetDocument="MateriaEncuesta", cascade="all")
     */
    protected $materias_aprobadas;

    /**
     * @var collection $materias__a_cursar
     *
     * @ODM\ReferenceMany(targetDocument="MateriaEncuesta", cascade="all")
     */
    protected $materias_a_cursar;

    /**
     * @var collection $materias_todaviano
     *
     * @ODM\ReferenceMany(targetDocument="MateriaEncuesta", cascade="all")
     */
    protected $materias_todaviano;

    /**
     * @var collection $materias_no_puedoporhorario
     *
     * @ODM\ReferenceMany(targetDocument="MateriaEncuesta", cascade="all")
     */
    protected $materias_no_puedoporhorario;

    /**
     * @var cuatrimestre $token
     *
     * @ODM\Field(name="cuatrimestre", type="string")
     */
    protected $cuatrimestre;




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
     * Set legajo
     *
     * @param int $legajo
     * @return $this
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
        return $this;
    }

    /**
     * Get legajo
     *
     * @return int $legajo
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get token
     *
     * @return string $token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set materiasAprobadas
     *
     * @param collection $materiasAprobadas
     * @return $this
     */
    public function setMateriasAprobadas($materiasAprobadas)
    {
        $this->materias_aprobadas = $materiasAprobadas;
        return $this;
    }

    /**
     * Get materiasAprobadas
     *
     * @return collection $materiasAprobadas
     */
    public function getMateriasAprobadas()
    {
        return $this->materias_aprobadas;
    }

    /**
     * Set materiasACursar
     *
     * @param collection $materiasACursar
     * @return $this
     */
    public function setMateriasACursar($materiasACursar)
    {
        $this->materias_a_cursar = $materiasACursar;
        return $this;
    }

    /**
     * Get materiasACursar
     *
     * @return collection $materiasACursar
     */
    public function getMateriasACursar()
    {
        return $this->materias_a_cursar;
    }

    /**
     * Set materiasTodaviano
     *
     * @param collection $materiasTodaviano
     * @return $this
     */
    public function setMateriasTodaviano($materiasTodaviano)
    {
        $this->materias_todaviano = $materiasTodaviano;
        return $this;
    }

    /**
     * Get materiasTodaviano
     *
     * @return collection $materiasTodaviano
     */
    public function getMateriasTodaviano()
    {
        return $this->materias_todaviano;
    }

    /**
     * Set materiasNoPuedoporhorario
     *
     * @param collection $materiasNoPuedoporhorario
     * @return $this
     */
    public function setMateriasNoPuedoporhorario($materiasNoPuedoporhorario)
    {
        $this->materias_no_puedoporhorario = $materiasNoPuedoporhorario;
        return $this;
    }

    /**
     * Get materiasNoPuedoporhorario
     *
     * @return collection $materiasNoPuedoporhorario
     */
    public function getMateriasNoPuedoporhorario()
    {
        return $this->materias_no_puedoporhorario;
    }
    public function __construct()
    {
        $this->materias_aprobadas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->materias_a_cursar = new \Doctrine\Common\Collections\ArrayCollection();
        $this->materias_todaviano = new \Doctrine\Common\Collections\ArrayCollection();
        $this->materias_no_puedoporhorario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add materiasAprobada
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasAprobada
     */
    public function addMateriasAprobada(\AppBundle\Document\MateriaEncuesta $materiasAprobada)
    {
        $this->materias_aprobadas[] = $materiasAprobada;
    }

    /**
     * Remove materiasAprobada
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasAprobada
     */
    public function removeMateriasAprobada(\AppBundle\Document\MateriaEncuesta $materiasAprobada)
    {
        $this->materias_aprobadas->removeElement($materiasAprobada);
    }

    /**
     * Add materiasACursar
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasACursar
     */
    public function addMateriasACursar(\AppBundle\Document\MateriaEncuesta $materiasACursar)
    {
        $this->materias_a_cursar[] = $materiasACursar;
    }

    /**
     * Remove materiasACursar
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasACursar
     */
    public function removeMateriasACursar(\AppBundle\Document\MateriaEncuesta $materiasACursar)
    {
        $this->materias_a_cursar->removeElement($materiasACursar);
    }

    /**
     * Add materiasTodaviano
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasTodaviano
     */
    public function addMateriasTodaviano(\AppBundle\Document\MateriaEncuesta $materiasTodaviano)
    {
        $this->materias_todaviano[] = $materiasTodaviano;
    }

    /**
     * Remove materiasTodaviano
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasTodaviano
     */
    public function removeMateriasTodaviano(\AppBundle\Document\MateriaEncuesta $materiasTodaviano)
    {
        $this->materias_todaviano->removeElement($materiasTodaviano);
    }

    /**
     * Add materiasNoPuedoporhorario
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasNoPuedoporhorario
     */
    public function addMateriasNoPuedoporhorario(\AppBundle\Document\MateriaEncuesta $materiasNoPuedoporhorario)
    {
        $this->materias_no_puedoporhorario[] = $materiasNoPuedoporhorario;
    }

    /**
     * Remove materiasNoPuedoporhorario
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasNoPuedoporhorario
     */
    public function removeMateriasNoPuedoporhorario(\AppBundle\Document\MateriaEncuesta $materiasNoPuedoporhorario)
    {
        $this->materias_no_puedoporhorario->removeElement($materiasNoPuedoporhorario);
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
}
