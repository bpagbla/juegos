<?php

    function getGames() {

        include_once "../BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $id = $_SESSION['id'];
        $consulta = $ddbb->consulta("SELECT ID_JUEGO FROM `posee` WHERE ID_USUARIO='$id'");
        $array = array();
        foreach ($consulta as $row) {
            $array[] = $row['ID_JUEGO'];
        }
        return $array;
    }