<div class="row justify-left px-2">
    <div class="col">
        <h2 class="mt-3">Administrar Compañías</h2>
    </div>
</div>
<button id="display-add-button" type="button" class="btn text-white position-fixed end-0 bottom-0 m-4">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>

<?php

foreach ($companies as $company) {
    include "frm/templates/card-adm-company.php";
}
?>

<!-- Modal add -->
<div class="modal fade modal-lg" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir Compañía</h1>
                <button type="submit" class="btn-close" form="add-cancel"></button>
            </div>
            <div class="modal-body">
                <form id="add-cancel" method="post"></form>
                <form id="add-form" method="post">
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="add-id" class="form-label">ID</label>
                            <input name="id" type="number" min="0" class="form-control" id="add-id" required>
                        </div>
                        <div class="col-9 mb-3">
                            <label for="add-name" class="form-label">Nombre</label>
                            <input name="name" type="text" class="form-control" id="add-name" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="add-cancel">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="add-form" name="action" value="company-add">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-lg" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Editar Compañía</h1>
                <button type="submit" class="btn-close" form="edit-cancel"></button>
            </div>
            <div class="modal-body">
                <form id="edit-cancel" method="post"></form>
                <form id="edit-form" method="post">
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="edit-id" class="form-label">ID</label>
                            <input type="number" min="0" class="form-control" id="edit-id" value="<?php if (isset($_POST["id"])) print $_POST["id"] ?>" disabled>
                            <input name="id" type="hidden" value="<?php if (isset($_POST["id"])) print $_POST["id"] ?>">
                        </div>
                        <div class="col-9 mb-3">
                            <label for="edit-name" class="form-label">Nombre</label>
                            <input name="name" type="text" class="form-control" id="edit-name" value="<?php if (isset($_POST["nombre"])) print $_POST["nombre"] ?>" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="edit-cancel">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="edit-form" name="action" value="company-edit-apply">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_POST["action"]) && $_POST["action"] === 'company-delete') {?>
<!-- Modal -->
<div class="modal fade modal-lg" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Error: Juegos asociados a esta compañía</h1>
                <button type="submit" class="btn-close" form="edit-cancel"></button>
            </div>
            <div class="modal-body px-5">
                <div class="row p-0">
                    <div class="col-12 p-0">
                        <p>Actualmente hay juegos asociados a esta compañía eliminalos o asocialos a otra compañía para continuar.</p>
                    </div>
                </div>
                <div class="row border rounded">
                    <div class="col-12">
                        <h1 class="modal-title fs-5 my-2">Compañías</h1>
                    </div>
                    <?php foreach ($games as $game) { ?>
                    <hr>
                    <div class="col-12">
                        <p><?php print $game[0].' | '.$game[1]; ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="edit-cancel">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
    const addModal = new bootstrap.Modal('#add-modal', {
        keyboard: false
    })

    document.getElementById('display-add-button').addEventListener('click', function () {addModal.show()})

    const editModal = new bootstrap.Modal('#edit-modal', {
        keyboard: false
    })

    <?php if (isset($_POST["action"]) && $_POST["action"] === 'company-edit') {?>
    editModal.show()
    <?php } ?>

    <?php if (isset($_POST["action"]) && $_POST["action"] === 'company-delete') {?>
    const deleteModal = new bootstrap.Modal('#delete-modal', {
        keyboard: false
    })
    deleteModal.show()
    <?php } ?>

</script>
