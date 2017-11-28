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
     * @var string $legajo
     *
     * @ODM\Field(name="legajo", type="string")
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
     * @param string $legajo
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
     * @return string $legajo
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
}
