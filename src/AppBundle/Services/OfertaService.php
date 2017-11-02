<?php

namespace AppBundle\Services;

class OfertaService
{
    function getOferta() {
            $file = realpath('/home/mramos/UNQ/encuesta_backend/var/oferta.json');
            $restresult = file_get_contents($file);

            return $restresult;
    }

}
