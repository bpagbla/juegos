<?php
class model
{
    static function getGames($id, $anio='', $genres='',$comp='')
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $array = array();
        //se sacan solo los juegos que tenga el usuario
        $consulta = $ddbb->consulta("SELECT juego.ID,juego.TITULO, juego.PORTADA FROM juego INNER JOIN posee ON juego.id = posee.id_juego WHERE posee.ID_USUARIO = ?", array($id));
        foreach ($consulta as $row) {
            $id_juego = $row['ID'];
            $titulo = $row['TITULO'];
            $portada = $row['PORTADA'];
            $array[] = [$id_juego, $titulo, $portada];
        }

        $ddbb->cerrar();
        return $array; //Se devuelve el array con los juegos

    }

    static function getAllGames($anio='', $genres='',$comp='')
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();


        $array = array();

        $consulta = $ddbb->consulta("SELECT ID,TITULO,PORTADA FROM juego"); //se sacan todos los generos de la base de datos
        $nombre = '';
        $id = '';

        //Se guardan el nombre y el id del genero en el array
        foreach ($consulta as $each) {
            $titulo = $each['TITULO'];
            $id = $each['ID'];
            $portada = $each['PORTADA'];
            $array[] = [$id, $titulo, $portada];
        }

        $ddbb->cerrar();
        return $array; //devolver el array con todos los juegos
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

    static function getGenJuego($id)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();


        $array = array();

        $consulta = $ddbb->consulta("SELECT g.ID, g.NOMBRE 
    FROM juego_genero jg
    JOIN genero g ON jg.ID_GENERO = g.ID
    WHERE jg.ID_JUEGO = ?", [$id]); //se sacan todos los generos relacionados con el juego


        //Se guardan los nombres de los generos
        foreach ($consulta as $each) {
            $array[$each['ID']] = $each['NOMBRE'];
        }

        $ddbb->cerrar();
        return $array; //devolver el array con todos los generos de un juego
    }

    static function getSistJuego($id)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();


        $array = array();

        $consulta = $ddbb->consulta("SELECT s.ID, s.NOMBRE 
    FROM juego_sistema js
    JOIN sistema s ON js.ID_SIST = s.ID
    WHERE js.ID_JUEGO = ?", [$id]); //se sacan todos los sistemas relacionados con el juego


        //Se guardan los nombres de los generos
        foreach ($consulta as $each) {
            $array[$each['ID']] = $each['NOMBRE'];
        }

        $ddbb->cerrar();
        return $array; //devolver el array con todos los generos de un juego
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
        $consulta = $ddbb->consulta("SELECT ID,NICK,EMAIL FROM usuario"); //Se sacan datos basicos de todos los usaurios
        $users = array();
        foreach ($consulta as $row) {
            $users[] = array($row['ID'], $row['NICK'], $row['EMAIL']);
        }
        $ddbb->cerrar();
        return array_reverse($users);

    }

    static function getUserData($id)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $consulta = $ddbb->consulta("SELECT EMAIL, NOMBRE, APELLIDOS, ROLE FROM usuario WHERE ID=?", array($id)); //Se sacan todos los datos del usuaario por id
        $user = array();
        foreach ($consulta as $row) {
            $user = array($row['ROLE'], $row['EMAIL'], $row['NOMBRE'], $row['APELLIDOS']);
        }
        $ddbb->cerrar();
        return $user;

    }

    static function getID($loginID)
    {
        //Include the ddbb class
        include_once "BD/baseDeDatos.php";

        //Open the database connection
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        //Check if there is any user with that email or nick
        $consulta = $ddbb->consulta("SELECT ID FROM usuario WHERE EMAIL=? || NICK=?", array($loginID, $loginID)); //Se consulta el id del nick o contraseña
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
        $consPass = $ddbb->consulta("SELECT password FROM usuario WHERE ID=?", array($id)); //Se consulta el hash del usuario
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
        return $ddbb->consulta("SELECT nick,email,id,role,carrito FROM `usuario` WHERE ID=?", array($id)); //Sacan datos de usuario para guardar en la session
    }

    static function anadirUsuario($email, $nick, $nombre, $apel, $pass, $role = 'user')
    {

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        $pass = password_hash($pass, PASSWORD_DEFAULT); //se convierte a hash la contraseña

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES(?,?,?,?,?,?)", [$email, $nick, $nombre, $apel, $pass, $role]);

    }

    static function addGame($id, $titulo, $ruta, $portada, $dev, $dis, $sist, $gen, $year, $descripcion)
    {

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se crea el juego en la base de datos
        $consulta = $ddbb->insert("INSERT INTO juego(ID, TITULO, RUTA, PORTADA, DESARROLLADOR, DISTRIBUIDOR, ANIO, DESCRIPCION) VALUES(?,?,?,?,?,?,?,?)", [$id, $titulo, $ruta, $portada, $dev, $dis, $year, $descripcion]);
        return $consulta;
    }

    static function GenGameRel($idJuego, $idGen)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO juego_genero(ID_JUEGO, ID_GENERO) VALUES(?,?)", [$idJuego, $idGen]); //Se añade un juego a un genero
        return $consulta;
    }

    static function SistGameRel($idJuego, $idSist)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO juego_sistema(ID_JUEGO, ID_SIST) VALUES(?,?)", [$idJuego, $idSist]);
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

        return $ddbb->update("UPDATE usuario SET NICK = ?, ROLE = ?, EMAIL = ?, NOMBRE = ?, APELLIDOS = ? WHERE ID = ?", [$nick, $rol, $email, $nombre, $apel, $id]); //Se actualizan datos de usuario con dicho id

    }

    static function deleteUser($id)
    {

        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos
        return $ddbb->delete("DELETE FROM usuario WHERE ID = ?", array($id)); // Se borra usuario con dicho id

    }

    static function changePasswd($id, $passwd)
    {

        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        return $ddbb->update("UPDATE usuario SET PASSWORD = ? WHERE ID = ?", [$hash, $id]); //Cambia contraseña de usuario con dicho id

    }


    static function deleteGame($id)
    {
        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos
        return $ddbb->delete("DELETE FROM juego WHERE ID = ?", array($id)); //Borra juegos que concuerden con id
    }

    static function modifyGame($id, $titulo, $ruta, $portada, $desarrollador, $distribuidor, $year, $descripcion) //Modifica datos de juego por id
    {

        if (empty($id)) {
            return false;
        }

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        return $ddbb->update("UPDATE juego SET TITULO = ?, RUTA=?, PORTADA = ?, DESARROLLADOR = ?, DISTRIBUIDOR = ?, ANIO = ?, DESCRIPCION = ? WHERE ID = ?", [$titulo, $ruta, $portada, $desarrollador, $distribuidor, $year, $descripcion, $id]); //Actualiza los datos de juego por el id

    }

    static private function getMoby($endpoint, $params) //Se hace peticion a la api de mobygames
    {
        include_once 'api.env'; //Saca api key
        $curl = curl_init(); //Inicia curl
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Quita estado de peticion
        $params['api_key'] = $moby_api_key; //Añade api key a peticion
        curl_setopt($curl, CURLOPT_URL, 'https://games.eduardojaramillo.click/v1/' . $endpoint . '?' . http_build_query($params)); //Se hace peticion al endpoint pedido con parametros establecidos
        return curl_exec($curl); //Retorna resultado
    }

    static function getMobyGamebyName($format, $title)
    {
        $params['limit'] = '5';
        $params['format'] = $format;
        $params['title'] = $title;
        return model::getMoby('games', $params); //Se sacan los primeros 5 titutlos que concuerden con titulo
    }

    static function getMobyGamebyID($format, $id, $platform = '')
    {
        $params['limit'] = '5';
        $params['format'] = $format;
        if (!empty($platform)) {
            return model::getMoby('games/' . $id . '/platforms/' . $platform, $params); //Se hace una peticion a la api de mobygames de todas las plataformas de ese juego
        }
        $params['id'] = $id;
        return model::getMoby('games', $params);
    }


    static function existeComp($id)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos


        $consulta = $ddbb->consulta("SELECT ID FROM compania WHERE ID=?", array($id)); //Se mira si existe compañía
        $existe = false;
        foreach ($consulta as $item) {
            if (isset($item["ID"])) {
                $existe = true;
            }
        }
        $ddbb->cerrar();
        return $existe;
    }

    static function addComp($id, $compNombre)
    {

        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO compania(ID, NOMBRE) VALUES(?,?)", [$id, $compNombre]); //Se añade un genero
        $ddbb->cerrar();
        return $consulta;
    }


    static function existeGen($id)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos


        $consulta = $ddbb->consulta("SELECT ID FROM genero WHERE ID=?", array($id)); //Se mira si existe un genero por id
        $existe = false;
        foreach ($consulta as $item) {
            if (isset($item["ID"])) {
                $existe = true;
            }
        }

        $ddbb->cerrar();
        return $existe;
    }

    static function addGen($id, $genNombre)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO genero(ID, NOMBRE) VALUES(?,?)", [$id, $genNombre]); //Se añade un genero
        $ddbb->cerrar();
        return $consulta;
    }


    static function existeSis($id)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos


        $consulta = $ddbb->consulta("SELECT ID FROM sistema WHERE ID=?", array($id)); //Se confirma o desmiente existencia de un sistema
        $existe = false;
        foreach ($consulta as $item) {
            if (isset($item["ID"])) {
                $existe = true;
            }
        }

        $ddbb->cerrar();
        return $existe;
    }

    static function addSis($id, $sisNombre)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        //se insertan los datos en la base de datos
        $consulta = $ddbb->insert("INSERT INTO sistema(ID, NOMBRE) VALUES(?,?)", [$id, $sisNombre]); //Se crea un sistema
        $ddbb->cerrar();
        return $consulta;
    }


    static function existeJuego($id)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos


        $consulta = $ddbb->consulta("SELECT ID FROM juego WHERE ID=?", array($id)); //Se confirma o desmiente existencia de un juego por id
        $existe = false;
        foreach ($consulta as $item) {
            if (isset($item["ID"])) {
                $existe = true;
            }
        }

        $ddbb->cerrar();
        return $existe;
    }

    public static function addCarrito($idUser, $idJuego)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos
        $consulta = $ddbb->insert("INSERT INTO carrito(ID_USUARIO, ID_JUEGO) VALUES (?,?) ON DUPLICATE KEY UPDATE ID_JUEGO=ID_JUEGO", [$idUser, $idJuego]); //Se añade un juego al carrito a menos que ya se haya añadido
        $ddbb->cerrar();

    }

    public static function getCarrito($idUser)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        $consulta = $ddbb->consulta("SELECT carrito.ID_JUEGO, juego.TITULO FROM carrito JOIN juego ON carrito.ID_JUEGO = juego.ID WHERE carrito.ID_USUARIO = ?", [$idUser]); //Se saca el id y titulo de los juegos en el carrito

        $juegos = [];
        foreach ($consulta as $each) {
            $juegos[$each['ID_JUEGO']] = $each['TITULO'];
        }

        $ddbb->cerrar();

        return $juegos;

    }

    public static function borrarJuegoCarrito($id)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos
        return $ddbb->delete("DELETE FROM carrito WHERE ID_JUEGO = ?", array($id)); //Se borra el juego con dicho id

    }

    public static function getGame($id)
    {
        include_once "BD/baseDeDatos.php";

        $ddbb = new BaseDeDatos;
        $ddbb->conectar(); //se conecta a la base de datos

        $consulta = $ddbb->consulta("SELECT * FROM juego WHERE ID = ?", [$id]); //Se sacan los datos del juego con dicho id
        $ddbb->cerrar();

        foreach ($consulta as $each) {
            return [$each["TITULO"], $each["RUTA"], $each["PORTADA"], $each["DESARROLLADOR"], $each["DISTRIBUIDOR"], $each["ANIO"], $id, $each["DESCRIPCION"]]; //Devuelve los datos del juego en un array
        }

        return array();

    }

    public static function getCompNombre($id)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->consulta("SELECT NOMBRE FROM compania WHERE ID=?", [$id]); //se sacan todas las compañias de la base de datos
        $nombre = '';

        //Se guarda el nombre 
        foreach ($consulta as $each) {
            $nombre = $each['NOMBRE'];
        }

        $ddbb->cerrar();
        return $nombre; //devolver nombre
    }

    public static function getTarjetas($id)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $array = array();
        $consulta = $ddbb->consulta("SELECT NUMERO,FECHA_CADUC FROM tarjeta_bancaria WHERE ID_USUARIO=?", [$id]); //se sacan todas los numeros de tarjeta y caducidad
        //Se pasan los ultimos 4 digitos y fecha caducidad
        foreach ($consulta as $each) {
            $array[] = array('num' => substr($each['NUMERO'], -4), 'date' => strtotime($each['FECHA_CADUC']));
        }
        $ddbb->cerrar();
        return $array;

    }

    public static function removeTarjeta($id, $num, $exp)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->delete("DELETE FROM tarjeta_bancaria WHERE ID_USUARIO=? AND NUMERO LIKE ? AND FECHA_CADUC = ?", [$id, '%' . $num, date("Y-m-d", $exp)]); //se sacan todas los numeros de tarjeta y caducidad
        $ddbb->cerrar();
    }

    public static function addTarjeta($id, $num, $exp, $cvv)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->insert("INSERT INTO tarjeta_bancaria(ID_USUARIO,NUMERO,FECHA_CADUC,CVV) VALUES (?,?,?,?)", [$id, $num, $exp, $cvv]); //se sacan todas los numeros de tarjeta y caducidad
        $ddbb->cerrar();
    }

    public static function deleteGameGenRel($idJuego)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->delete("DELETE FROM juego_genero WHERE ID_JUEGO=?", [$idJuego]); //Se quita un juego de un genero
        $ddbb->cerrar();
    }

    public static function deleteGameSistRel($idJuego)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->delete("DELETE FROM juego_sistema WHERE ID_JUEGO=?", [$idJuego]); //Se quita el juego de un sistema
        $ddbb->cerrar();
    }

    public static function deleteGenero($idGenero)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->delete("DELETE FROM genero WHERE ID=?", [$idGenero]); //Se borra el genero con dicho id
        $ddbb->cerrar();
    }

    public static function deleteSistema($idSistema)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->delete("DELETE FROM sistema WHERE ID=?", [$idSistema]); //Se borra el sistema con dicho id
        $ddbb->cerrar();
    }

    public static function changeGeneroName($id, $name)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->update("UPDATE genero SET NOMBRE=? WHERE ID=?", [$name, $id]); //Se actualiza el nombre del genero con dicho id
        $ddbb->cerrar();
    }

    public static function changeSistemaName($id, $name)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->update("UPDATE sistema SET NOMBRE=? WHERE ID=?", [$name, $id]); //Se actualiza el nombre del sistema con dicho id
        $ddbb->cerrar();
    }

    public static function deleteCompany($idCompany)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->delete("DELETE FROM compania WHERE ID=?", [$idCompany]); //Se borra la compañía con dicho id
        $ddbb->cerrar();
    }

    public static function changeCompanyName($id, $name)
    {

        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->update("UPDATE compania SET NOMBRE=? WHERE ID=?", [$name, $id]);//Se cambia el nombre de la compañía con dicho id
        $ddbb->cerrar();
    }

    public static function getGamesForCompany($idCompany)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $array = array();
        $consulta = $ddbb->consulta("SELECT ID,TITULO FROM juego WHERE DESARROLLADOR=? OR DISTRIBUIDOR=?", [$idCompany, $idCompany]); //se sacan todas los numeros de tarjeta y caducidad
        //Se pasan los ultimos 4 digitos y fecha caducidad
        foreach ($consulta as $each) {
            $array[] = array($each["ID"], $each["TITULO"]); //Guardan en un array
        }
        $ddbb->cerrar();
        return $array;
    }

    public static function poseeJuego($idUser, $idJuego)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->consulta("SELECT * FROM posee WHERE ID_USUARIO=? AND ID_JUEGO=?", [$idUser, $idJuego]);
        print_r($consulta);
        $ddbb->cerrar();
        return $consulta;
    }

    public static function ponerJuegoUsuario($idUser, $idJuego)
    {
        include_once "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        $consulta = $ddbb->insert("INSERT INTO posee(ID_USUARIO, ID_JUEGO, FECHA) VALUES(?,?,date(now()))", [$idUser, $idJuego]);


        $ddbb->cerrar();
        return $consulta;
    }

}