<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Controlador
{
    public function __construct()
    {

    }

    public function inicia()
    {

        include_once '../model/registro.php';

        $added = false;
        $error = '';
        $allPosts = (isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["passwd"]));
        if ($allPosts) {
            $added = anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["passwd"]);
        }
        if($added){
            header("Location: login.php");
            $_SESSION["nuevaCuenta"] = true;
        }

        include "../vista/registro.php";
    }

}

$programa = new Controlador();

$programa->inicia();

