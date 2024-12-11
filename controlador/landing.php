<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Controlador_Landing
{
    //funcion para iniciar la vista
    public function inicia()
    {
        include_once "../vista/vista.php";
        Vista::mostrarLanding();
    }

}

$controlador = new Controlador_Landing();
$controlador->inicia();
