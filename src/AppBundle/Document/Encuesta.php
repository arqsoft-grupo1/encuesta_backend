<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Encuesta
{
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @ODM\Field(type="string")
     */
    protected $legajo;

    protected $token;

    /**
     * @var [MateriaEncuesta] $materias
      * @ODM\ReferenceMany(targetDocument="MateriaEncuesta")
      */
    protected $materias;

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
