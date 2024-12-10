<?php
function verificarUsuario($id, $password)
{

    include_once "../BD/baseDeDatos.php";

    $ddbb = new BaseDeDatos;
    $ddbb->conectar();

    $consulta = $ddbb->consulta("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES($email,$nick,$nombre,$apel,$pass,'user'");


}