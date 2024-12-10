<?php
function anadirUsuario($email, $nick, $nombre, $apel, $pass)
{

    include_once "../BD/baseDeDatos.php";

    $ddbb = new BaseDeDatos;
    $ddbb->conectar();

    $consulta = $ddbb->consulta("SELECT * FROM `usuario` WHERE EMAIL='$email' || NICK='$nick'");
    if (!empty($consulta)) {

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $consulta = $ddbb->insert("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES(?,?,?,?,?,?)",[$email,$nick,$nombre,$apel,$pass,'user']);
        return true;
    } else {
        return false;
    }
}