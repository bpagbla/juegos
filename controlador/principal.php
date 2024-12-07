<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Controlador_Principal
{
    public function inicia()
    {
        include_once "../model/principal.php";
        $games = getGames();
        include('../vista/principal.php');
    }

}

$programa = new Controlador_Principal();

$programa->inicia();

