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
        $added = false;
        $allPosts = (isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["pass"]));
        if ($allPosts) {
            $added = anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["pass"]);
        }
        $error = '';
        if (!$added && $allPosts) {
            $error = 'Cuenta no creada porque el email o nick ya se esta usando';
        }
        echo $error;
        Vista::MuestraRegistro();
    }

}

$programa = new Controlador();

$programa->inicia();

