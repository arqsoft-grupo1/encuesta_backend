<?php

namespace AppBundle\Document;

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
    protected $legajo;

    protected $encuesta;

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
}
