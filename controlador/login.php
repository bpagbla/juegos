<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Controlador_Login
{
    public function inicia()
    {
        include_once "../model/login.php";

        if (isset($_POST["user"]) && isset($_POST["passwd"])) {

            if (verificarUsuario($_POST["user"], $_POST["passwd"])) {
                $this->iniciaSesion();
            } else {
                include('../vista/login.php');
            }

        } else {
            include('../vista/login.php');
        }
    }

    public function iniciaSesion()
    {
        header("location: principal.php");
    }

}

$programa = new Controlador_Login();

$programa->inicia();

