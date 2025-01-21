<div class="row justify-left px-2">
    <div class="col">
        <h2 class="mt-3">Administrar Juegos</h2>
    </div>
</div>
<div class="row justify-content-around justify-content-lg-start">
    <?php
    //Se muestan por template los distintos juegos
    foreach ($games as $game) {
        include "frm/templates/card-game-adm.php";
    }
    ?>
</div>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="remove" viewBox="0 0 16 16">
        <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
    </symbol>
    <symbol viewBox="0 -960 960 960" id="import">

        <path
            d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z" />
    </symbol>
    <symbol viewBox="0 -960 960 960" id="game">
        <path
            d="M182-200q-51 0-79-35.5T82-322l42-300q9-60 53.5-99T282-760h396q60 0 104.5 39t53.5 99l42 300q7 51-21 86.5T778-200q-21 0-39-7.5T706-230l-90-90H344l-90 90q-15 15-33 22.5t-39 7.5Zm16-86 114-114h336l114 114q2 2 16 6 11 0 17.5-6.5T800-304l-44-308q-4-29-26-48.5T678-680H282q-30 0-52 19.5T204-612l-44 308q-2 11 4.5 17.5T182-280q2 0 16-6Zm482-154q17 0 28.5-11.5T720-480q0-17-11.5-28.5T680-520q-17 0-28.5 11.5T640-480q0 17 11.5 28.5T680-440Zm-80-120q17 0 28.5-11.5T640-600q0-17-11.5-28.5T600-640q-17 0-28.5 11.5T560-600q0 17 11.5 28.5T600-560ZM310-440h60v-70h70v-60h-70v-70h-60v70h-70v60h70v70Zm170-40Z" />

    </symbol>
</svg>
<?php
//Si se no hay ninguna accion anterior se muestra el modal de añadir al presionar boton añadir
if (!(isset($_POST["action"]) && $_POST["action"] == "game-edit")) {
    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        onsubmit="return checkFilled()">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir un Juego Nuevo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div id="add-errors" class="div">

                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative col-4 img-container d-flex align-items-center flex-column">
                                <!-- IMG PREVIEW -->
                                <img id="portada" src="img/black.jpg" alt="Previsualización de la portada">
                            </div>

                            <div class="col campos">
                                <div class="row">
                                    <div class="col-3 ps-0 pe-3">
                                        <label for="id" class="col-form-label">ID:</label>
                                        <input type="number" min="0" class="form-control" id="id" name="id" required>
                                    </div>
                                    <div class="col-9 p-0">
                                        <label for="titulo" class="col-form-label">Título:</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo"
                                            placeholder="Busca un Titulo" required>
                                        <div class="position-relative">
                                            <div id="sugerencias-titulo"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-titulo" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <label for="descripcion" class="col-form-label">Descripción:</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-1" id="devDis">
                                    <div class="col p-0">
                                        <label for="dis" class="col-form-label">Distribuidores:</label>
                                        <input type="text" class="form-control" id="dis"
                                            placeholder="Busca un distribuidor">
                                        <div class="position-relative">
                                            <div id="sugerencias-dis"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-dis" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="dis-active" class="row mt-2">
                                </div>
                                <div class="row mb-1" id="devDiv">
                                    <div class="col p-0">
                                        <label for="dis" class="col-form-label">Desarrolladores:</label>
                                        <input type="text" class="form-control" id="dev"
                                            placeholder="Busca un desarrollador">
                                        <div class="position-relative">
                                            <div id="sugerencias-dev"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-dev" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="dev-active" class="row mt-2">
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <label for="sist" class="col-form-label">Sistemas:</label>
                                        <input type="text" class="form-control" id="sist" placeholder="Busca un Sistema">
                                        <div class="position-relative">
                                            <div id="sugerencias-sist"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-sist" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sist-active" class="row mt-2">
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <label for="gen" class="col-form-label">Géneros:</label>
                                        <input type="text" class="form-control" id="gen" placeholder="Busca un Género">
                                        <div class="position-relative">
                                            <div id="sugerencias-gen"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-gen" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="gen-active" class="row mt-2">
                                </div>
                                <div class="row">
                                    <label class="col-form-label" for="year">Año</label>
                                    <input class="form-control" type="number" name="year" id="year" min="1900"
                                        max="<?php echo date("Y"); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 campos" id="divPortada">
                                <!-- INPUT PORTADA -->
                                <label for="portada" class="col-form-label">Portada:</label>
                                <input type="file" id="file" name="portada" accept="image/*">
                                <input type="hidden" id="fileSrc" name="fileSrc" value="">
                            </div>
                            <div class="col-5 campos" id="divArchivo">
                                <!-- INPUT JUEGO -->
                                <label for="archivoJuego" class="col-form-label">Juego:</label>
                                <input type="file" id="archivoJuego" name="archivoJuego" accept=".jsdos">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Añadir" name="addGame">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/fetchAddGame.js">
        //Api para sacar datos de juegos de mobygames y bbdd por lado cliente
    </script>
<?php } ?>

