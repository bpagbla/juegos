<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Controlador_Principal
{
    public function inicia()
    {

        if (isset($_SESSION["nick"])) {
            if (isset($_POST["logout"])) {
                session_unset();
                session_destroy();
                header("location: landing.php");
            }
            
            include_once "../model/principal.php";
            $games = getGames();
            include('../vista/principal.php');

            
        } else {
            header("location: landing.php");
        }

    }

}

$programa = new Controlador_Principal();

$programa->inicia();