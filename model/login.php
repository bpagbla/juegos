<?php
function verificarUsuario($id, $password)
{

    include_once "../BD/baseDeDatos.php";

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
            $datos = $ddbb->consulta("SELECT nick,email,id FROM `usuario` WHERE EMAIL='$id' || NICK='$id'");
            $ddbb->cerrar();
            foreach ($datos as $row) {
                $_SESSION["nick"] = $row["nick"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["id"] = $row["id"];
            }
            return true;
        } else {
            echo 'Usuario o contraseña incorrecta.';
            return false;
        }

    }

    return false;

}