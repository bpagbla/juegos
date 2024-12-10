<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "../vista/registro.php";

class Controlador
{
    public function __construct()
    {

    }

    public function inicia()
    {
        $added = false;
        $allPosts = (isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["passwd"]));
        if ($allPosts) {
            include_once '../model/registro.php';
            $added = anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["passwd"]);
        }
        $error = '';
        if (!$added && $allPosts) {
            echo 'Cuenta no creada porque el email o nick ya se esta usando';
        }
        Vista::MuestraRegistro();
    }

}

$programa = new Controlador();

$programa->inicia();

