<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>



    <link rel="stylesheet" href="../css/landing.css">
</head>

<body>
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


    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark header">
        <div class="container-fluid">
            <a class="navbar-brand nombre" href="">
                <svg class="iconoLogo" viewBox="0 0 79 80" 
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.7071 24.2629V16.2629H40.7071V24.2629H16.7071ZM16.7071 56.2629V48.2629H8.7071V24.2629H16.7071V48.2629H32.7071V40.2629H24.7071V32.2629H40.7071V56.2629H16.7071Z"
                        fill="black" />
                    <path d="M41 72.3H33V32.3H57V40.3H41V48.3H57V56.3H41V72.3ZM57 48.3V40.3H65V48.3H57Z" fill="black" />
                    <rect x="8.7071" y="56.2629" width="8.0912" height="7.97125" fill="black" />
                    <rect x="48.9781" y="16.3" width="8.0912" height="7.97125" fill="black" />
                    <rect x="0.615906" y="48.2917" width="8.0912" height="7.97125" fill="black" />
                </svg>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">

                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>

                </ul>
                <a class="d-flex text-decoration-none" href="login.php">
                    <input class="btnLogin" type="button" value="Login">
                </a>
            </div>
        </div>
    </nav>

    <main>

        <div class="contenido">
            <!-- BANNER -->
            <div class="banner">
                <div class="bg-group">
                    <div class="bg"></div>
                    <div class="bg"></div>
                    <div class="bg">
                        <div class="title">
                            <svg viewBox="0 0 662 87" fill="none" xmlns="http://www.w3.org/2000/svg" class="svgLogo">
                                <path class="glitchedPixel"
                                    d="M14.375 29.5V15.125H57.5V29.5H14.375ZM14.375 87V72.625H0V29.5H14.375V72.625H43.125V58.25H28.75V43.875H57.5V87H14.375ZM86.25 87H71.875V15.125H86.25V87ZM100.625 15.125V0.75H115V15.125H100.625ZM115 87H100.625V29.5H115V87ZM143.75 72.625H129.375V15.125H143.75V29.5H158.125V43.875H143.75V72.625ZM143.75 87V72.625H158.125V87H143.75ZM186.875 43.875V29.5H215.625V43.875H186.875ZM186.875 72.625H172.5V43.875H186.875V72.625ZM186.875 87V72.625H215.625V87H186.875ZM244.375 87H230V15.125H244.375V29.5H258.75V43.875H244.375V87ZM273.125 87H258.75V43.875H273.125V87ZM301.875 72.625H287.5V43.875H301.875V29.5H316.25V43.875H330.625V58.25H301.875V72.625ZM301.875 87V72.625H330.625V87H301.875ZM359.375 87V72.625H345V43.875H359.375V72.625H373.75V43.875H359.375V29.5H373.75V15.125H388.125V87H359.375ZM445.625 87H431.25V15.125H474.375V29.5H445.625V43.875H474.375V58.25H445.625V87ZM474.375 43.875V29.5H488.75V43.875H474.375ZM503.125 15.125V0.75H517.5V15.125H503.125ZM517.5 87H503.125V29.5H517.5V87ZM531.875 43.875V29.5H546.25V43.875H531.875ZM560.625 43.875V29.5H575V43.875H560.625ZM560.625 72.625H546.25V43.875H560.625V72.625ZM546.25 72.625V87H531.875V72.625H546.25ZM560.625 87V72.625H575V87H560.625ZM603.75 72.625H589.375V43.875H603.75V29.5H618.125V43.875H632.5V58.25H603.75V72.625ZM603.75 87V72.625H632.5V87H603.75ZM661.25 87H646.875V15.125H661.25V87Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                    <div class="bg"></div>
                    <div class="bg"></div>
                </div>
            </div>
            <!-- BANNER -->

            <div class="tab tab1">
                <div class="content">
                    <h5>El mundo de los Juegos Retro</h5>
                    <h2 class="nombre">Glitched Pixel</h2>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate labore ea omnis
                        ratione fugit recusandae expedita distinctio, atque laudantium eius reprehenderit maxime modi
                        veritatis dolores error saepe inventore dicta neque.</div>
                </div>
            </div>
            <div class="tab tab2">
                <div class="content">
                    <h5>Crea tu Cuenta y Empieza a Jugar</h5>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate labore ea omnis
                        ratione fugit recusandae expedita distinctio, atque laudantium eius reprehenderit maxime modi
                        veritatis dolores error saepe inventore dicta neque.</div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../js/landing.js"></script>
</body>

</html>