<div class="dropdown btn text-white position-fixed end-0 bottom-0 m-4">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownAddGame"
        data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="bi me-2" width="20" height="20">
            <use xlink:href="#game" />
        </svg>
        <strong>Nuevo Juego</strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark addGameDropdown text-small shadow bg-menu mb-2" aria-labelledby="dropdownAddGame">
        <li class="dropdown-item rounded-top p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">

            <button class="bg-transparent border-0 text-start ps-3 p-2 w-100">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#plus" />
                </svg>Añadir</button>
        </li>
        <li>
            <hr class="dropdown-divider p-0 m-0">
        </li>
        <li class="dropdown-item rounded-top p-0" data-bs-toggle="modal" data-bs-target="#importarModal">

            <button class="bg-transparent border-0 text-start ps-3 p-2 w-100">
                <svg class="bi me-2" width="20" height="20">
                    <use xlink:href="#import" />
                </svg>Importar</button>
        </li>
    </ul>
</div>


<div class="modal fade" id="importarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Importar Juegos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="archivoImport" id="" accept="/*">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
//Si se desea editar se muestra el modal de edicion siempre que la accion este mandada
if (isset($_POST["action"]) && $_POST["action"] == "game-edit") {
    ?>
    <!-- MODAL -->
    <div class="modal fade modal-lg" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editarModal">Editar Juego</h1>
                    <button type="submit" form="cancel-edit" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form id="cancel-edit" method="post"></form>
                    <form id="accept-edit" method="post" enctype="multipart/form-data" onsubmit="return checkFilled()">
                        <div class="row">
                            <div id="add-errors" class="div">

                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative col-4 img-container d-flex align-items-center flex-column">
                                <!-- IMG PREVIEW -->
                                <img id="portada" src="<?php echo $_SESSION['datosJuego'][2] ?>"
                                    alt="Previsualización de la portada">
                            </div>

                            <div class="col campos">
                                <div class="row">
                                    <div class="col-3 ps-0 pe-3">
                                        <label for="id" class="col-form-label">ID:</label>
                                        <input type="text" value="<?php echo $_SESSION['datosJuego'][6] ?>"
                                            class="form-control" id="id" name="idEdit" disabled>
                                        <input type="hidden" value="<?php echo $_SESSION['datosJuego'][6] ?>"
                                            class="form-control" id="id" name="idEdit" required>
                                    </div>
                                    <div class="col-9 p-0">
                                        <label for="titulo" class="col-form-label">Título:</label>
                                        <input type="text" class="form-control" id="titulo" name="tituloEdit"
                                            placeholder="Busca un Titulo" value="<?php echo $_SESSION['datosJuego'][0] ?>"
                                            required>

                                        <div class="position-relative">
                                            <div id="sugerencias-titulo"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-titulo" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <label for="descripcion" class="col-form-label">Descripción:</label>
                                        <textarea class="form-control" id="descripcion" name="descripcionEdit"
                                            required> <?php echo $_SESSION['datosJuego'][7] ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-1" id="devDis">
                                    <div class="col p-0">
                                        <label for="dis" class="col-form-label">Distribuidores:</label>
                                        <input type="text" class="form-control" id="dis"
                                            placeholder="Busca un distribuidor">

                                        <div class="position-relative">
                                            <div id="sugerencias-dis"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-dis" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="dis-active" class="row mt-2">
                                    <div class="col-auto my-1 removable-buttons">
                                        <button type="button" class="btn btn-sm btn-primary col-auto">
                                            <?php print $_SESSION['datosJuego'][4] ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x bg-transparent" viewBox="0 0 16 16">
                                                <use href="#remove"></use>
                                            </svg>
                                        </button>

                                        <input type="hidden" name="dis" value="<?php print $_SESSION["iddis"] ?>">
                                        <input type="hidden" name="dis<?php print $_SESSION["iddis"] ?>"
                                            value="<?php print $_SESSION['datosJuego'][4] ?>">
                                    </div>
                                </div>
                                <div class="row mb-1" id="devDiv">
                                    <div class="col p-0">
                                        <label for="dis" class="col-form-label">Desarrolladores:</label>
                                        <input type="text" class="form-control" id="dev"
                                            placeholder="Busca un desarrollador">
                                        <div class="position-relative">
                                            <div id="sugerencias-dev"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-dev" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="dev-active" class="row mt-2">
                                    <div class="col-auto my-1 removable-buttons">
                                        <button type="button" class="btn btn-sm btn-primary col-auto">
                                            <?php print $_SESSION['datosJuego'][3] ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x bg-transparent" viewBox="0 0 16 16">
                                                <use href="#remove"></use>
                                            </svg>
                                        </button>

                                        <input type="hidden" name="dev" value="<?php print $_SESSION["iddev"] ?>">
                                        <input type="hidden" name="dis<?php print $_SESSION["iddev"] ?>"
                                            value="<?php print $_SESSION['datosJuego'][3] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <label for="sist" class="col-form-label">Sistemas:</label>
                                        <input type="text" class="form-control" id="sist" placeholder="Busca un Sistema">
                                        <div class="position-relative">
                                            <div id="sugerencias-sist"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-sist" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sist-active" class="row mt-2">

                                    <?php
                                    //Se sacan todos los sistemas en formato boton
                                    foreach ($_SESSION["sistemasJuego"] as $sistId => $sist) {
                                        include "frm/templates/sist-activeButton.php";
                                    }
                                    ?>

                                </div>
                                <div class="row">
                                    <div class="col p-0">
                                        <label for="gen" class="col-form-label">Géneros:</label>
                                        <input type="text" class="form-control" id="gen" placeholder="Busca un Género">
                                        <div class="position-relative">
                                            <div id="sugerencias-gen"
                                                class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                                <ul id="sugerencias-list-gen" class="list-group placeholder-glow">
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                    <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="gen-active" class="row mt-2">
                                    <?php
                                    //Se sacan todos los generos en formato boton
                                    foreach ($_SESSION["generosJuego"] as $genreId => $genre) {
                                        include "frm/templates/gen-activeButton.php";
                                    }
                                    ?>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-form-label" for="year">Año</label>
                                    <input class="form-control" type="number" name="yearEdit" id="year" min="1900"
                                        max="<?php echo date("Y"); ?>" value="<?php echo $_SESSION['datosJuego'][5] ?>"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 campos">
                                <!-- INPUT PORTADA -->
                                <label for="portada" class="col-form-label">Portada:</label>
                                <input type="file" id="file" name="portadaEdit" accept="image/*">
                                <input type="hidden" id="fileSrc" name="fileSrcEdit"
                                    value="<?php echo $_SESSION['datosJuego'][2] ?>">
                            </div>
                            <div class="col-5 campos">
                                <!-- RUTA -->
                                <label class="col-form-label" for="ruta">Ruta:</label>
                                <input type="file" id="ruta" name="rutaEdit" accept=".jsdos">
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="submit" form="cancel-edit" class="btn btn-secondary">Cancelar</button>
                        <button type="submit" form="accept-edit" class="btn btn-primary" name="action"
                            value="game-apply">Confirmar
                            Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/fetchEditGame.js">
        //Script para hacer fetch a api de moby games y api servidor para mostrar datos juegos
    </script>
    <?php
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/adm-juegos.js"></script>