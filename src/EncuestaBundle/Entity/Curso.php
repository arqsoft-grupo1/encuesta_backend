<?php

namespace EncuestaBundle\Entity;

/**
 * Curso
 */
class Curso
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $cupo;

    /**
     * @var string
     */
    private $aula;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cupo
     *
     * @param integer $cupo
     *
     * @return Curso
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;

        return $this;
    }

    /**
     * Get cupo
     *
     * @return int
     */
    public function getCupo()
    {
        return $this->cupo;
    }

    /**
     * Set aula
     *
     * @param string $aula
     *
     * @return Curso
     */
    public function setAula($aula)
    {
        $this->aula = $aula;

        return $this;
    }

    /**
     * Get aula
     *
     * @return string
     */
    public function getAula()
    {
        return $this->aula;
    }
}

