<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//require_once "modelo.php";
require_once "vista.php";

class Controlador{
    public function __construct(){

    }

    public function inicia(){
        Vista::MuestraLogin();
    }

}

$programa = new Controlador();

$programa->inicia();
