<?php

use Random\RandomException;
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once "vista.php";
include_once "model.php";
include_once "clases/carrito.php";

class Controlador
{

    public function inicia()
    {

        //Si no tiene pagina especificada mandar a landing
        if (!isset($_GET["page"])) {
            Vista::mostrarLanding();
            die();
        }

        //Mandar al metodo adecuado segun pagina pedida
        switch ($_GET["page"]) {
            case "landing":
                Vista::mostrarLanding();
                break;
            case "login":
                $this->iniciaLogin();
                break;
            case "principal":
                $this->iniciaPrincipal();
                break;
            case "registro":
                $this->iniciaRegistro();
                break;
            case "adm-usuarios":
                $this->iniciaAdminUsuarios();
                break;
            case "adm-juegos":
                $this->iniciaAdminJuegos();
                break;
            case "adm-generos":
                $this->iniciaAdminGeneros();
                break;
            case "adm-sistemas":
                $this->iniciaAdminSistemas();
                break;
            case "adm-company":
                $this->iniciaAdminEmpresa();
                break;
            case "juegos":
                $this->iniciaJuegos();
                break;
            case "api":
                $this->fetchAPI();
                break;
            case "ajustes":
                $this->iniciaAjustes();
                break;
            //Si no se conoce la pagina mandar a pagina de error
            default:
                $this->inicia404();
        }

    }

    //API para sacar informacion del lado del cliente
    public function fetchAPI()
    {
        //Comprueba si esta autenticado
        $this->validateSession();
        //Si no especifica que sacar de la api mandar a pagina error
        if (!isset($_GET["endpoint"])) {
            $this->inicia404();
            die();
        }
        //Segun endpoint sacar distintos datos
        switch ($_GET["endpoint"]) {
            case "games":

                //Formato API
                //http://localhost/?page=api&endpoint=games&format=brief&title=

                //Sacar formato de los datos que se mostraran segun opciones de mobygames
                $format = $_GET["format"] ?? "id";

                $json = '';
                //Si manda id del juego que quieren
                if (isset($_GET["id"])) {
                    //Si especifica plataforma sacar datos plataforma
                    if (isset($_GET["platform"])) {
                        $json = model::getMobyGamebyID($format, $_GET["id"], $_GET["platform"]);
                        //Si no solo datos generales juego
                    } else {
                        $json = model::getMobyGamebyID($format, $_GET["id"]);
                    }
                    //Si no especifica id filtar por titulo o por 5 primeras opciones
                } else {
                    $title = $_GET["title"] ?? "";
                    $json = model::getMobyGamebyName($format, $title);
                }
                //Vista que mostara los datos sacados de api
                Vista::showAPIGames($json);
                break;
            //Si endpoint es companies
            case "companies":
                //Sacar de la base de datos las companias disponibles
                $array = model::getComp();
                //Filtrar por nombre si se especifica
                $filter = $_GET["name"] ?? "";
                //Regex format
                $filter = '/.*' . $filter . '.*/i';
                $json["companies"] = array();
                $quant = 0;
                //Sacar 5 primeras companias que cumplen regex
                foreach ($array as $value) {
                    if (preg_match($filter, $value[1])) {
                        $json["companies"][] = array('company_id' => $value[0], 'name' => $value[1]);
                        $quant++;
                    }
                    if ($quant >= 5) {
                        break;
                    }
                }
                //Vista que mostara los datos sacados
                Vista::showAPIGames(json_encode($json));
                break;
            //Si genres
            case "genres":
                //Sacar generos disponibles de la base de datos
                $array = model::getGeneros();
                //Filtrar por nombre si se especifica
                $filter = $_GET["name"] ?? "";
                //Regex format
                $filter = '/.*' . $filter . '.*/i';
                $json["genres"] = array();
                $quant = 0;
                //Sacar 5 primeras companias que cumplen regex
                foreach ($array as $value) {
                    if (preg_match($filter, $value[1])) {
                        $json["genres"][] = array('genre_id' => $value[0], 'name' => $value[1]);
                        $quant++;
                    }
                    if ($quant >= 5) {
                        break;
                    }
                }
                //Vista que mostara los datos sacados
                Vista::showAPIGames(json_encode($json));
                break;
            case "platforms":
                //Sacar plataformas disponibles de la base de datos
                $array = model::getSist();
                //Filtrar por nombre si se especifica
                $filter = $_GET["name"] ?? "";
                //Regex format
                $filter = '/.*' . $filter . '.*/i';
                $json["platforms"] = array();
                $quant = 0;
                //Sacar 5 primeras companias que cumplen regex
                foreach ($array as $value) {
                    if (preg_match($filter, $value[1])) {
                        $json["platforms"][] = array('platform_id' => $value[0], 'name' => $value[1]);
                        $quant++;
                    }
                    if ($quant >= 5) {
                        break;
                    }
                }
                //Vista que mostara los datos sacados
                Vista::showAPIGames(json_encode($json));
                break;
            default:
                $this->inicia404();
        }
    }

    public function validateSession()
    {
        //si hay una sesion creada y se hace logout se destruye la sesión y se envia al landing
        if (isset($_SESSION["nick"])) {
            if (isset($_POST["logout"])) {

                session_unset();
                session_destroy();
                header("location: ?page=login");
            }
        } else { //si no hay sesion creada con el nick se devuelve al landing
            header("location: ?page=login");
        }
    }

    public function validateAdminSession()
    {
        //si hay una sesion creada y se hace logout se destruye la sesión y se envia al landing
        if (isset($_SESSION["nick"])) {
            if ($_SESSION["role"] === "admin") {
                if (isset($_POST["logout"])) {
                    session_unset();
                    session_destroy();
                    header("location: ?page=login");
                }
            } else {
                //Si hay session pero no es admin se manda a principal
                header("location: ?page=principal");
            }
        } else { //si no hay sesion creada con el nick se devuelve al landing
            header("location: ?page=login");
        }
    }

