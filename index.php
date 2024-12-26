<?php

use Random\RandomException;

session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once "vista.php";
include_once "model.php";

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
            default:
                $this->inicia404();
        }

    }

    public function validateSession()
    {
        //si hay una sesion creada y se hace logout se destruye la sesión y se envia al landing
        if (isset($_SESSION["nick"])) {
            if (isset($_POST["logout"])) {
                //SERIALIZAR EL CARRITO
                //GAUARDAR EL CARRITO EN LA BASE DE DATOS
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
                    //SERIALIZAR EL CARRITO
                    //GAUARDAR EL CARRITO EN LA BASE DE DATOS
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

                model::modifyUser($_POST["id"], $_POST["nick"], $_POST["role"], $_POST["email"], $_POST["firstName"], $_POST["lastName"]);
                header('Location: ?page=adm-usuarios');
                die();

            }

            if ($_POST["action"] == "user-delete") {

                if ($_POST["id"] === $_SESSION["id"]) {
                    $_SESSION["notification"] = "No puedes borrarte a ti mismo.";
                } else {
                    model::deleteUser($_POST["id"]);
                }
                header('Location: ?page=adm-usuarios');
                die();

            }

            if ($_POST["action"] == "user-passwd-apply") {

                if ($_POST["passwd"] === $_POST["passwd2"]) {
                    model::changePasswd($_POST["id"], $_POST["passwd"]);
                }
                header('Location: ?page=adm-usuarios');
                die();

            }

            if ($_POST["action"] == "user-add") {

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

                try {
                    $characters = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&');
                    $random = '';
                    for ($i = 0; $i < 16; $i++) {
                        $random .= $characters[rand(0, sizeof($characters) - 1)];
                    }

                    $added = Model::anadirUsuario($_POST["email"], $_POST["nick"], $_POST["firstName"], $_POST["lastName"], $random, $_POST["role"]);

                    if ($added) {
                        $this->sendNotification('Usuario Creado',"Usuario registrado correctamente. Contraseña aleatoria: " . htmlentities($random), 20000);
                    } else {
                        $this->sendNotification('Error Usuario',"Ha ocurrido un error al registrar el usuario. Reporta al administrador del sistema");
                    }
                } catch (RandomException $e) {
                    $this->sendNotification('',"Error al generar una contraseña aletoria. Reporta al administrador del sistema");
                } finally {

                    if (!$dupe) {
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
            Vista::mostrarAdminUsuarios($error, $users, $user);
        } else {
            //se incluye la vista de principal
            Vista::mostrarAdminUsuarios($error, $users);
        }

    }

    public function thumbnailFilesUpload()
    {
        $mime = $_FILES["portada"]["type"];
        $extension = explode("/", $mime); //coge la extensión (por si no es siempre la misma no se)

        $ruta = "img/game-thumbnail/" . $_POST["titulo"] . "." . $extension[1]; //ESE TITULO HAY QUE CAMBIARLO POR EL ID DEL JUEGO EN LA API
        $resultado = move_uploaded_file($_FILES["portada"]["tmp_name"], $ruta); //mueve el archivo al directorio
        if ($resultado) { //si ha salido bien que devuelva la ruta
            return $ruta;
        } else {
            return 0; //si no se ha subido que devuelva 0
        }

    }

    public function iniciaAdminJuegos()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        if (isset($_POST["addGame"])) {
            if (isset($_POST["titulo"]) && isset($_POST["descripcion"]) && isset($_POST["dis"]) && isset($_POST["dev"]) && isset($_POST["year"])) { //verifica que se han rellenado los campos

                $ruta = $this->thumbnailFilesUpload();
                if ($ruta != 0) { //si se ha subido la imagen mete los datos en la bbdd
                    model::addGame($_POST["titulo"], 'rutaJuego', $ruta, $_POST["dev"], $_POST["dis"], $_POST["year"]);
                } else {
                    print ("Failed to upload thumbnail."); //AÑADIR MENSAJE DE ERROR???????
                }
                header('Location: ?page=adm-juegos'); //Redirige a la misma pagina
            } else {
                print "error"; //OTRO MENSAJE DE ERROR?
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

        //se incluye la vista de principal
        Vista::mostrarAdminGeneros();
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
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateSession();
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

    public function sendNotification($title, $body, $time=5000) {
        if (!isset($_SESSION["notifications"])) {
            $_SESSION["notifications"] = array();
        }

        $_SESSION["notifications"][] = array($title,$body,$time);

    }

}

$controlador = new Controlador();
$controlador->inicia();