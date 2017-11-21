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

    /**
     * @ODM\Field(type="string")
     */
     protected $token;

    // /**
    //  * @var [MateriaEncuesta] $materias_aprobadas
    //   * @ODM\ReferenceMany(targetDocument="MateriaEncuesta")
    //   */
    // protected $materias_aprobadas;

    /**
     * @var [MateriaEncuesta] $materias_a_cursar
      * @ODM\ReferenceMany(targetDocument="MateriaEncuesta", cascade="persist")
      */
    protected $materias_a_cursar;

    // /**
    //  * @var [MateriaEncuesta] $materias_todaviano
    //   * @ODM\ReferenceMany(targetDocument="MateriaEncuesta")
    //   */
    // protected $materias_todaviano;
    //
    // /**
    //  * @var [MateriaEncuesta] $materias_nopuedohorario
    //   * @ODM\ReferenceMany(targetDocument="MateriaEncuesta")
    //   */
    // protected $materias_nopuedohorario;

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
    public function __construct()
    {
        // $this->materias_aprobadas = new \Doctrine\Common\Collections\ArrayCollection();
        // $this->materias_a_cursar = new \Doctrine\Common\Collections\ArrayCollection();
        // $this->materias_todaviano = new \Doctrine\Common\Collections\ArrayCollection();
        // $this->materias_nopuedohorario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    //
    // public function setMateriasAprobadas($materias_aprobadas) {
    //     $this->materias_aprobadas = $materias_aprobadas;
    // }

    // public function setMateriasACursar($materias_a_cursar) {
    //     $this->materias_a_cursar = $materias_a_cursar;
    // }

    // public function setMateriasTodaviaNo($materias_todaviano) {
    //     $this->materias_todaviano = $materias_todaviano;
    // }
    //
    // public function setMateriasNoPuedoPorHorario($materias_nopuedohorario) {
    //     $this->materias_nopuedohorario = $materias_nopuedohorario;
    // }
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
     * Get materiasAprobadas
     *
     * @return \Doctrine\Common\Collections\Collection $materiasAprobadas
     */
    public function getMateriasAprobadas()
    {
        return $this->materias_aprobadas;
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
     * Get materiasACursar
     *
     * @return \Doctrine\Common\Collections\Collection $materiasACursar
     */
    public function getMateriasACursar()
    {
        return $this->materias_a_cursar;
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
     * Get materiasTodaviano
     *
     * @return \Doctrine\Common\Collections\Collection $materiasTodaviano
     */
    public function getMateriasTodaviano()
    {
        return $this->materias_todaviano;
    }

    /**
     * Add materiasNopuedohorario
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasNopuedohorario
     */
    public function addMateriasNopuedohorario(\AppBundle\Document\MateriaEncuesta $materiasNopuedohorario)
    {
        $this->materias_nopuedohorario[] = $materiasNopuedohorario;
    }

    /**
     * Remove materiasNopuedohorario
     *
     * @param AppBundle\Document\MateriaEncuesta $materiasNopuedohorario
     */
    public function removeMateriasNopuedohorario(\AppBundle\Document\MateriaEncuesta $materiasNopuedohorario)
    {
        $this->materias_nopuedohorario->removeElement($materiasNopuedohorario);
    }

    /**
     * Get materiasNopuedohorario
     *
     * @return \Doctrine\Common\Collections\Collection $materiasNopuedohorario
     */
    public function getMateriasNopuedohorario()
    {
        return $this->materias_nopuedohorario;
    }
}
