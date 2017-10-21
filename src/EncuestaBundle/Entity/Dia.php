<?php

namespace EncuestaBundle\Entity;

/**
 * Dia
 */
class Dia
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $diaSemana;

    /**
     * @var \DateTime
     */
    private $horaDesde;

    /**
     * @var \DateTime
     */
    private $horaHasta;


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
     * Set diaSemana
     *
     * @param string $diaSemana
     *
     * @return Dia
     */
    public function setDiaSemana($diaSemana)
    {
        $this->diaSemana = $diaSemana;

        return $this;
    }

    /**
     * Get diaSemana
     *
     * @return string
     */
    public function getDiaSemana()
    {
        return $this->diaSemana;
    }

    /**
     * Set horaDesde
     *
     * @param \DateTime $horaDesde
     *
     * @return Dia
     */
    public function setHoraDesde($horaDesde)
    {
        $this->horaDesde = $horaDesde;

        return $this;
    }

    /**
     * Get horaDesde
     *
     * @return \DateTime
     */
    public function getHoraDesde()
    {
        return $this->horaDesde;
    }

    /**
     * Set horaHasta
     *
     * @param \DateTime $horaHasta
     *
     * @return Dia
     */
    public function setHoraHasta($horaHasta)
    {
        $this->horaHasta = $horaHasta;

        return $this;
    }

    /**
     * Get horaHasta
     *
     * @return \DateTime
     */
    public function getHoraHasta()
    {
        return $this->horaHasta;
    }
}

