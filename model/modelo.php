<?php
    function verificarUsuario($id, $password)
    {

        include "../BD/baseDeDatos.php";
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

        return false;

    }

?>