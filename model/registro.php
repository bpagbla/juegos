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
            $ddbb->prepare();
            $ddbb->bindParam(':id',$id);
            $datos = $ddbb->execute();
            $ddbb->cerrar();
            foreach ($datos as $row) {
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

    return false;

}