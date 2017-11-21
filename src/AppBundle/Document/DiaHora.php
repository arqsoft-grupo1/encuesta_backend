<?php

namespace AppBundle\Entity;

class DiaHora
{
    private dia;
    private hora;

    __construct($dia, $hora) {
        $this.dia = $dia;
        $this.hora = $hora;
    }

    function getDia() {
        return $this->dia;
    }

    function getHora() {
        return $this->hora;
    }
}
