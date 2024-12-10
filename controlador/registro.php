<?php
require_once "../vista/registro.php";

class Controlador
{
    public function __construct()
    {

    }

    public function inicia()
    {
        include_once '../controlador/registro.php';
        anadirUsuario();
        Vista::MuestraRegistro();
    }

}

$programa = new Controlador();

$programa->inicia();

