<?php

//funcion para recoger los juegos que posee el usuario
    function getGames() {

        include_once "../BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        //se recoge el id del usuario para ver su rol
        $id = $_SESSION['id'];

        $consulta = $ddbb->consulta("SELECT ROLE FROM `usuario` WHERE ID='$id'");
        $role = '';
        foreach ($consulta as $row) {
            $role = $row['ROLE'];
        }


        $array = array();
        if ($role == 'admin') { //si el rol es admin
            $consulta = $ddbb->consulta("SELECT ID,TITULO FROM `juego`"); //se sacan todos los juegos de la base de datos
            $titulo = '';
            $id = '';
            //Se guardan el titulo y el id del juego en el array
            foreach ($consulta as $each) {
                $titulo = $each['TITULO'];
                $id = $each['ID'];
                $array[] = [$id, $titulo];
            }
        } else { //si es usuario se sacan solo los juegos que tenga el usuario
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
        return $array; //Se devuelve el array con los juegos
    }