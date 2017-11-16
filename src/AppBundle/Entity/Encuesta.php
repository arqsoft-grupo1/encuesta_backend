<?php

namespace AppBundle\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Encuesta
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
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
