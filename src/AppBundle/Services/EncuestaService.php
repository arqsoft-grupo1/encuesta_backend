<?php

namespace AppBundle\Services;



class EncuestaService
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    function guardarEncuesta($encuesta) {
        // var_dump($this->path);
        $legajo = $encuesta->getToken();
        $fichero = "$this->path$legajo.json";

        file_put_contents($fichero, $encuesta, FILE_APPEND | LOCK_EX);
    }

    function getEncuestaByToken($token) {
        $file = "$this->path$token.json";
        $restresult = file_get_contents($file);

        return $restresult;
    }
}
