<?php

namespace AppBundle\Services;



class EncuestaService
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    function guardarEncuesta($data) {
        var_dump($this->path);
        $legajo = $data->getLegajo();
        $fichero = "$this->path $legajo.json";

        $encuesta = $data->getEncuesta();

        file_put_contents($fichero, $encuesta, FILE_APPEND | LOCK_EX);

    }

    function getEncuestaByLegajo($legajo) {



    }

}
