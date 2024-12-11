<?php
function anadirUsuario($email, $nick, $nombre, $apel, $pass)
{

    include_once "../BD/baseDeDatos.php";

    $ddbb = new BaseDeDatos;
    $ddbb->conectar(); //se conecta a la base de datos

    //se hace la consulta de usuario y nick para ver si están duplicados
    $datos = $ddbb->consulta("SELECT NICK,EMAIL FROM `usuario` WHERE EMAIL='$email' || NICK='$nick'");
    
    $existe = false;
    foreach ($datos as $row) {
        if(isset($row["NICK"]) || isset($row["EMAIL"])){
            $existe = true; //si están duplicados se cambia la variable a true
        }
    }

    if (!$existe) { //si la variable es false se crea el usuario

        $pass = password_hash($pass, PASSWORD_DEFAULT); //se convierte a hash la contraseña

        //se insertan los datos en la base de detos
        $consulta = $ddbb->insert("INSERT INTO usuario(EMAIL, NICK, NOMBRE, APELLIDOS, PASSWORD, ROLE) VALUES(?,?,?,?,?,?)", [$email,$nick,$nombre,$apel,$pass,'user']);
        return true; //devuelve true si se ha creado
    } else {
        return false; //devuelve false si no se ha creado
    }
}

function comprobarPasswd(){
    if(isset($_POST["passwd"]) && isset($_POST["passwd2"])){
        if($_POST["passwd"] == $_POST["passwd2"]){
            return true;
        }else{
            return false;
        }
    }
}