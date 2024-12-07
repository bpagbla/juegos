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

        if (isset($_POST["user"]) && isset($_POST["passwd"])) {

            if (verificarUsuario($_POST["user"], $_POST["passwd"])) {
                $this->iniciaSesion();
            } else {
                $loginAttempt = true;
            }

        }

        include('../vista/login.php');

    }

    public function iniciaSesion()
    {
        header("location: principal.php");
        die();
    }

}

$programa = new Controlador_Login();

$programa->inicia();

