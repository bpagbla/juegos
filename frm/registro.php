<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/registro.css">
</head>

<body>

    <form class="row g-3">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4" name="email" required>
        </div>
        <div class="col-md-6"> </div>
        <div class="col-md-4">
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="inputNombre" name="password" required>
        </div>
        <div class="col-md-8">
            <label for="inputApellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="inputNombre" name="password" required>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Calle/Avenida/Plaza" required name="direccion"
                required>
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="inputCity" required>
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Provincia</label>
            <select id="inputState" class="form-select">
                <option selected>Elige...</option>
                <option>Madrid</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputZip" class="form-label">CP</label>
            <input type="text" class="form-control" id="inputZip" required>
        </div>
        <hr class="mt-4">
        <div class="col-md-6">
            <label for="inputUsuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="inputUsuario" required>
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="password" required>
        </div>

        <button id="liveToastBtn" class="btn  w-100 py-2 estiloBoton mt-4" type="submit">Iniciar Sesión</button>
        <p class="mt-2 mb-3">¿Ya tienes cuenta? <a class="text-decoration-none link" href="Login.php">
                Inicia sesión.
            </a></p>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>