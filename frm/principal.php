<div class="row px-2">
    <div class="col-auto">
        <h2 class="pt-3">Tus Juegos</h2>
    </div>
</div>
<div class="row px-2 justify-content-around justify-content-lg-start align-items-end">
    <?php
    //Iterate over the games the user has and print the card for the game using the template
    foreach ($prestados as $prestado) {
        include('frm/templates/card-prestados.php');
    }
    foreach ($games as $game) {
        include('frm/templates/card-principal.php');
    }
    ?>
</div>
<button class="position-fixed bottom-0 end-0 me-4 mb-4 btn btn-primary fw-bold" id="filter-button">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
        <path d="M440-160q-17 0-28.5-11.5T400-200v-240L168-736q-15-20-4.5-42t36.5-22h560q26 0 36.5 22t-4.5 42L560-440v240q0 17-11.5 28.5T520-160h-80Zm40-308 198-252H282l198 252Zm0 0Z"/>
    </svg>
    Filters
</button>
<!-- Modal Filtros -->
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="remove" viewBox="0 0 16 16">
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
    </symbol>
</svg>
<div class="modal fade modal-lg" id="filter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4">Filtros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="add-errors" class="row justify-content-center p-2">
                </div>
                <form id="add-form" method="get">
                    <input type="hidden" name="page" value="principal">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="fs-5">Año de Salida</h2>
                        </div>
                        <div class="col-12">
                            <div>
                                <span id="range1">
                                    0
                                </span>
                                <span> &dash; </span>
                                <span id="range2">
                                    100
                                 </span>
                            </div>
                            <div class="slider-div pt-3 pb-5">
                                <div class="slider-track"></div>
                                <input name="minYear" type="range" min="1952" max="<?php echo date("Y"); ?>" value="<?php echo ($_GET['minYear'] ?? '1900') ?>" id="slider-1">
                                <input name="maxYear" type="range" min="1952" max="<?php echo date("Y"); ?>" value="<?php echo ($_GET['maxYear'] ?? date("Y")) ?>" id="slider-2">
                            </div>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col p-0">
                            <label for="gen" class="col-form-label">Géneros:</label>
                            <input type="text" class="form-control" id="gen" placeholder="Busca un Género">
                            <div class="position-relative">
                                <div id="sugerencias-gen"
                                     class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                    <ul id="sugerencias-list-gen" class="list-group sugerencias placeholder-glow">
                                        <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                        <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                        <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="gen-active" class="row m-2">
                        <script>
                            let gameList = [];
                        </script>
                        <?php
                        //Se sacan todos los generos en formato boton
                        if (isset($_GET["gen"])) {
                            foreach ($_GET["gen"] as $genID) {
                                include "frm/templates/filter-gen.php";
                                print "<script>gameList.push(".$genID.")</script>";
                            }
                        }
                        ?>
                    </div>
                    <div class="row px-3" id="devDiv">
                        <div class="col p-0">
                            <label for="dis" class="col-form-label">Desarrolladores:</label>
                            <input type="text" class="form-control" id="dev"
                                   placeholder="Busca un desarrollador">
                            <div class="position-relative">
                                <div id="sugerencias-dev"
                                     class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                    <ul id="sugerencias-list-dev" class="list-group sugerencias placeholder-glow">
                                        <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                        <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                        <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dev-active" class="row m-1">
                        <?php if (!empty($_GET['dev'])) { ?>
                            <div class="col-auto my-1 removable-buttons">
                                <button type="button" class="btn btn-sm btn-primary col-auto">
                                    <?php print $_GET['dev'.$_GET['dev']]?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-x bg-transparent" viewBox="0 0 16 16">
                                        <use href="#remove"></use>
                                    </svg>
                                </button>

                                <input type="hidden" name="dev" value="<?php print $_GET['dev'] ?>">
                                <input type="hidden" name="dev<?php print $_GET['dev'] ?>"
                                       value="<?php print $_GET['dev'.$_GET['dev']] ?>">
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="add-form">Aplicar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Info -->

<?php
if (isset($_POST["info"])) {
    ?>

    <div class="modal modal-xl fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $_POST["infoTitulo"] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <img src="../<?php echo $_POST["infoImg"] ?>" class="card-img-top" alt="Portada del juego <?php echo $_POST["infoTitulo"] ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const myModal = new bootstrap.Modal('#infoModal', {
            keyboard: false
        })
        myModal.show();

    </script>
    <?php
}
?>

<script src="js/principal.js"></script>