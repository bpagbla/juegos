<?php

    function getGames() {

        include_once "../BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $id = $_SESSION['id'];

        $consulta = $ddbb->consulta("SELECT ROLE FROM `usuario` WHERE ID='$id'");
        $role = '';
        foreach ($consulta as $row) {
            $role = $row['ROLE'];
        }


        $array = array();
        if ($role == 'admin') {
            $consulta = $ddbb->consulta("SELECT ID,TITULO FROM `juego`");
            $titulo = '';
            $id = '';
            foreach ($consulta as $each) {
                $titulo = $each['TITULO'];
                $id = $each['ID'];
                $array[] = [$id, $titulo];
            }
        } else {
            $consulta = $ddbb->consulta("SELECT ID_JUEGO FROM `posee` WHERE ID_USUARIO='$id'");
            foreach ($consulta as $row) {
                $id_juego = $row['ID_JUEGO'];
                $consulta = $ddbb->consulta("SELECT TITULO FROM `juego` WHERE ID='$id_juego'");
                $titulo = '';
                foreach ($consulta as $each) {
                    $titulo = $each['TITULO'];
                }
                $array[] = [$id_juego, $titulo];
            }
        }
        return $array;
    }