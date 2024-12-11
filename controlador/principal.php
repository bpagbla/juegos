<?php
session_start(); //se crea una sesion
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Controlador_Principal
{
    public function inicia()
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

}

$programa = new Controlador_Principal();

$programa->inicia();