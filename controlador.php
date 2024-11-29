<?php

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
