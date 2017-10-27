<?php

namespace AppBundle\Entity;

class Encuesta
{
    private $legajo;
    private $encuesta;

    function getLegajo() {
        return $this->legajo;
    }

    function getEncuesta() {
        return $this->encuesta;
    }

    function setLegajo($legajo) {
        $this->legajo = $legajo;
    }

    function setEncuesta($encuesta) {
        $this->encuesta = $encuesta;
    }

}
