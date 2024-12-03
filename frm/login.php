<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

<?php
include "BD/baseDedatos.php";
$ddbb = new BaseDeDatos;
$ddbb->conectar();
$ddbb->consulta("SELECT * FROM usuario");
?>

    <h1>Inicia Sesión</h1>
    <form action="" method="POST">

        Nick o Correo: <input type="text" name="nick">
        Password: <input type="password" name="password">

    </form>
</body>

</html>