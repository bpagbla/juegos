<div class="row justify-content-between px-2">
    <div class="col-auto">
        <h2 class="pt-3">Tus Juegos</h2>
    </div>
    <div class="col-auto align-content-end">
        <button class="btn btn-primary" id="filter-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="M440-160q-17 0-28.5-11.5T400-200v-240L168-736q-15-20-4.5-42t36.5-22h560q26 0 36.5 22t-4.5 42L560-440v240q0 17-11.5 28.5T520-160h-80Zm40-308 198-252H282l198 252Zm0 0Z"/>
            </svg>
            Filters
        </button>
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

<!-- Modal Filtros -->
<div class="modal fade modal-lg" id="filter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4">Filtros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div id="passwd-alert" class="alert alert-danger col-11 <?php if (!isset($_POST['submit-card'])) print 'd-none';?>" role="alert">
                        <?php if (isset($_POST['submit-card'])) print "Rellene los campos marcados en rojo correctamente" ?>
                    </div>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="add-form">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/principal.js"></script>