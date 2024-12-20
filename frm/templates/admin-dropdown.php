<?php
    $isadmin = false;
    if ($page === "adm-usuarios" || $page === "adm-juegos" || $page === "adm-generos" || $page === "adm-sistemas") {}
?>
<li class="dropdown nav-item">
    <a class="nav-link dropdown-toggle text-white ps-2 <?php echo ($isadmin) ? "show" : "" ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="<?php echo ($isadmin) ? "true" : "false" ?>">
        <svg class="bi me-2" width="16" height="16">
            <use xlink:href="#tools" />
        </svg>
        Administrar
    </a>
    <ul class="dropdown-menu <?php echo ($isadmin) ? "show" : "" ?>">
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white <?php if ($page === "adm-usuarios")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-usuarios" <?php if ($page === "adm-usuarios")
                    echo 'aria-current="page"' ?>>
                    Usuarios
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white <?php if ($page === "adm-juegos")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-juegos" <?php if ($page === "adm-juegos")
                    echo 'aria-current="page"' ?>>
                    Juegos
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white <?php if ($page === "adm-generos")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-generos" <?php if ($page === "adm-generos")
                    echo 'aria-current="page"' ?>>
                    Generos
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form method="get">
                <button class="nav-link dropdown-item text-white <?php if ($page === "adm-sistemas")
                    echo 'active' ?>"
                        type="submit" name="page" value="adm-sistemas" <?php if ($page === "adm-sistemas")
                    echo 'aria-current="page"' ?>>
                    Sistemas
                </button>
            </form>
        </li>
    </ul>
</li>