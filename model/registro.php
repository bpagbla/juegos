<?php
function anadirUsuario($email,$nick,$nombre,$apel,$pass)
{

    include_once "../BD/baseDeDatos.php";

    $ddbb = new BaseDeDatos;
    $ddbb->conectar();

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $consulta = $ddbb->consulta("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES('$email','$nick','$nombre','$apel','$pass','user'");


}