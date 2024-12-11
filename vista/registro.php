<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <script src="../js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Registro</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/general.css">
    <link href="../css/registro.css" rel="stylesheet">
    <meta name="theme-color" content="#712cf9">

</head>
<body class="bg-body-tertiary">
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
</svg>

<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
            id="bd-theme"
            type="button"
            aria-expanded="false"
            data-bs-toggle="dropdown"
            aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
            <use href="#circle-half"></use>
        </svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                <svg class="bi me-2 opacity-50" width="1em" height="1em">
                    <use href="#sun-fill"></use>
                </svg>
Light
                <svg class="bi ms-auto d-none" width="1em" height="1em">
                    <use href="#check2"></use>
                </svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                <svg class="bi me-2 opacity-50" width="1em" height="1em">
                    <use href="#moon-stars-fill"></use>
                </svg>
Dark
                <svg class="bi ms-auto d-none" width="1em" height="1em">
                    <use href="#check2"></use>
                </svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                <svg class="bi me-2 opacity-50" width="1em" height="1em">
                    <use href="#circle-half"></use>
                </svg>
Auto
                <svg class="bi ms-auto d-none" width="1em" height="1em">
                    <use href="#check2"></use>
                </svg>
            </button>
        </li>
    </ul>
</div>
<div class="toast-container position-fixed top-0 start-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Error de Registro</strong>
            <small>Ahora</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
El Email o Nick ya estan en uso.
        </div>
    </div>
</div>

<div class="container">
    <main>
        <div class="pb-3 pt-4 text-center">
            <svg class="d-block mx-auto mb-2 logoTheme" viewBox="0 0 79 80" height="57" data-bs-theme-value-svg="dark"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="white"/>
                <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="white"/>
                <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="white"/>
                <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="white"/>
                <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="white"/>
            </svg>
            <svg class="d-block mx-auto mb-2 logoTheme d-none" viewBox="0 0 79 80" height="57"
                 data-bs-theme-value-svg="light"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="black"/>
                <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="black"/>
                <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="black"/>
                <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="black"/>
                <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="black"/>
            </svg>
            <svg class="d-block mx-auto mb-2 logoTheme d-none" viewBox="0 0 79 80" height="57"
                 data-bs-theme-value-svg="auto"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="#ab51fa"/>
                <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="#ab51fa"/>
                <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="#ab51fa"/>
                <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="#ab51fa"/>
                <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="#ab51fa"/>
            </svg>
            <h2>Registro</h2>
        </div>

        <div class="row g-5 justify-content-center">
            <div class="col-md-7 col-lg-8">
                <form class="needs-validation" method="post" action="#" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label ms-1">Nombre</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php if(!empty($_POST["nombre"])) { print $_POST["nombre"]; } ?>" name="nombre"
                                   required>
                            <div class="invalid-feedback">
Se requiere de un nombre valido.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label ms-1">Apellidos</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php if(!empty($_POST["apellidos"])) { print $_POST["apellidos"]; } ?>"
                                   name="apellidos" required>
                            <div class="invalid-feedback">
Se requiere de al menos un apellido valido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="username" class="form-label ms-1">Nick</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" placeholder="Nick" name="nick" value="<?php if(!empty($_POST["nick"])) { print $_POST["nick"]; } ?>"
                                       required>
                                <div class="invalid-feedback">
Se requiere de un nick valido.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label ms-1">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="tu@ejemplo.com" value="<?php if(!empty($_POST["email"])) { print $_POST["email"]; } ?>"
                                   name="email" required>
                            <div class="invalid-feedback">
Se requiere de un correo valido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="passwd" class="form-label ms-1">Contraseña</label>
                            <input type="password" class="form-control" id="passwd" placeholder="*************" value="<?php if(!empty($_POST["passwd"])) { print $_POST["passwd"]; } ?>"
                                   name="passwd" required>
                            <div class="invalid-feedback">
Introduce una contraseña valida.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="passwd2" class="form-label ms-1">Repite Contraseña</label>
                            <input type="password" class="form-control" id="passwd2" placeholder="*************" value="<?php if(!empty($_POST["passwd2"])) { print $_POST["passwd2"]; } ?>"
                                   name="passwd2" required>
                            <div class="invalid-feedback">
Las dos contraseñas no son iguales.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="province" class="form-label ms-1" name="provincia">Provincia</label>
                            <select class="form-select" id="province" required>
                                <option value="">Elije...</option>
                                <option value="1">Madrid</option>
                                <option value="2">Barcelona</option>
                            </select>
                            <div class="invalid-feedback">
Selecciona una provincia valida.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="city" class="form-label ms-1">Ciudad</label>
                            <input type="text" class="form-control" id="city" placeholder="" name="ciudad" value="<?php if(!empty($_POST["ciudad"])) { print $_POST["ciudad"]; } ?>" required>
                            <div class="invalid-feedback">
Introduce una ciudad valida.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label ms-1">CP</label>
                            <input type="text" class="form-control" id="zip" placeholder="" name="cp" value="<?php if(!empty($_POST["cp"])) { print $_POST["cp"]; } ?>" required>
                            <div class="invalid-feedback">
Se requiere de CP valido.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="save-info" name="tyc" <?php if(!empty($_POST["tyc"])) { print "checked"; } ?> required>
                                <label class="form-check-label" for="save-info">Acepto los Terminos y
                                    Condiciones</label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg estiloBoton border-0" type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="mb-4 pt-3 text-body-secondary text-center text-small">
        <p class="mb-1">¿Ya tienes cuenta? <a href="login.php">Login</a></p>
    </footer>
</div>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/registro.js"></script>

<?php
//If the user tried to register but this failed, include the js to show the error toast
if ($allPosts && !$added) {
    print "<script src='../js/errorRegistro.js'></script>";
}
?>
</body>
</html>
