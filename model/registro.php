<?php
function anadirUsuario($email, $nick, $nombre, $apel, $pass)
{

    include_once "../BD/baseDeDatos.php";

    $ddbb = new BaseDeDatos;
    $ddbb->conectar();
    $datos = $ddbb->consulta("SELECT NICK,EMAIL FROM `usuario` WHERE EMAIL='$email' || NICK='$nick'");
    $existe = false;
    foreach ($datos as $row) {
        if(isset($row["NICK"]) || isset($row["EMAIL"])){
            $existe = true;
        }
    }
    if (!$existe) {

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $consulta = $ddbb->insert("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES(?,?,?,?,?,?)",[$email,$nick,$nombre,$apel,$pass,'user']);
        return true;
    } else {
        return false;
    }
}