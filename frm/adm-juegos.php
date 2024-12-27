<div class="row justify-content-around justify-content-lg-start">
    <?php
    foreach ($games as $game) {
        include "frm/templates/card-game-adm.php";
    }
    ?>
</div>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="remove" viewBox="0 0 16 16">
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    </symbol>
</svg>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                            <img id="portada" src="" alt="Previsualización de la imagen">

                        </div>

                        <div class="col campos">
                            <div class="row">
                                <div class="col-3 ps-0 pe-3">
                                    <label for="id" class="col-form-label">ID:</label>
                                    <input type="text" class="form-control" id="id" name="id" required>
                                </div>
                                <div class="col-9 p-0">
                                    <label for="titulo" class="col-form-label">Título:</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Busca un Titulo" required>
                                    <div class="position-relative">
                                        <div id="sugerencias-titulo" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
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
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col p-0">
                                    <label for="dis" class="col-form-label">Distribuidores:</label>
                                    <input type="text" class="form-control" id="dis" placeholder="Busca un distribuidor">
                                    <div class="position-relative">
                                        <div id="sugerencias-dis" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
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
                            <div class="row mb-1">
                                <div class="col p-0">
                                    <label for="dis" class="col-form-label">Desarrolladores:</label>
                                    <input type="text" class="form-control" id="dev" placeholder="Busca un desarrollador">
                                    <div class="position-relative">
                                        <div id="sugerencias-dev" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
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
                                        <div id="sugerencias-sist" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
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
                                        <div id="sugerencias-gen" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
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
                            <div class="row mb-3">
                                <label class="col-form-label" for="year">Año</label>
                                <input class="form-control" type="number" name="year" id="year" min="1900"
                                    max="<?php echo date("Y"); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 campos">
                            <!-- INPUT PORTADA -->
                            <label for="portada" class="col-form-label">Portada:</label>
                            <input type="file" id="file" name="portada" accept="image/*">
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

<button type="button" class="btn text-white position-fixed end-0 bottom-0 m-4" data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    <?php
    if (isset($_POST["addGame"])) {
        ?>
        console.log("bien bien");
        <?php
    }
    ?>
</script>
<script src="js/fetchAddGame.js"></script>
<script src="library/dselect.js"></script>
<script src="js/adm-juegos.js"></script>