<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Controlador
{
    //LANDING
    //funcion para iniciar la vista
    public function iniciaLanding()
    {
        include_once "../vista/vista.php";
        Vista::mostrarLanding();
    }

    //LOGIN
    public function iniciaLogin()
    {
        include_once "../model/login.php";
        include_once "../vista/vista.php";
        $loginAttempt = false;
        //para verificar usuario se comprueba que se ha rellenado el formulario
        if (isset($_POST["user"]) && isset($_POST["passwd"])) {
            //se llama a la funcion verificar usuario del model/login.php
            if (verificarUsuario($_POST["user"], $_POST["passwd"])) {
                //si se verifica el usuario se llama a la funcion iniciaSesion
                $this->iniciaSesion();
            } else {
                //si no se verifica el usuario se cambia la variable de intento a true para poder sacar un mensaje de error
                $loginAttempt = true;
            }
        }
        //incluye la vista del login
        Vista::mostrarLogin($loginAttempt);

    }

    //funcion iniciaSesion
    public function iniciaSesion()
    {
        //te manda a la pagina principal
        header("location: principal.php");
        die();
    }


    //PRINCIPAL

    public function iniciaPrincipal()
    {
        //si hay una sesion creada y se hace logout se destruye la sesión y se envia al landing
        if (isset($_SESSION["nick"])) {
            if (isset($_POST["logout"])) {
                session_unset();
                session_destroy();
                header("location: landing.php");
            }
            //se incluyen los juegos que posee el usuario
            include_once "../model/principal.php";
            $games = getGames();

            //se incluye la vista de principal
            include('../vista/vista.php');
            Vista::mostrarPrincipal($games);
            
        } else { //si no hay sesion creada con el nick se devuelve al landing
            header("location: landing.php");
        }
    }


    //REGISTRO

    public function iniciaRegistro()
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

$controlador = new Controlador();
$controlador->inicia();