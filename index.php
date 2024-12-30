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

        if (!isset($_GET["page"])) {
            Vista::mostrarLanding();
            die();
        }

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
            default:
                $this->inicia404();
        }

    }

    public function fetchAPI()
    {
        $this->validateSession();
        if (!isset($_GET["endpoint"])) {
            $this->inicia404();
            die();
        }
        switch ($_GET["endpoint"]) {
            case "games":
                //http://localhost/?page=api&endpoint=games&format=brief&title=
                $format = $_GET["format"] ?? "id";
                $json = '';
                if (isset($_GET["id"])) {
                    if (isset($_GET["platform"])) {
                        $json = model::getMobyGamebyID($format, $_GET["id"], $_GET["platform"]);
                    } else {
                        $json = model::getMobyGamebyID($format, $_GET["id"]);
                    }
                } else {
                    $title = $_GET["title"] ?? "";
                    $json = model::getMobyGamebyName($format, $title);
                }
                Vista::showAPIGames($json);
                break;
            case "companies":
                $array = model::getComp();
                $filter = $_GET["name"] ?? ".+";
                $filter = '/' . $filter . '/i';
                $json["companies"] = array();
                $quant = 0;
                foreach ($array as $value) {
                    if (preg_match($filter, $value[1])) {
                        $json["companies"][] = array('company_id' => $value[0], 'name' => $value[1]);
                    }
                    $quant++;
                    if ($quant >= 5) {
                        break;
                    }
                }
                Vista::showAPIGames(json_encode($json));
                break;
            case "genres":
                $array = model::getGeneros();
                $filter = $_GET["name"] ?? ".+";
                $filter = '/' . $filter . '/i';
                $json["genres"] = array();
                $quant = 0;
                foreach ($array as $value) {
                    if (preg_match($filter, $value[1])) {
                        $json["genres"][] = array('genre_id' => $value[0], 'name' => $value[1]);
                    }
                    $quant++;
                    if ($quant >= 5) {
                        break;
                    }
                }
                Vista::showAPIGames(json_encode($json));
                break;
            case "platforms":
                $array = model::getSist();
                $filter = $_GET["name"] ?? ".+";
                $filter = '/' . $filter . '/i';
                $json["platforms"] = array();
                $quant = 0;
                foreach ($array as $value) {
                    if (preg_match($filter, $value[1])) {
                        $json["platforms"][] = array('platform_id' => $value[0], 'name' => $value[1]);
                    }
                    $quant++;
                    if ($quant >= 5) {
                        break;
                    }
                }
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

        $error = "";
        $notification = "";
        if (isset($_POST["action"])) {

            if ($_POST["action"] == "user-apply") {

                $users = model::getAllUsers();
                $dupe = false;
                foreach ($users as $user) {
                    if ($user[1] == $_SESSION["nick"]) {
                        continue;
                    }
                    if ($user[1] === $_POST["nick"]) {
                        $dupe = true;
                        $error = "El nick ya esta en uso";
                        break;
                    }
                    if ($user[2] == $_SESSION["email"]) {
                        continue;
                    }
                    if ($user[2] === $_POST["email"]) {
                        $dupe = true;
                        $error = "El email ya esta en uso";
                        break;
                    }
                }

                if (!$dupe) {
                    //se modifica el usuario en la base de datos
                    model::modifyUser($_POST["id"], $_POST["nick"], $_POST["role"], $_POST["email"], $_POST["firstName"], $_POST["lastName"]);
                    $_SESSION["nick"] = $_POST["nick"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["role"] = $_POST["role"];

                    //mensaje de notificacion
                    $this->sendNotification("Usuario Actualizado", "Se han actualizado los datos del usuario exitosamente!");
                    header('Location: ?page=adm-usuarios');
                    die();
                } else {
                    $this->sendNotification("Error en el cambio", $error);
                }

            }

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

            if ($_POST["action"] == "user-passwd-apply") {

                if ($_POST["passwd"] === $_POST["passwd2"]) {
                    model::changePasswd($_POST["id"], $_POST["passwd"]);
                    $this->sendNotification("Contraseña cambiada", "La contraseña se ha cambiado correctamente!");
                } else {
                    $this->sendNotification("Error Usuario", "Ha habido un error cambiando la contraseña. Contacta con el administrador del sistema.");
                }
                header('Location: ?page=adm-usuarios');
                die();

            }

            if (isset($_POST["subaction"]) && $_POST["subaction"] == "remove-payment") {
                model::removeTarjeta($_POST["id"], substr($_POST["card"], 0, 4), substr($_POST["card"], 4));
            }

            if (isset($_POST["subaction"]) && $_POST["subaction"] == "add-payment") {

                $dateTime = DateTime::createFromFormat('d/m/y', '01/' . $_POST["exp"]);
                model::addTarjeta($_POST["id"], $_POST["num"], $dateTime->format("Y-m-d"), $_POST["cvv"]);

            }


            if ($_POST["action"] == "user-add") {

                $users = model::getAllUsers();
                $dupe = false;
                foreach ($users as $user) {
                    if ($user[1] == $_SESSION["nick"]) {
                        continue;
                    }
                    if ($user[1] === $_POST["nick"]) {
                        $dupe = true;
                        $error = "El nick ya esta en uso";
                        break;
                    }
                    if ($user[2] == $_SESSION["email"]) {
                        continue;
                    }
                    if ($user[2] === $_POST["email"]) {
                        $dupe = true;
                        $error = "El email ya esta en uso";
                        break;
                    }
                }

                if (!$dupe) {
                    try {
                        $characters = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&');
                        $random = '';
                        for ($i = 0; $i < 16; $i++) {
                            $random .= $characters[rand(0, sizeof($characters) - 1)];
                        }

                        $added = Model::anadirUsuario($_POST["email"], $_POST["nick"], $_POST["firstName"], $_POST["lastName"], $random, $_POST["role"]);

                        if ($added) {
                            $this->sendNotification('Usuario Creado', "Usuario registrado correctamente. Contraseña aleatoria: " . htmlentities($random), 20000);
                        } else {
                            $this->sendNotification('Error Usuario', "Ha ocurrido un error al registrar el usuario. Reporta al administrador del sistema");
                        }
                    } catch (RandomException $e) {
                        $this->sendNotification('', "Error al generar una contraseña aletoria. Reporta al administrador del sistema");
                    } finally {

                        header('Location: ?page=adm-usuarios');
                        die();

                    }
                }

            }

        }

        $users = model::getAllUsers();
        if (isset($_POST["action"]) && $_POST["action"] == "user-edit") {
            $user = model::getUserData($_POST["id"]);
            //se incluye la vista de principal con datos de usuario pedido
            Vista::mostrarAdminUsuarios($error, $users, $user, model::getTarjetas($_POST["id"]));
        } else {
            //se incluye la vista de principal
            Vista::mostrarAdminUsuarios($error, $users);
        }

    }

    public function thumbnailFilesUpload()
    {
        $mime = $_FILES["portada"]["type"];
        $extension = explode("/", $mime); //coge la extensión (por si no es siempre la misma no se)

        $ruta = "img/game-thumbnail/" . $_POST["id"] . "." . $extension[1]; //ESE TITULO HAY QUE CAMBIARLO POR EL ID DEL JUEGO EN LA API
        $resultado = move_uploaded_file($_FILES["portada"]["tmp_name"], $ruta); //mueve el archivo al directorio
        if ($resultado) { //si ha salido bien que devuelva la ruta
            return $ruta;
        } else {
            return 0; //si no se ha subido que devuelva 0
        }

    }

    function download_image1($image_url, $image_file)
    {
        $fp = fopen($image_file, 'w+');// open file handle

        $ch = curl_init($image_url);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
        curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
        curl_exec($ch);

        curl_close($ch);                              // closing curl handle
        fclose($fp);                                  // closing file handle
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

    public function iniciaAdminJuegos()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        if (isset($_POST["addGame"])) {
            $ruta = "";
            if (isset($_POST["fileSrc"])) {
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
                $ruta = $this->thumbnailFilesUpload();
            }

            $rutaJuego = "games/" . $_POST['id'] . ".jsdos";
            $resultado = move_uploaded_file($_FILES["archivoJuego"]["tmp_name"], $rutaJuego); //mueve el archivo al directorio
            if ($resultado) { //si ha salido bien que devuelva la ruta
                $this->sendNotification("copied file", "copied file");
            } else {
                $this->sendNotification("error file", "error file");
            }

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

        if (isset($_SESSION["editGame"])) {
            $this->sendNotification("Juego Editado", "Se ha editado el juego correctamente");
            $_SESSION["editGame"] = null;
        }

        if (isset($_SESSION["noeditGame"])) {
            $this->sendNotification("Error al editar Juego", "No se ha editado el juego");
            $_SESSION["noeditGame"] = null;
        }

        if (isset($_SESSION["notif"])) {
            $this->sendNotification("AAAAA", "AAAAAAAAAAAAAAAAAAAAAA");
        }

        if (isset($_POST["action"])) {

            if ($_POST["action"] == "game-edit") {
                $_SESSION["datosJuego"] = model::getGame($_POST["idJuego"]);
                $_SESSION["iddev"] = $_SESSION["datosJuego"][3];
                $_SESSION["iddis"] = $_SESSION["datosJuego"][4];

                $_SESSION["datosJuego"][3] = model::getCompNombre($_SESSION["datosJuego"][3]);
                $_SESSION["datosJuego"][4] = model::getCompNombre($_SESSION["datosJuego"][4]);

                $_SESSION["generosJuego"] = model::getGenJuego($_POST["idJuego"]);
                $_SESSION["sistemasJuego"] = model::getSistJuego($_POST["idJuego"]);

            }
            if ($_POST["action"] == "game-apply") {
                $rutaJuego = "games/" . $_POST['idEdit'] . ".jsdos";
                if (isset($_FILES["rutaEdit"])) {
                    $resultado = move_uploaded_file($_FILES["rutaEdit"]["tmp_name"], $rutaJuego); //mueve el archivo al directorio
                    if ($resultado) { //si ha salido bien que devuelva la ruta
                        $this->sendNotification("copied file", "copied file");
                    } else {
                        $this->sendNotification("error file", "error file");
                    }
                }

                if (model::modifyGame($_POST["idEdit"], $_POST["tituloEdit"], $rutaJuego, $_POST["fileSrcEdit"], $_POST["dev"], $_POST["dis"], $_POST["yearEdit"], $_POST["descripcionEdit"])) {

                    $_SESSION["editGame"] = true;

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
                    $_SESSION["noeditGame"] = true;
                }
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina   
            }

            if ($_POST["action"] == "game-delete") {

                model::deleteGame($_POST["idJuego"]);
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina   

            }
        }

        //se incluyen los juegos que posee el usuario
        $games = Model::getGames($_SESSION['id']);
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

        if (isset($_POST['action']) && $_POST['action'] == "genero-delete") {
            model::deleteGenero($_POST['id']);
            $this->sendNotification("Genero Borrado", "Borrado ".$_POST['nombre'].' exitosamente!');
            header('Location: ?page=adm-generos');
            die();
        }

        if (isset($_POST['action']) && $_POST['action'] == "genero-add") {
            model::addGen($_POST['id'], $_POST['name']);
            $this->sendNotification("Genero Añadido", "Añadido ".$_POST['nombre'].' exitosamente!');
            header('Location: ?page=adm-generos');
            die();
        }

        $generos = model::getGeneros();

        //se incluye la vista de principal
        Vista::mostrarAdminGeneros($generos);
    }

    public function iniciaAdminSistemas()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //se incluye la vista de principal
        Vista::mostrarAdminSistemas();
    }
    public function iniciaAdminEmpresa()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //se incluye la vista de principal
        Vista::mostrarAdminEmpresa();
    }

    public function iniciaJuegos()
    {
        $carrito = new Carrito();


        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateSession();

        //recuperar carrito de bbdd
        $carrito->setCarrito(model::getCarrito($_SESSION["id"]));


        if (isset($_SESSION["addJuegoCarrito"])) {
            $this->sendNotification('Juego añadido al carrito', "Se ha añadido el juego al carrito correctamente", 20000);
            $_SESSION["addJuegoCarrito"] = null;
        }
        if (isset($_SESSION["borrarJuegoCarrito"])) {
            $this->sendNotification('Juego eliminado del carrito', "Se ha eliminado el juego del carrito correctamente", 20000);
            $_SESSION["borrarJuegoCarrito"] = null;
        }

        //se incluyen los juegos que posee el usuario
        $games = Model::getAllGames();
        $gamesOwned = model::getGames($_SESSION["id"]);

        $i = 0;
        foreach ($games as $game) {
            foreach ($gamesOwned as $gameOwned) {
                if ($game[0] == $gameOwned[0]) {
                    $games[$i][] = true;
                }
            }
            $i++;

            if (isset($_POST["borrar$game[0]"])) {
                $carrito->sacarJuegoCarrito($game[0]);
                model::borrarJuegoCarrito($game[0]);
                $_SESSION["borrarJuegoCarrito"] = true;
                header("Location: ?page=juegos");
            }

            if (isset($_POST["juegoCompra$game[0]"])) { //si se ha dado a comprar en algun juego
                $carrito->meterJuegoCarrito($game[0], $game[1]);

                //actualizar bbdd
                model::addCarrito($_SESSION["id"], $game[0]);
                $_SESSION["addJuegoCarrito"] = true;
                header("Location: ?page=juegos");
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

        if (!isset($_POST["action"])) {
            Vista::mostrarAjustes(model::getUserData($_SESSION["id"]), model::getTarjetas($_SESSION["id"]));
            die();
        }

        switch ($_POST["action"]) {
            case "update-passwd":
                if (!empty($_POST["passwd1"]) && !empty($_POST["passwd2"]) && $_POST["passwd1"] === $_POST["passwd2"]) {
                    model::changePasswd($_SESSION["id"], $_POST["passwd1"]);
                    $this->sendNotification("Contraseña Cambiada", "Se ha cambiado la contraseña correctamente!");
                    header('Location: ?page=ajustes');
                    die();
                } else {
                    $this->sendNotification("Error Contraseña", "Rellena Correctamente los campos!");
                }
                break;
            case "update-personal":
                $users = model::getAllUsers();
                $dupe = false;
                foreach ($users as $user) {
                    if ($user[1] == $_SESSION["nick"]) {
                        continue;
                    }
                    if ($user[1] === $_POST["nick"]) {
                        $dupe = true;
                        $error = "El nick ya esta en uso";
                        break;
                    }
                    if ($user[2] == $_SESSION["email"]) {
                        continue;
                    }
                    if ($user[2] === $_POST["email"]) {
                        $dupe = true;
                        $error = "El email ya esta en uso";
                        break;
                    }
                }
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
            case "remove-payment":
                model::removeTarjeta($_SESSION["id"], substr($_POST["card"], 0, 4), substr($_POST["card"], 4));
                $this->sendNotification("Metodos de Pago", "Se ha eliminado el metodo de pago exitosamente!");
                header('Location: ?page=ajustes');
                die();
            case "payment-submit":
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
        $games = Model::getGames($_SESSION['id']);

        //se incluye la vista de principal
        Vista::mostrarPrincipal($games);
    }


    //REGISTRO
    public function iniciaRegistro()
    {
        $added = false;
        $error = '';
        //se comprueba que se hayan rellenado todos los campos
        $allPosts = (isset($_POST["email"]) && isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["passwd"]));
        $passwdBien = false;
        if ($allPosts) {
            //se comprueba que las contraseñas sean iguales
            if ($this->comprobarPasswd()) {
                $passwdBien = true;
                //se llama a la funcion anadirUsuario que devuelve true si se crea la nueva cuenta y false si no
                $added = Model::anadirUsuario($_POST["email"], $_POST["nick"], $_POST["nombre"], $_POST["apellidos"], $_POST["passwd"]);
            }

        }
        if ($added) {
            //si se crea la nueva cuenta te devuelve al login para que inicies sesion
            header("Location: ?page=login");
            $_SESSION["nuevaCuenta"] = true;
        }

        //se incluye la vista de registro
        Vista::mostrarRegistro($allPosts, $added, $passwdBien);
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
                model::abrirSesion($id);
                return true;
            } else {
                return false;
            }
        }
    }

    public function sendNotification($title, $body, $time = 5000)
    {
        if (!isset($_SESSION["notifications"])) { //si no existe notificaciones en el session se crea
            $_SESSION["notifications"] = array();
        }

        $_SESSION["notifications"][] = array($title, $body, $time); //se guarda un array con las notificaciones para ponerlas en el template

    }

}

$controlador = new Controlador();
$controlador->inicia();