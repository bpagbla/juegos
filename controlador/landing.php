<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Controlador_Landing
{
    public function inicia()
    {
        include '../vista/landing.php';
    }

}

$controlador = new Controlador_Landing();
$controlador->inicia();
