<?php

namespace AppBundle\Services;



class EncuestaService
{
    function guardarEncuesta($data) {

        $legajo = $data->getLegajo();
        $fichero = "/home/mramos/$legajo.json";

        $encuesta = $data->getEncuesta();

        file_put_contents($fichero, $encuesta, FILE_APPEND | LOCK_EX);

    }

}
