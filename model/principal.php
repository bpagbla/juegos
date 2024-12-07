<?php

    function getGames() {

        include_once "../BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $email = $_SESSION['email'];
        $consulta = $ddbb->consulta("SELECT ID FROM `usuario` WHERE email='$email'");
        $id = '';
        foreach ($consulta as $row) {
           $id = $row['ID'];
        }
        $consulta = $ddbb->consulta("SELECT ID_JUEGO FROM `posee` WHERE ID_USUARIO='$id'");
        $array = array();
        foreach ($consulta as $row) {
            $array[] = $row['ID_JUEGO'];
        }
        return $array;
    }