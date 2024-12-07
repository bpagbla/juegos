<?php
require_once "../vista/registro.php";

class Controlador
{
    public function __construct()
    {

    }

    public function inicia()
    {
        Vista::MuestraRegistro();
    }

}

$programa = new Controlador();

$programa->inicia();

