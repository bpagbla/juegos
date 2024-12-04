<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css\login.css">
    <?php

    function verificarUsuario()
    {

        include "BD/baseDeDatos.php";
        $ddbb = new BaseDeDatos;
        $ddbb->conectar();
        //$id = $_POST["id"];
        //$password = $_POST["passwd"];

        //$consulta = $ddbb->consulta("SELECT * FROM `usuario` WHERE EMAIL='$id' || NICK='$id'");

    }

    if (!empty($_POST["id"]) && !empty($_POST["passwd"])) {
        verificarUsuario();
    }

    ?>
</head>
<body>
    <div class="container-lg">
        <div class="row justify-content-center align-content-center" style="height: 100vh;">
            <div class="" ></div>
            <div class="col-auto">
                <div class="p-4 rounded-5 shadow-lg">
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="user" class="form-label">Usuario</label>
                            <input name="user" type="text" class="form-control" id="user" placeholder="Paco">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="passwd" class="form-label">Contraseña</label>
                            <input name="passwd" type="text" class="form-control" id="passwd" placeholder="1234">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>