    //ADMIN
    public function iniciaAdminUsuarios()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //variable con errores a mostar
        $error = "";

        //Si se especifica una accion a realizar
        if (isset($_POST["action"])) {

            //Si accion es aplicar cambios
            if ($_POST["action"] == "user-apply") {

                //Saca todos los usuarios y comprueba que no hay nick o email duplicado
                $users = model::getAllUsers();
                $dupe = false;
                foreach ($users as $user) {
                    //Si el usuario es si mismo se salta
                    if ($user[0] == $_POST["id"]) {
                        continue;
                    }
                    if ($user[1] === $_POST["nick"]) {
                        $dupe = true;
                        $error = "El nick ya esta en uso";
                        break;
                    }
                    if ($user[2] === $_POST["email"]) {
                        $dupe = true;
                        $error = "El email ya esta en uso";
                        break;
                    }
                }

                //Si no hay duplicado se cambia y se actualiza la session
                if (!$dupe) {
                    //se modifica el usuario en la base de datos
                    model::modifyUser($_POST["id"], $_POST["nick"], $_POST["role"], $_POST["email"], $_POST["firstName"], $_POST["lastName"]);

                    //Si se esta modificando a si mismo cambiar los datos correspondientes en la session
                    if ($_POST["id"] == $_SESSION["id"]) {
                        $_SESSION["nick"] = $_POST["nick"];
                        $_SESSION["email"] = $_POST["email"];
                        $_SESSION["role"] = $_POST["role"];
                    }

                    //mensaje de notificacion
                    $this->sendNotification("Usuario Actualizado", "Se han actualizado los datos del usuario exitosamente!");
                    header('Location: ?page=adm-usuarios');
                    die();
                } else {
                    //Notificacion de error
                    $this->sendNotification("Error en el cambio", $error);
                }

            }

            //Borrar usuario
            if ($_POST["action"] == "user-delete") {

                //si el id del usuario que se quiere borrar es el mismo que el de la sesión sale error
                if ($_POST["id"] === $_SESSION["id"]) {
                    $this->sendNotification("User error", "No puedes borrarte a ti mismo.");
                } else {
                    //Se borra el usuario
                    $this->sendNotification("Usuario borrado", "Se ha borrado el usuario exitosamente.");
                    model::deleteUser($_POST["id"]);
                }
                header('Location: ?page=adm-usuarios');
                die();

            }

            //Cambio de contraseña
            if ($_POST["action"] == "user-passwd-apply") {

                //Si las contraseñas son identicas se cambian
                if ($_POST["passwd"] === $_POST["passwd2"]) {
                    //Solicita al modelo el cambio
                    model::changePasswd($_POST["id"], $_POST["passwd"]);
                    $this->sendNotification("Contraseña cambiada", "La contraseña se ha cambiado correctamente!");
                } else {
                    //Si no son identicas se notifica al usuario
                    $this->sendNotification("Error Usuario", "Ha habido un error cambiando la contraseña. Contacta con el administrador del sistema.");
                }
                header('Location: ?page=adm-usuarios');
                die();
            }

            //Si se desea borrar una forma de pago
            if (isset($_POST["subaction"]) && $_POST["subaction"] == "remove-payment") {
                //Se saca la tarjeta del string parseando sus datos
                model::removeTarjeta($_POST["id"], substr($_POST["card"], 0, 4), substr($_POST["card"], 4));
            }

            //Si se desea añadir un metodo de pago
            if (isset($_POST["subaction"]) && $_POST["subaction"] == "add-payment") {

                //Se formatea para la base de datos los datos sacados del formulario y se pasa al modelo para añadir
                $dateTime = DateTime::createFromFormat('d/m/y', '01/' . $_POST["exp"]);
                model::addTarjeta($_POST["id"], $_POST["num"], $dateTime->format("Y-m-d"), $_POST["cvv"]);

            }

            //Si se quire añadir un usuario
            if ($_POST["action"] == "user-add") {

                //Sacan todos los usuarios para ver si esta duplicado
                $users = model::getAllUsers();
                $dupe = false;
                foreach ($users as $user) {
                    if ($user[1] === $_POST["nick"]) {
                        $dupe = true;
                        $error = "El nick ya esta en uso";
                        break;
                    }
                    if ($user[2] === $_POST["email"]) {
                        $dupe = true;
                        $error = "El email ya esta en uso";
                        break;
                    }
                }

                //Si no esta duplicado se prosigue
                if (!$dupe) {
                    try {
                        //Se crea una contraseña aletoria para que el administrador pueda pasar al usuario pertinente sin tener que pensar cada vez una.
                        $characters = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&');
                        $random = '';
                        for ($i = 0; $i < 16; $i++) {
                            $random .= $characters[rand(0, sizeof($characters) - 1)];
                        }

                        //Se pasa al modelo para añadir al usuario
                        Model::anadirUsuario($_POST["email"], $_POST["nick"], $_POST["firstName"], $_POST["lastName"], $random, $_POST["role"]);

                        //Si se añade se le pasa la contraseña por notificacion y si no se comenta el error
                        $this->sendNotification('Usuario Creado', "Usuario registrado correctamente. Contraseña aleatoria: " . htmlentities($random), 20000);
                        //Si hay problema generando la contraseña aletoria se comenta al admin
                    } catch (RandomException $e) {
                        $this->sendNotification('', "Error al generar una contraseña aletoria. Reporta al administrador del sistema");
                    } finally {

                        //Se elimina el post request
                        header('Location: ?page=adm-usuarios');
                        die();

                    }
                }

            }

        }

