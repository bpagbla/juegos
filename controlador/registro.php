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
        //se comprueba que se hayan rellenado todos los campos
        $allPosts = (isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["passwd"]));
        if ($allPosts) {
            //se llama a la funcion anadirUsuario que devuelve true si se crea la nueva cuenta y false si no
            $added = anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["passwd"]);
        }
        if($added){
            //si se crea la nueva cuenta te devuelve al login para que inicies sesion
            header("Location: login.php");
            $_SESSION["nuevaCuenta"] = true;
        }

        //se incluye la vista de registro
        include "../vista/registro.php";
    }

}

$programa = new Controlador();

$programa->inicia();

