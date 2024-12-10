<?php
function verificarUsuario($loginID, $password)
{
    //Include the ddbb class
    include_once "../BD/baseDeDatos.php";

    //Open the database connection
    $ddbb = new BaseDeDatos;
    $ddbb->conectar();

    //Check if there is any user with that email
    $consulta = $ddbb->consulta("SELECT ID FROM `usuario` WHERE EMAIL='$loginID' || NICK='$loginID'");
    $id = "";
    foreach ($consulta as $item) {
        $id = $item["ID"];
    }

    //If someone with that nick/email
    if (!empty($id)) {
        $consPass = $ddbb->consulta("SELECT password FROM `usuario` WHERE EMAIL='$loginID' || NICK='$loginID'");
        $passReal = "";
        foreach ($consPass as $row) {
            $passReal = $row["password"];
        }

        //Verificamos la contraseña
        if (password_verify($password, $passReal)) {
            //Saco los datos del user
            $datos = $ddbb->consulta("SELECT nick,email,id,role FROM `usuario` WHERE ID='$id'");
            $ddbb->cerrar();

            //Saco los datos del usuario
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