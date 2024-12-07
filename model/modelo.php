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
                $nick=  $ddbb->consulta("SELECT nick FROM `usuario` WHERE EMAIL='$id' || NICK='$id'");
                foreach ($nick as $row) {
                    $_SESSION["nick"] = $row["nick"];
                }
                return true;
            } else {
                echo 'Usuario o contraseña incorrecta.';
                return false;
            }

        }

        return false;

    }

?>