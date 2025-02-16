<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <script src="../js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Glitched Pixel | Inicia Sesión</title>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/general.css">
    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>
    <div class="toast-container position-fixed top-0 start-0 p-3">
        <div id="toastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Login Error</strong>
                <small>Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                El usuario o la contraseña no son correctos
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 start-0 p-3">
        <div id="ToastNuevaCuenta" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Éxito al crear la cuenta</strong>
                <small>Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Usuario creado. Inicia sesión.
            </div>
        </div>
    </div>
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <title>Icono de la Luna</title>
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <title>Icono de Sol</title>
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <title>Tick</title>
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <title>Icono de Luna</title>
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <title>Tick</title>
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <title>Icono de Luna</title>
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <title>Tick</title>
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>

    <main class="form-signin w-100 m-auto">
        <form action="#" method="post" class="text-center">
            <svg class="iconoLogo logoTheme" viewBox="0 0 79 80" height="57" data-bs-theme-value-svg="dark"
                 xmlns="http://www.w3.org/2000/svg">
                <title>Logo de la compañía</title>
                <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="white" />
                <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="white" />
                <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="white"/>
                <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="white" />
                <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="white" />
            </svg>
            <svg class="iconoLogo d-none logoTheme" viewBox="0 0 79 80" height="57" data-bs-theme-value-svg="light"
                 xmlns="http://www.w3.org/2000/svg">
                <title>Logo de la compañía</title>
                <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="black" />
                <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="black" />
                <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="black"/>
                <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="black" />
                <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="black" />
            </svg>
            <svg class="iconoLogo d-none logoTheme" viewBox="0 0 79 80" height="57" data-bs-theme-value-svg="auto"
                 xmlns="http://www.w3.org/2000/svg">
                <title>Logo de la compañía</title>
                <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="#bd33fd" />
                <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="#bd33fd" />
                <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="#bd33fd"/>
                <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="#bd33fd" />
                <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="#bd33fd" />
            </svg>
            <h1 class="h3 mb-4 mt-2 fw-normal">Inicia Sesión</h1>

            <div class="form-floating">
                <input name="user" type="text" class="form-control" id="user" placeholder="name@example.com">
                <label for="user">Email o Nick</label>
            </div>
            <div class="form-floating">
                <input name="passwd" type="password" class="form-control" id="passwd" placeholder="Password">
                <label for="passwd">Contraseña</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2 estiloBoton" type="submit">Iniciar Sesión</button>
        </form>
        <div>
            <p class="mt-3 mb-0 text-body-secondary text-center">¿No tienes cuenta?</p>
            <form class="text-center" method="get">
                <button class="text-decoration-none link border-0 bg-transparent" name="page" value="registro"
                        href="/?page=registro">
                    Regístrate ahora.
                </button>
            </form>
        </div>
    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php
    //If attempted to login, show the toast for login error.
    if ($loginAttempt) {
    print "<script async src='../js/login.js'></script>";
    }

    //If succesfully registered. Show the toast of the correct registration.
    if (isset($_SESSION["nuevaCuenta"]) && $_SESSION["nuevaCuenta"]==true) {
    print "<script async src='../js/nuevaCuenta.js'></script>";
    $_SESSION["nuevaCuenta"]=false;
    }

    ?>
</body>
</html>