<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Controlador_Registro
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
        $passwdBien = false;
        if ($allPosts) {
            //se comprueba que las contraseñas sean iguales
            if (comprobarPasswd()) {
                $passwdBien = true;
                //se llama a la funcion anadirUsuario que devuelve true si se crea la nueva cuenta y false si no
                $added = anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["passwd"]);
            }

        }
        if ($added) {
            //si se crea la nueva cuenta te devuelve al login para que inicies sesion
            header("Location: login.php");
            $_SESSION["nuevaCuenta"] = true;
        }

        //se incluye la vista de registro
        include "../vista/vista.php";
        Vista::mostrarRegistro($allPosts,$added,$passwdBien);
    }

}

$programa = new Controlador_Registro();

$programa->inicia();

