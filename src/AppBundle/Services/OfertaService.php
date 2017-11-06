<?php

namespace AppBundle\Services;

class OfertaService
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    function getOferta() {
        $file = $this->path.'oferta.json';
        $restresult = file_get_contents($file);

        return $restresult;
    }

}
