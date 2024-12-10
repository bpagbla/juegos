<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Controlador_Login
{
    public function inicia()
    {
        include_once "../model/login.php";
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
        include('../vista/login.php');

    }

    //funcion iniciaSesion
    public function iniciaSesion()
    {
        //te manda a la pagina principal
        header("location: principal.php");
        die();
    }

}

$programa = new Controlador_Login();

$programa->inicia();

