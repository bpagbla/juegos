<?php
    $isadmin = false;
    if ($page === "adm-usuarios" || $page === "adm-juegos" || $page === "adm-generos" || $page === "adm-sistemas" || $page === "adm-dev" || $page === "adm-distribuidores") {$isadmin = true;}
?>
<li class="dropdown nav-item">
    <button class="nav-link dropdown-toggle text-white ps-2 <?php echo ($isadmin) ? "show" : "" ?>" role="button" data-bs-toggle="dropdown" aria-expanded="<?php echo ($isadmin) ? "true" : "false" ?>">
        <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#tools" />
        </svg>
        Administrar
    </button>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow bg-menu rounded-3 <?php echo ($isadmin) ? "show" : "" ?>">
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white rounded-top-3 ps-2 <?php if ($page === "adm-usuarios")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-usuarios" <?php if ($page === "adm-usuarios")
                    echo 'aria-current="page"' ?>>
                    Usuarios
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white ps-2 <?php if ($page === "adm-juegos")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-juegos" <?php if ($page === "adm-juegos")
                    echo 'aria-current="page"' ?>>
                    Juegos
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white ps-2 <?php if ($page === "adm-generos")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-generos" <?php if ($page === "adm-generos")
                    echo 'aria-current="page"' ?>>
                    Generos
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white rounded-bottom-3 ps-2 <?php if ($page === "adm-sistemas")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-sistemas" <?php if ($page === "adm-sistemas")
                    echo 'aria-current="page"' ?>>
                    Sistemas
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white rounded-bottom-3 ps-2 <?php if ($page === "adm-dev")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-dev" <?php if ($page === "adm-dev")
                    echo 'aria-current="page"' ?>>
                    Desarrolladores
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white rounded-bottom-3 ps-2 <?php if ($page === "adm-distribuidores")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-distribuidores" <?php if ($page === "adm-distribuidores")
                    echo 'aria-current="page"' ?>>
                    Distribuidores
                </button>
            </form>
        </li>
    </ul>
</li>