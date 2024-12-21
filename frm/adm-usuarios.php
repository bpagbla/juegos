<button id="myInput" type="button" class="btn text-white position-fixed end-0 bottom-0 m-4">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>

<?php
foreach ($users as $user) {
    include "frm/templates/card-user-adm.php";
}
?>

<?php
if (isset($_POST["action"]) && $_POST["action"] == "user-edit") {
?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario <?php echo ""; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <label for="nick">Usuario</label>
                        <input id="nick" type="text" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const myModal = new bootstrap.Modal('#myModal', {
            keyboard: false
        })
        myModal.show();
    </script>

<?php
}
?>