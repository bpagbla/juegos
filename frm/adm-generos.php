<div class="row justify-left px-2">
    <div class="col">
        <h2 class="mt-3">Administrar Géneros</h2>
    </div>
</div>
<button id="display-add-button" type="button" class="btn text-white position-fixed end-0 bottom-0 m-4">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>

<?php

foreach ($generos as $genero) {
    include "frm/templates/card-adm-genre.php";
}
?>

<!-- Modal -->
<div class="modal fade modal-lg" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir Genero</h1>
                <button type="submit" class="btn-close" form="add-cancel"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div id="passwd-alert" class="alert alert-danger col-11 <?php if (empty($userError)) print 'd-none';?>" role="alert">
                        <?php if (!empty($userError)) print $userError ?>
                    </div>
                </div>
                <form id="add-cancel" method="post"></form>
                <form id="add-form" method="post">
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="add-id" class="form-label">ID</label>
                            <input name="id" type="number" min="0" class="form-control" id="add-id" value="<?php if (isset($_POST["firstName"])) print $_POST["firstName"] ?>" required>
                        </div>
                        <div class="col-9 mb-3">
                            <label for="add-name" class="form-label">Nombre</label>
                            <input name="name" type="text" class="form-control" id="add-name" value="<?php if (isset($_POST["lastName"])) print $_POST["lastName"] ?>" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="add-cancel">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="add-form" name="action" value="genero-add">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const addModal = new bootstrap.Modal('#add-modal', {
        keyboard: false
    })

    document.getElementById('display-add-button').addEventListener('click', function () {addModal.show()})
</script>
