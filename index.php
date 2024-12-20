<?php
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
        }

    }

    public function validateSession() {
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

    public function validateAdminSession() {
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

        //se incluye la vista de principal
        Vista::mostrarAdminUsuarios();
    }

    public function iniciaAdminJuegos()
    {
        //Valida la sessión. Si erronea o logout envia a login.
        $this->validateAdminSession();

        //se incluyen los juegos que posee el usuario
        $games = Model::getGames($_SESSION['id']);

        //se incluye la vista de principal
        Vista::mostrarAdminJuegos($games);
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

    //LOGIN
    public function iniciaLogin()
    {
        $loginAttempt = false;
        //para verificar usuario se comprueba que se ha rellenado el formulario
        if (isset($_POST["user"]) && isset($_POST["passwd"])) {
            //se llama a la funcion existe usuario del model/login.php
            if ($this->verificaUsuario(Model::existeUsuario($_POST["user"], $_POST["passwd"]))) {
                
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
            header("Location: login.php");
            $_SESSION["nuevaCuenta"] = true;
        }

        //se incluye la vista de registro
        Vista::mostrarRegistro($allPosts, $added, $passwdBien);
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
    public function verificaUsuario($id){
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



}

$controlador = new Controlador();
$controlador->inicia();