        //Se sacan todos los usuarios para mostrar por la vista
        $users = model::getAllUsers();

        //Si se desean editar los usuarios se saca la informacion de dicho usuario
        if (isset($_POST["action"]) && $_POST["action"] == "user-edit") {
            $user = model::getUserData($_POST["id"]);
            //se incluye la vista de principal con datos de usuario pedido
            Vista::mostrarAdminUsuarios($error, $users, $user, model::getTarjetas($_POST["id"]));
        } else {
            //se incluye la vista de principal
            Vista::mostrarAdminUsuarios($error, $users);
        }

    }

    public function thumbnailFilesUpload($file, $id)
    {
        $mime = $_FILES[$file]["type"];
        $extension = explode("/", $mime); //coge la extensión del archivo
        $ruta = "img/game-thumbnail/" . $id . "." . $extension[1]; //Cambia el nombre por el id
        $resultado = move_uploaded_file($_FILES[$file]["tmp_name"], $ruta); //mueve el archivo al directorio
        if ($resultado) { //si ha salido bien que devuelva la ruta
            return $ruta;
        } else {
            return 0; //si no se ha subido que devuelva 0
        }

    }


    function download_image1($url, $destino)
    {
        $archivo = fopen($destino, 'w+');// open file handle

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FILE, $archivo); //Guarda la salida el el archivo
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //Evita que saque un estado de respuesta innecesario
        curl_exec($curl); //Saca foto
        curl_close($curl); //cierra curl
        fclose($archivo); // cierra gestor de escritura
    }
    function get_mime_type($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true); // No descargar el cuerpo
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Ejecutar cURL
        curl_exec($ch);

        // Obtener el MIME type
        $mime_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        curl_close($ch);

        return $mime_type;
    }

    public function genIdNeg()
    {
        $id = rand(-9999999999, -1);
        return $id;
    }


    public function importarGame($json_data)
    {
        foreach ($json_data as $juego) {
            //comprobar que existen los datos en la bbdd antes de intentar añadir el juego. Si no existen da error.

            foreach ($juego[0]["generos"] as $genero) {
                if (!model::existeGenNombre($genero)) {
                    $this->sendNotification("Género no existe", $genero . " no existe en la base de datos");
                    header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                    die();
                }
            }

            foreach ($juego[0]["sistemas"] as $sistema) {
                if (!model::existeSisNombre($sistema)) {
                    $this->sendNotification("Sistema no existe", $sistema . " no existe en la base de datos");
                    header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                    die();
                }
            }

            if (!model::existeCompNombre($juego[0]["desarrollador"])) {
                $this->sendNotification("Compañía no existe", $juego[0]["desarrollador"] . " no existe en la base de datos");
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            }

            if (!model::existeCompNombre($juego[0]["distribuidor"])) {
                $this->sendNotification("Compañía no existe", $juego[0]["distribuidor"] . " no existe en la base de datos");
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            }

            //mover los archivos ????
            $moverJuego = move_uploaded_file("/uploads/" . $juego["ruta"], "/games");
            $moverPortada = move_uploaded_file("/uploads/" . $juego["portada"], "/img/game-thumbnail");

            if (!$moverJuego) {
                $this->sendNotification("Juego no encontrado", "La ruta del juego " . $juego[0]["titulo"] . " no se ha encontrado");
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            }

            if (!$moverPortada) {
                $this->sendNotification("Portada no encontrada", "La portada del juego " . $juego[0]["titulo"] . " no se ha encontrado");
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            }

            //id aleatorio negativo
            $id = $this->genIdNeg();

            //comprobar si existe el id (si existe, generar otro)
            while (model::existeJuego($id)) {
                $id = $this->genIdNeg();
            }


            //añadir el juego
            model::addGame($id, $juego["titulo"], $juego[0]["ruta"], $juego[0]["portada"], $juego[0]["desarrollador"], $juego[0]["distribuidor"], $juego[0]["sistemas"], $juego[0]["generos"], $juego[0]["año"], "");
        }
    }


    public function iniciaAdminJuegos()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //si se importa un zip con juegos que mueva el zip a la carpeta uploads
        if (isset($_FILES["archivoImport"]) && $_FILES["archivoImport"]["error"] != '4') {
            $rutaZip = "uploads/temp.zip";
            $resultado = move_uploaded_file($_FILES["archivoImport"]["tmp_name"], $rutaZip);
            if (!$resultado) {
                $this->sendNotification("Error al subir archivo", "Ha ocurrido un error al subir el archivo");
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            } else {
                $zip = new ZipArchive;
                if ($zip->open($rutaZip) === TRUE) {
                    $zip->extractTo('uploads/');
                    $zip->close();

                    if (file_exists("uploads/juegos.json")) {
                        $json = file_get_contents("uploads/juegos.json");
                        if ($json === false) {
                            die("error");
                        }

                        $json_data = json_decode($json, true);

                        if ($json_data === null) {
                            die("Erroor");
                        }

                        $this->importarGame($json_data);

                    }
                    if (file_exists("uploads/juegos.xml")) {
                        $xml = simplexml_load_file("uploads/juegos.xml");
                        
                        if ($xml === false) {
                            die("error");
                        }

                        echo $xml;


                    }

                } else {
                    $this->sendNotification("Error al Importar", "No se ha podido abrir el ZIP");
                    header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                    die();
                }
            }

        }



        if (isset($_POST["addGame"])) {

            $ruta = "";
            //Si no hay portada subida por api se saca de input
            if (!empty($_POST["fileSrc"])) {
                $image_url = $_POST["fileSrc"];
                $ruta = "img/game-thumbnail/" . $_POST['id'];

                // Obtener el MIME type de la URL
                $mime_type = $this->get_mime_type($image_url);
                $mime_type = explode("/", $mime_type);
                $ruta = $ruta . "." . $mime_type[1];
                if ($mime_type) {

                    // Llamar a la función para descargar la imagen
                    $this->download_image1($image_url, $ruta);
                } else {
                    $ruta = 0;
                }
            } else {
                //Si se ha subido la imagen por input comprobar que esta y descargar. si no dar error
                if (isset($_FILES["portada"]) && $_FILES["portada"]["error"] != '4') {
                    $ruta = $this->thumbnailFilesUpload("portada", $_POST["id"]);
                } else {
                    $this->sendNotification("Error Juego", "No todos los campos necesarios estan rellenos");
                    header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                    die();
                }
            }



            //Si no se sube el juego se pasa  error si no se guarda con nombre id juego
            if (isset($_FILES["archivoJuego"]) && $_FILES["archivoJuego"]["error"] != '4') {
                //Determina ruta
                $rutaJuego = "games/" . $_POST['id'] . ".jsdos";
                $resultado = move_uploaded_file($_FILES["archivoJuego"]["tmp_name"], $rutaJuego); //mueve el archivo al directorio
                if (!$resultado) {
                    $this->sendNotification("error file", "error file");
                }
            } else {
                //Error no se subio
                $this->sendNotification("Error Juego", "No todos los campos necesarios estan rellenos");
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            }

            //Comprueba que todos los campos estan si no pasar error
            if (isset($_POST["id"]) && isset($_POST["titulo"]) && isset($_POST["descripcion"]) && isset($_POST["dis"]) && isset($_POST["dev"]) && isset($_POST["sist"]) && isset($_POST["gen"]) && isset($_POST["year"]) && isset($_POST["descripcion"])) { //verifica que se han rellenado los campos
                //ver si el juego existe
                if (!model::existeJuego($_POST["id"])) {
                    if ($ruta != 0) { //si se ha subido la imagen mete los datos en la bbdd

                        //ver si existe dev y dis y si no existen crearlos
                        if (!model::existeComp($_POST["dis"])) {
                            model::addComp($_POST["dis"], $_POST["dis" . $_POST["dis"]]);
                            $creadoDis = true;
                        }
                        if (!model::existeComp($_POST["dev"])) {
                            model::addComp($_POST["dev"], $_POST["dev" . $_POST["dev"]]);
                            $creadoDev = true;
                        }

                        //ver si existen los generos y si no existen crearlos
                        //relacionarlos con el juego
                        foreach ($_POST["gen"] as $gen) {
                            if (!model::existeGen($gen)) {
                                model::addGen($gen, $_POST["gen" . $gen]);
                                $creadoGen = true;
                            }

                        }

                        //ver si existen los sistemas y si no existen crearlos
                        //relacionarlos con el juego
                        foreach ($_POST["sist"] as $sis) {
                            if (!model::existeSis($sis)) {
                                model::addSis($sis, $_POST["sist" . $sis]);
                                $creadoSis = true;
                            }
                        }

                        $inserta = model::addGame($_POST["id"], $_POST["titulo"], $rutaJuego, $ruta, $_POST["dev"], $_POST["dis"], $_POST["sist"], $_POST["gen"], $_POST["year"], $_POST["descripcion"]);
                        $this->sendNotification("Juego creado", "Juego creado con exito!");

                        if ($inserta) {
                            //relacionar los GENEROS con el juego
                            foreach ($_POST["gen"] as $gen) {

                                model::GenGameRel($_POST["id"], $gen);
                            }

                            //relacionar los SISTEMAS con el juego
                            foreach ($_POST["sist"] as $sis) {

                                model::SistGameRel($_POST["id"], $sis);
                            }
                        }


                        header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                        die();
                    } else {
                        $this->sendNotification("Error Juego", "Fallo al subir la imagen");
                    }

                } else {
                    $this->sendNotification("Juego ya existente", "Este juego ya existe");
                }


            } else {
                $this->sendNotification("Error Juego", "No todos los campos necesarios estan rellenos"); //OTRO MENSAJE DE ERROR
            }

        }


        //Si hay accion
        if (isset($_POST["action"])) {

            //Accion para editar valores del juego
            if ($_POST["action"] == "game-edit") {
                //Se guardan el la session datos del juego para mostrar
                $_SESSION["datosJuego"] = model::getGame($_POST["idJuego"]);
                $_SESSION["iddev"] = $_SESSION["datosJuego"][3];
                $_SESSION["iddis"] = $_SESSION["datosJuego"][4];

                $_SESSION["datosJuego"][3] = model::getCompNombre($_SESSION["datosJuego"][3]);
                $_SESSION["datosJuego"][4] = model::getCompNombre($_SESSION["datosJuego"][4]);

                $_SESSION["generosJuego"] = model::getGenJuego($_POST["idJuego"]);
                $_SESSION["sistemasJuego"] = model::getSistJuego($_POST["idJuego"]);

            }
            if ($_POST["action"] == "game-apply") {
                //Si se aplica una edicion del juego se crea la ruta de las imagenes y el juego y mandan erorres pertinentes
                $rutaJuego = "games/" . $_POST['idEdit'] . ".jsdos";
                if (isset($_FILES["rutaEdit"]) && $_FILES["rutaEdit"]["error"] != '4') {
                    $resultado = move_uploaded_file($_FILES["rutaEdit"]["tmp_name"], $rutaJuego); //mueve el archivo al directorio
                    if (!$resultado) {
                        $this->sendNotification("Error Archivo", "Error subiendo el archivo");
                        header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                        die();
                    }
                }

                //Se saca la ruta original
                $ruta = $_POST['fileSrcEdit'];

                //Si nueva portada se sobreescribe
                if (isset($_FILES["portadaEdit"]) && $_FILES["portadaEdit"]["error"] != '4') {
                    $ruta = $this->thumbnailFilesUpload("portadaEdit", $_POST["idEdit"]);
                }

                //Si no hay todos los campos se pasa un error.
                if (!isset($_POST["dev"]) || !isset($_POST["dis"]) || !isset($_POST["idEdit"]) || !isset($_POST["tituloEdit"]) || !isset($ruta) || !isset($_POST["yearEdit"]) || !isset($_POST["descripcionEdit"])) {
                    $this->sendNotification("Error Actualizando", "Faltan campos necesarios para proceder");
                    header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                    die();
                }

                //Si no se pasa al modelo para procesar
                if (model::modifyGame($_POST["idEdit"], $_POST["tituloEdit"], $rutaJuego, $ruta, $_POST["dev"], $_POST["dis"], $_POST["yearEdit"], $_POST["descripcionEdit"])) {

                    //Si se ha editado correctamente se guarda para mostrar
                    $this->sendNotification("Juego Editado", "Se ha editado el juego correctamente");


                    //borrar todas las relaciones
                    model::deleteGameGenRel($_POST["idEdit"]);
                    model::deleteGameSistRel($_POST["idEdit"]);

                    //ver si existen los generos y si no existen crearlos
                    //relacionarlos con el juego
                    foreach ($_POST["gen"] as $gen) {
                        if (!model::existeGen($gen)) {
                            model::addGen($gen, $_POST["gen" . $gen]);
                            $creadoGen = true;
                        }
                    }

                    //ver si existen los sistemas y si no existen crearlos
                    //relacionarlos con el juego
                    foreach ($_POST["sist"] as $sis) {
                        if (!model::existeSis($sis)) {
                            model::addSis($sis, $_POST["sist" . $sis]);
                            $creadoSis = true;
                        }
                    }

                    //relacionar los GENEROS con el juego
                    foreach ($_POST["gen"] as $gen) {

                        model::GenGameRel($_POST["idEdit"], $gen);
                    }

                    //relacionar los SISTEMAS con el juego
                    foreach ($_POST["sist"] as $sis) {

                        model::SistGameRel($_POST["idEdit"], $sis);
                    }


                } else {
                    $this->sendNotification("Error al editar Juego", "No se ha editado el juego");

                }
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();
            }

            if ($_POST["action"] == "game-delete") {

                model::deleteGame($_POST["idJuego"]);
                $this->sendNotification("Juego eliminado", "Juego eliminado correctamente del inventario global");
                header(header: 'Location: ?page=adm-juegos'); //Redirige a la misma pagina
                die();

            }
        }

        //se incluyen los juegos que posee el usuario
        $games = ($_SESSION['role'] == 'admin') ? Model::getAllGames() : Model::getGames($_SESSION['id']);
        $generos = Model::getGeneros();
        $companias = model::getComp();
        $sistemas = model::getSist();

        //se incluye la vista de principal
        Vista::mostrarAdminJuegos($games, $generos, $sistemas, $companias);

    }

    public function iniciaAdminGeneros()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //Si la accion es para borrar el genero
        if (isset($_POST['action']) && $_POST['action'] == "genero-delete") {
            //Se pasa al modelo la orden y se notifica al usuario
            model::deleteGenero($_POST['id']);
            $this->sendNotification("Genero Borrado", "Borrado " . $_POST['nombre'] . ' exitosamente!');
            header('Location: ?page=adm-generos');
            die();
        }

        //Si se desea añadir genero
        if (isset($_POST['action']) && $_POST['action'] == "genero-add") {
            //Se comprueba que no se este usando ese id y en ese caso se crea o se da error
            if (!model::existeGen($_POST['id'])) {
                model::addGen($_POST['id'], $_POST['name']);
                $this->sendNotification("Genero Añadido", "Añadido " . $_POST['nombre'] . ' exitosamente!');
            } else {
                $this->sendNotification("Error", 'Este id ya esta en uso');
            }
            header('Location: ?page=adm-generos');
            die();
        }

        //Editar genero
        if (isset($_POST['action']) && $_POST['action'] == "genero-edit-apply") {
            //Se cambia el nombre del genero y se notifica al usuario
            model::changeGeneroName($_POST['id'], $_POST['name']);
            $this->sendNotification("Nombre Cambiado", 'Se ha cambiado el nombre del genero exitosamente!');
            header('Location: ?page=adm-generos');
            die();
        }

        //se incluye la vista de principal
        Vista::mostrarAdminGeneros(model::getGeneros());
    }

    public function iniciaAdminSistemas()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //Si la accion es para borrar el sistema
        if (isset($_POST['action']) && $_POST['action'] == "sistema-delete") {
            //Se pasa al modelo la orden y se notifica al usuario
            model::deleteSistema($_POST['id']);
            $this->sendNotification("Sistema Borrado", "Borrado " . $_POST['nombre'] . ' exitosamente!');
            header('Location: ?page=adm-sistemas');
            die();
        }

        //Si se desea añadir genero
        if (isset($_POST['action']) && $_POST['action'] == "sistema-add") {
            //Se comprueba que no se este usando ese id y en ese caso se crea o se da error
            if (!model::existeSis($_POST['id'])) {
                model::addSis($_POST['id'], $_POST['name']);
                $this->sendNotification("Genero Añadido", "Añadido " . $_POST['nombre'] . ' exitosamente!');
            } else {
                $this->sendNotification("Error", 'Este id ya esta en uso');
            }
            header('Location: ?page=adm-sistemas');
            die();
        }

        //Editar sistema
        if (isset($_POST['action']) && $_POST['action'] == "sistema-edit-apply") {
            //Se cambia el nombre del genero y se notifica al usuario
            model::changeSistemaName($_POST['id'], $_POST['name']);
            $this->sendNotification("Nombre Cambiado", 'Se ha cambiado el nombre del genero exitosamente!');
            header('Location: ?page=adm-sistemas');
            die();
        }

        //se incluye la vista de principal
        Vista::mostrarAdminSistemas(model::getSist());
    }
    public function iniciaAdminEmpresa()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //Si la accion es para borrar la empresa
        if (isset($_POST['action']) && $_POST['action'] == "company-delete") {
            //Se mira si esa empresa tiene algun juego asociado al mismo
            $games = model::getGamesForCompany($_POST['id']);
            //Si no tiene juego se borra y si no se notifica al usuario que tiene juegos y se les muestran los mismos
            if (sizeof($games) > 0) {
                Vista::mostrarAdminEmpresa(model::getComp(), $games);
            } else {
                model::deleteCompany($_POST['id']);
                $this->sendNotification("Compañía Borrado", "Borrado " . $_POST['nombre'] . ' exitosamente!');
                header('Location: ?page=adm-company');
            }
            die();
        }

        //Si se desea añadir empresa
        if (isset($_POST['action']) && $_POST['action'] == "company-add") {
            //Se comprueba que no se este usando ese id y en ese caso se crea o se da error
            if (!model::existeComp($_POST['id'])) {
                model::addComp($_POST['id'], $_POST['name']);
                $this->sendNotification("Genero Añadido", "Añadido " . $_POST['nombre'] . ' exitosamente!');
            } else {
                $this->sendNotification("Error", 'Este id ya esta en uso');
            }
            header('Location: ?page=adm-company');
            die();
        }

        //Editar empresa
        if (isset($_POST['action']) && $_POST['action'] == "company-edit-apply") {
            //Se cambia el nombre al pedido y se notifica al usuario
            model::changeCompanyName($_POST['id'], $_POST['name']);
            $this->sendNotification("Nombre Cambiado", 'Se ha cambiado el nombre de la compañía exitosamente!');
            header('Location: ?page=adm-company');
            die();
        }

        //se incluye la vista de principal
        Vista::mostrarAdminEmpresa(model::getComp());
    }

    public function iniciaJuegos()
    {

        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateSession();


        $carrito = new Carrito();
        //Si el carrito no esta en la session se crea y saca de la bbddd si no se unserialize
        if (empty($_SESSION['carrito'])) {
            $this->sendNotification("Reanudando Carrito", "Sacado carrito se su session anterior en otro dispositivo");
            $carrito->setCarrito(model::getCarrito($_SESSION["id"]));
            $_SESSION['carrito'] = serialize($carrito);
        } else {
            $carrito = unserialize($_SESSION['carrito']);
        }

        //se incluyen todos los juegos y los juegos que posee el usuario
        $minYear = $_GET['minYear'] ?? '';
        $maxYear = $_GET['maxYear'] ?? '';
        $genres = $_GET['gen'] ?? '';
        $dev = $_GET['dev'] ?? '';
        $dis = $_GET['dis'] ?? '';
        $sist = $_GET['sist'] ?? '';
        $games = Model::getAllGames($minYear, $maxYear, $genres, $dev, $dis, $sist);
        $gamesOwned = ($_SESSION['role'] == 'admin') ? $games : Model::getGames($_SESSION['id'], $minYear, $maxYear, $genres, $dis, $sist);

        $i = 0;
        //Se guarda true si al usuario le pertenece el juego
        foreach ($games as $game) {
            foreach ($gamesOwned as $gameOwned) {
                if ($game[0] == $gameOwned[0]) {
                    $games[$i][] = true;
                }
            }
            $i++;

            //Se procesa el borrado de un juego. Tanto en el objeto como en la bbdd
            if (isset($_POST["borrar$game[0]"])) {

                //Actualizo objeto
                $carrito->sacarJuegoCarrito($game[0]);

                //Actualizo bbdd
                model::borrarJuegoCarrito($game[0]);

                //Guardo en session
                $_SESSION['carrito'] = serialize($carrito);

                $this->sendNotification('Juego eliminado del carrito', "Se ha eliminado el juego del carrito correctamente", 20000);

                header("Location: ?page=juegos");
                die();
            }

            //Se procesa añadir un juego. Tanto en el objeto como en la bbdd
            if (isset($_POST["juegoCompra$game[0]"])) {

                //Actualizo objeto
                $carrito->meterJuegoCarrito($game[0], $game[1]);

                //Guardo en session
                $_SESSION['carrito'] = serialize($carrito);

                //actualizar bbdd
                model::addCarrito($_SESSION["id"], $game[0]);
                $this->sendNotification('Juego añadido al carrito', "Se ha añadido el juego al carrito correctamente", 20000);
                header("Location: ?page=juegos");
                die();
            }


            if (isset($_POST["regaloNickname$game[0]"])) {
                echo $_POST["regaloNickname$game[0]"];
                //verificar si existe el usuario o no
                $id = model::getID($_POST["regaloNickname$game[0]"]);
                if ($id != "") {
                    if ($id == $_SESSION["id"]) {
                        $this->sendNotification("Error", "No puedes regalarte un juego a ti mismo.");
                    }
                    //comprobar si el otro usuario ya tiene el juego
                    else if (model::getRole($id) == "admin" || !empty(model::poseeJuego($id, $game[0]))) {
                        $this->sendNotification("El usuario seleccionado ya tiene este juego", "El usuario seleccionado ya posee este juego.");
                    } else {
                        //si no tiene el juego, ponerselo
                        model::ponerJuegoUsuario($id, $game[0]);
                        model::regalarJuegoUsuario($_SESSION["id"], $id, $game[0]);
                        $this->sendNotification("Juego Regalado con éxito ", "Se ha regalado el juego correctamente.");
                    }
                } else {
                    $this->sendNotification("El usuario introducido no existe", "Comprueba que has escrito correctamente el nombre de usuario a quien quieres regalar el juego.");
                }
                header("Location: ?page=juegos");
                die();
            }

        }


        //se incluye la vista de principal
        Vista::mostrarJuegos($games);
    }

    //LOGIN
    public function iniciaLogin()
    {
        $loginAttempt = false;
        //para verificar usuario se comprueba que se ha rellenado el formulario
        if (isset($_POST["user"]) && isset($_POST["passwd"])) {
            //se llama a la funcion existe usuario del model/login.php
            if ($this->verificaUsuario(Model::getID($_POST["user"]))) {

                //si se verifica el usuario se llama a la funcion iniciaSesion
                header("location: ?page=principal");
                die();
            } else {
                //si no se verifica el usuario se cambia la variable de intento a true para poder sacar un mensaje de error
                $loginAttempt = true;
            }
        }
        //incluye la vista del login
        Vista::mostrarLogin($loginAttempt);
    }

    //Ajustes
    public function iniciaAjustes()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateSession();

        //Si no hay una accion se procesa la vista de forma normal con los datos del usuario
        if (!isset($_POST["action"])) {
            Vista::mostrarAjustes(model::getUserData($_SESSION["id"]), model::getTarjetas($_SESSION["id"]));
            die();
        }

        //Si hay una accion
        switch ($_POST["action"]) {

            //Si se desa actualizar la contraseña
            case "update-passwd":
                //Se mira que las dos contraseñas sean iguales y no vacias
                if (!empty($_POST["passwd1"]) && !empty($_POST["passwd2"]) && $_POST["passwd1"] === $_POST["passwd2"]) {
                    //Se pasa al modelo el cambio de contraseña
                    model::changePasswd($_SESSION["id"], $_POST["passwd1"]);
                    //Notifica al usuario
                    $this->sendNotification("Contraseña Cambiada", "Se ha cambiado la contraseña correctamente!");
                    header('Location: ?page=ajustes');
                    die();
                } else {
                    $this->sendNotification("Error Contraseña", "Rellena Correctamente los campos!");
                }
                break;
            //Se actualizan los datos del usuario
            case "update-personal":
                //Se mira si hay duplicados
                $users = model::getAllUsers();
                $dupe = false;
                foreach ($users as $user) {
                    if ($user[0] == $_SESSION["id"]) {
                        continue;
                    }
                    if ($user[1] === $_POST["nick"]) {
                        $dupe = true;
                        $error = "El nick ya esta en uso";
                        break;
                    }
                    if ($user[2] === $_POST["email"]) {
                        $dupe = true;
                        $error = "El email ya esta en uso";
                        break;
                    }
                }
                //Si no duplicado se cambia en bbdd y session
                if (!$dupe) {
                    //se modifica el usuario en la base de datos
                    model::modifyUser($_SESSION["id"], $_POST["nick"], $_SESSION["role"], $_POST["email"], $_POST["firstName"], $_POST["lastName"]);
                    $_SESSION["nick"] = $_POST["nick"];
                    $_SESSION["email"] = $_POST["email"];

                    //mensaje de notificacion
                    $this->sendNotification("Usuario Actualizado", "Se han actualizado los datos del usuario exitosamente!");
                    header('Location: ?page=ajustes');
                    die();
                } else {
                    $this->sendNotification("Error en el cambio", $error);
                }
                break;
            //Borrar metodo de pago
            case "remove-payment":
                //Se pasa al modelo la tarjeta y el usuario para borrar el mismo
                model::removeTarjeta($_SESSION["id"], substr($_POST["card"], 0, 4), substr($_POST["card"], 4));
                $this->sendNotification("Metodos de Pago", "Se ha eliminado el metodo de pago exitosamente!");
                header('Location: ?page=ajustes');
                die();
            //Añadir metodo de pago
            case "payment-submit":
                //Se pasan los datos de la tarjeta al modelo para añadir y se notifica al usuario
                $this->sendNotification("Metodos de Pago", "Se ha añadido el metodo de pago exitosamente!");
                $dateTime = DateTime::createFromFormat('d/m/y', '01/' . $_POST["exp"]);
                model::addTarjeta($_SESSION["id"], $_POST["num"], $dateTime->format("Y-m-d"), $_POST["cvv"]);
                header('Location: ?page=ajustes');
                die();
        }
        //se incluye la vista de principal
        Vista::mostrarAjustes(model::getUserData($_SESSION["id"]), model::getTarjetas($_SESSION["id"]));
    }

    //PRINCIPAL
    public function iniciaPrincipal()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateSession();

        //se incluyen los juegos que posee el usuario
        $minYear = $_GET['minYear'] ?? '';
        $maxYear = $_GET['maxYear'] ?? '';
        $genres = $_GET['gen'] ?? '';
        $dev = $_GET['dev'] ?? '';
        $dis = $_GET['dis'] ?? '';
        $sist = $_GET['sist'] ?? '';

        $games = ($_SESSION['role'] == 'admin') ? Model::getAllGames($minYear, $maxYear, $genres, $dev, $dis, $sist) : Model::getGames($_SESSION['id'], $minYear, $maxYear, $genres, $dev, $dis, $sist);
        $gamesPrestados = model::getJuegosPrestados($_SESSION["id"]);
        $gamesRecibidos = model::getJuegosRecibidos($_SESSION["id"]);
        $recibidosActivos = array();

        foreach ($gamesRecibidos as $recibido) {
            if (date("Y-m-d") < $recibido[1]) { //si el préstamo sigue activo
                $datosJuego = model::getGame($recibido[0]);

                //se guarda el id, el título, la ruta, la ruta de la portada, la fecha de fin de prestamo y id del usuario que ha prestado el juego
                $recibidosActivos[] = [$recibido[0], $datosJuego[0], $datosJuego[2], $datosJuego[1], $recibido[1], $recibido[2]];
            } else { //si ya ha caducado
                $this->sendNotification("Juego Caducado", "Ha caducado el juego con el id " + $datosJuego[0]);
                model::removePrestamo($_SESSION["id"], $recibido[0]); //se borra el préstamo de la base de datos
            }


            if (isset($_POST["devolver$recibido[0]"])) {
                model::cancelarPrestamo($_POST["idUs1$recibido[0]"], $recibido[0]);
                $juego = model::getGame($recibido[0]);

                $this->sendNotification("Préstamo Devuelto", "Se ha devuelto el juego " . $juego[0]);

                header("Location: ?page=principal");
                die();
            }
        }

        $i = 0;
        //Se guarda true si al usuario le pertenece el juego
        foreach ($games as $game) {
            foreach ($gamesPrestados as $gamePrestado) {
                if ($game[0] == $gamePrestado[0] && $gamePrestado[1] > date("Y-m-d")) {
                    $games[$i][] = $gamePrestado[1];
                }

            }
            $i++;
            if (isset($_POST["prestarNickname$game[0]"])) {
                echo $_POST["prestarNickname$game[0]"];
                //verificar si existe el usuario o no
                $id = model::getID($_POST["prestarNickname$game[0]"]);
                if ($id != "") {
                    if ($id == $_SESSION["id"]) {
                        $this->sendNotification("Error", "No puedes prestarte un juego a ti mismo");
                    }
                    //comprobar si el otro usuario ya tiene el juego
                    else if (!empty(model::poseeJuego($id, $game[0]))) {
                        $this->sendNotification("Error", "El usuario ya tiene el juego. Regálale otro.");

                    } else {
                        //si no tiene el juego, ponerselo
                        model::prestarJuegoUsuario($_SESSION["id"], $id, $game[0], $_POST["finPrestamo$game[0]"]);
                        $this->sendNotification("Juego Prestado con éxito ", "Se ha prestado el juego correctamente.");

                    }

                } else {
                    $this->sendNotification("El usuario introducido no existe", "Comprueba que has escrito correctamente el nombre de usuario a quien quieres regalar el juego.");

                }
                header("Location: ?page=principal");
                die();
            }

            if (isset($_POST["cancelarPrestamo$game[0]"])) {

                model::cancelarPrestamo($_SESSION["id"], $game[0]);
                $this->sendNotification("Préstamo cancelado", "Se ha cancelado el préstamo de " . $game[1]);

                header("Location: ?page=principal");
                die();
            }

        }
        //se incluye la vista de principal
        Vista::mostrarPrincipal($games, $recibidosActivos);
    }

    //REGISTRO
    public function iniciaRegistro()
    {
        $added = false;
        $error = '';
        //se comprueba que se hayan rellenado todos los campos
        $allPosts = (isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["passwd"]));

        //Sacan todos los usuarios para ver si esta duplicado
        $users = model::getAllUsers();
        $dupe = false;
        $passwdBien = true;

        if ($allPosts) {
            foreach ($users as $user) {
                if ($user[1] === $_POST["nick"]) {
                    $dupe = true;
                    $error = "El nick ya esta en uso";
                    break;
                }
                if ($user[2] === $_POST["email"]) {
                    $dupe = true;
                    $error = "El email ya esta en uso";
                    break;
                }
            }
        }

        if ($allPosts && !$dupe) {
            //se comprueba que las contraseñas sean iguales
            if ($this->comprobarPasswd()) {
                Model::anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["passwd"]);
                //se crea la nueva cuenta y te devuelve al login para que inicies sesion
                header("Location: ?page=login");
                $_SESSION["nuevaCuenta"] = true;
            } else {
                $passwdBien = false;
            }

        }

        //se incluye la vista de registro
        Vista::mostrarRegistro($allPosts, !$dupe, $passwdBien);
    }

    public function inicia404()
    {
        Vista::mostrar404();
    }

    //comprobar contraseñas iguales del registro
    static function comprobarPasswd()
    {
        if (isset($_POST["passwd"]) && isset($_POST["passwd2"])) {
            if ($_POST["passwd"] == $_POST["passwd2"]) {
                return true;
            }
        }
        return false;
    }


    //funcion para verificar usuario
    public function verificaUsuario($id)
    {
        //If someone with that nick/email
        if (!empty($id)) {

            $passReal = model::consultaPasswd($id);

            //Verificamos la contraseña
            if (password_verify($_POST["passwd"], $passReal)) {
                //Sacamos datos para la session del modelo
                $array = model::abrirSesion($id);

                //Guardar datos del usuario en la sesion
                foreach ($array as $row) {
                    $_SESSION["nick"] = $row["nick"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["role"] = $row["role"];
                }
                return true;
            } else {
                return false;
            }
        }
    }

    //Funcion para mandar notificaciones
    public function sendNotification($title, $body, $time = 5000)
    {
        if (!isset($_SESSION["notifications"])) { //si no existe notificaciones en el session se crea
            $_SESSION["notifications"] = array();
        }

        $_SESSION["notifications"][] = array($title, $body, $time); //se guarda un array con las notificaciones que vista muestra luego

    }

}

$controlador = new Controlador();
$controlador->inicia();