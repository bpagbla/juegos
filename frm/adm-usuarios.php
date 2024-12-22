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
    <div class="modal fade modal-lg" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario <?php echo ""; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-8 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nick</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Nick" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="province" class="form-label ms-1">Rol</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Elije...</option>
                                    <option value="1">admin</option>
                                    <option value="2">user</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona una provincia valida.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="usuario@ejemplo.com">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Apellidos</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1">
                            </div>
                        </div>
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

<?php
if (isset($_POST["action"]) && $_POST["action"] == "user-passwd") {
    ?>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Restablecer contraseña para <?php echo $_POST["nick"]; ?></h1>
                    <button type="submit" class="btn-close" form="model-cancel"></button>
                </div>
                <div class="modal-body">
                    <form id="model-cancel" method="post"></form>
                    <form id="modal-form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <label for="passwd" class="form-label ms-1">Contraseña</label>
                                <input type="password" class="form-control" id="passwd" placeholder="*************"
                                       value="<?php if (!empty($_POST["passwd"])) {
                                           print $_POST["passwd"];
                                       } ?>" name="passwd" required>
                                <div class="invalid-feedback">
                                    Introduce una contraseña valida.
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="passwd2" class="form-label ms-1">Repite Contraseña</label>
                                <input type="password" class="form-control" id="passwd2" placeholder="*************"
                                       value="<?php if (!empty($_POST["passwd2"])) {
                                           print $_POST["passwd2"];
                                       } ?>" name="passwd2" required>
                                <div class="invalid-feedback">
                                    Las dos contraseñas no son iguales.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" form="model-cancel">Cancelar</button>
                    <button type="submit" class="btn btn-primary" value="apply" form="modal-form">Aplicar</button>
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
