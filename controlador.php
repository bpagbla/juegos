<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//require_once "modelo.php";
require_once "vista.php";

class Controlador
{
    public function __construct()
    {

    }

    public function inicia()
    {
        Vista::MuestraLogin();
    }

    public function iniciaSesion()
    {
        Vista::MuestraPrincipal();
    }

    public function verificarUsuario($id, $password)
    {

        include "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();

        $consulta = $ddbb->consulta("SELECT * FROM `usuario` WHERE EMAIL='$id' || NICK='$id'");
        if (!empty($consulta)) {
            $consPass = $ddbb->consulta("SELECT password FROM `usuario` WHERE EMAIL='$id' || NICK='$id'");
            $passReal = "";
            foreach ($consPass as $row) {
                $passReal = $row["password"];
            }

            if (password_verify($password, $passReal)) {
                echo 'Password is valid!';
                return true;
            } else {
                echo 'Usuario o contraseña incorrecta.';
                return false;
            }

        }

    }

}

$programa = new Controlador();

$programa->inicia();

if (isset($_POST["id"]) && isset($_POST["passwd"])) {
    $programa->verificarUsuario($_POST["id"], $_POST["passwd"]);
}



