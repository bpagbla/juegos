<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//require_once "modelo.php";
require_once "../vista/vista.php";

class Controlador
{
    public function __construct()
    {

    }

    public function inicia()
    {
        include "../model/modelo.php";
        if (isset($_POST["user"]) && isset($_POST["passwd"])) {
            verificarUsuario($_POST["user"], $_POST["passwd"]);
        }
        Vista::MuestraLogin();
    }

    public function iniciaSesion()
    {
        Vista::MuestraPrincipal();
    }

}

$programa = new Controlador();

$programa->inicia();



