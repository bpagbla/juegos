<?php

    function getGames() {

        include_once "../BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $consulta = $ddbb->consulta("SELECT ID FROM `usuario` WHERE email='$email'");


    }