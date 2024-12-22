<?php

class model
{
    static function getGames($id)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        //se saca el rol del usuario
        $consulta = $ddbb->consulta("SELECT ROLE FROM usuario WHERE ID=?", array($id));
        $role = '';
        foreach ($consulta as $row) {
            $role = $row['ROLE'];
        }

        $array = array();
        if ($role == 'admin') { //si el rol es admin
            $consulta = $ddbb->consulta("SELECT ID,TITULO FROM juego"); //se sacan todos los juegos de la base de datos
            $titulo = '';
            $id = '';
            //Se guardan el titulo y el id del juego en el array
            foreach ($consulta as $each) {
                $titulo = $each['TITULO'];
                $id = $each['ID'];
                $array[] = [$id, $titulo];
            }
        } else { //si es usuario se sacan solo los juegos que tenga el usuario
            $consulta = $ddbb->consulta("SELECT ID_JUEGO FROM posee WHERE ID_USUARIO=?", array($id));
            foreach ($consulta as $row) {
                $id_juego = $row['ID_JUEGO'];
                $consulta = $ddbb->consulta("SELECT TITULO FROM juego WHERE ID=?", array($id_juego));
                $titulo = '';
                foreach ($consulta as $each) {
                    $titulo = $each['TITULO'];
                }
                $array[] = [$id_juego, $titulo];
            }
        }
        $ddbb->cerrar();
        return $array; //Se devuelve el array con los juegos
    }


    static function getGeneros()
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();


        $array = array();

        $consulta = $ddbb->consulta("SELECT ID,NOMBRE FROM genero"); //se sacan todos los generos de la base de datos
        $nombre = '';
        $id = '';

        //Se guardan el nombre y el id del genero en el array
        foreach ($consulta as $each) {
            $nombre = $each['NOMBRE'];
            $id = $each['ID'];
            $array[] = [$id, $nombre];
        }

        $ddbb->cerrar();
        return $array; //devolver el array con todos los generos
    }

    static function getComp()
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();


        $array = array();

        $consulta = $ddbb->consulta("SELECT ID,NOMBRE FROM compania"); //se sacan todas las compañias de la base de datos
        $nombre = '';
        $id = '';

        //Se guardan el nombre y el id del genero en el array
        foreach ($consulta as $each) {
            $nombre = $each['NOMBRE'];
            $id = $each['ID'];
            $array[] = [$id, $nombre];
        }

        $ddbb->cerrar();
        return $array; //devolver el array con todos los generos
    }

    static function getSist()
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();


        $array = array();

        $consulta = $ddbb->consulta("SELECT ID,NOMBRE FROM sistema"); //se sacan todos los sistemas de la base de datos
        $nombre = '';
        $id = '';

        //Se guardan el nombre y el id del sistema en el array
        foreach ($consulta as $each) {
            $nombre = $each['NOMBRE'];
            $id = $each['ID'];
            $array[] = [$id, $nombre];
        }

        $ddbb->cerrar();
        return $array; //devolver el array con todos los sistemas
    }

    static function getAllUsers()
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $consulta = $ddbb->consulta("SELECT ID,NICK FROM usuario");
        $users = array();
        foreach ($consulta as $row) {
            $users[] = array($row['ID'], $row['NICK']);
        }
        $ddbb->cerrar();
        return array_reverse($users);

    }

    static function getUserData($id)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $consulta = $ddbb->consulta("SELECT EMAIL, NOMBRE, APELLIDOS, ROLE FROM usuario WHERE ID=?", array($id));
        $user = array();
        foreach ($consulta as $row) {
            $user = array($row['ROLE'], $row['EMAIL'], $row['NOMBRE'], $row['APELLIDOS']);
        }
        $ddbb->cerrar();
        return $user;

    }

    static function existeUsuario($loginID, $password)
    {
        //Include the ddbb class
        include_once "BD/baseDeDatos.php";

        //Open the database connection
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        //Check if there is any user with that email or nick
        $consulta = $ddbb->consulta("SELECT ID FROM usuario WHERE EMAIL=? || NICK=?", array($loginID, $loginID));
        $id = "";
        foreach ($consulta as $item) {
            $id = $item["ID"];
        }
        $ddbb->cerrar();
        return $id;
    }

    static function consultaPasswd($id)
    {
        //Include the ddbb class
        include_once "BD/baseDeDatos.php";

        //Open the database connection
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $consPass = $ddbb->consulta("SELECT password FROM usuario WHERE ID=?", array($id));
        $passReal = "";
        foreach ($consPass as $row) {
            $passReal = $row["password"];
        }
        $ddbb->cerrar();
        return $passReal;
    }


    static function abrirSesion($id)
    {

        //Include the ddbb class
        include_once "BD/baseDeDatos.php";

        //Open the database connection
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        //Saco los datos del user
        $datos = $ddbb->consulta("SELECT nick,email,id,role FROM `usuario` WHERE ID=?", array($id));

        //Guardar datos del usuario en la sesion
        foreach ($datos as $row) {
            $_SESSION["nick"] = $row["nick"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
        }

        $ddbb->cerrar();
    }

    static function anadirUsuario($email, $nick, $nombre, $apel, $pass)
    {

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se hace la consulta de usuario y nick para ver si están duplicados
        $datos = $ddbb->consulta("SELECT NICK,EMAIL FROM usuario WHERE EMAIL=? || NICK=?", array($email, $nick));

        $existe = false;
        foreach ($datos as $row) {
            if (isset($row["NICK"]) || isset($row["EMAIL"])) {
                $existe = true; //si están duplicados se cambia la variable a true
            }
        }

        if (!$existe) { //si la variable es false se crea el usuario

            $pass = password_hash($pass, PASSWORD_DEFAULT); //se convierte a hash la contraseña

            //se insertan los datos en la base de datos
            $consulta = $ddbb->insert("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES(?,?,?,?,?,?)", [$email, $nick, $nombre, $apel, $pass, 'user']);
            return true; //devuelve true si se ha creado
        } else {
            return false; //devuelve false si no se ha creado
        }
    }

    static function addGame($titulo, $ruta, $portada, $dev, $dis, $year)
    {

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO juego(ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO) VALUES(?,?,?,?,?,?,?)", [1, $titulo, $ruta, $portada, $dev, $dis, $year]);
        return $consulta;
    }

    static function modifyUser($id, $nick, $rol, $email, $nombre, $apel)
    {

        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        return $ddbb->update("UPDATE usuario SET NICK = ?, ROLE = ?, EMAIL = ?, NOMBRE = ?, APELLIDOS = ? WHERE ID = ?", [$nick, $rol, $email, $nombre, $apel, $id]);

    }

    static function deleteUser($id)
    {

        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos
        return $ddbb->delete("DELETE FROM usuario WHERE ID = ?", array($id));

    }

    static function changePasswd($id, $passwd) {

        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        return $ddbb->update("UPDATE usuario SET PASSWORD = ? WHERE ID = ?", [$hash, $id]);

    }

}