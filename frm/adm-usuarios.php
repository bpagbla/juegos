<div class="row justify-left px-2">
    <div class="col">
        <h2 class="mt-3">Administrar Usuarios</h2>
    </div>
</div>
<button id="display-add-button" type="button" class="btn text-white position-fixed end-0 bottom-0 m-4">
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
                <form id="dismiss-form" method="post"></form>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario: <?php echo $_POST["nick"]; ?></h1>
                    <button type="submit" class="btn-close" form="dismiss-form"></button>
                </div>
                <div class="modal-body">
                    <form id="apply-form" method="post">
                        <div class="row">
                            <div class="col-2 mb-3">
                                <label for="form-id" class="form-label">ID</label>
                                <input type="number" class="form-control" id="form-id" value="<?php print $_POST["id"] ?>" disabled>
                                <input name="id" type="hidden" value="<?php print $_POST["id"] ?>">
                            </div>
                            <div class="col-7 mb-3">
                                <label for="form-nick" class="form-label">Nick</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="at">@</span>
                                    <input name="nick" id="form-nick" type="text" class="form-control" placeholder="Username" aria-label="Nick" aria-describedby="at" value="<?php echo $_POST["nick"] ?>" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="form-role" class="form-label ms-1">Rol</label>
                                <select class="form-select" id="form-role" name="role" required>
                                    <option value="">Elije...</option>
                                    <option value="admin" <?php if ($reqUser[0] === "admin") {echo "selected";} ?>>admin</option>
                                    <option value="user" <?php if ($reqUser[0] === "user") {echo "selected";} ?>>user</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona un rol valido.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="form-email" class="form-label">Correo Electronico</label>
                            <input name="email" type="email" class="form-control" id="form-email" placeholder="usuario@ejemplo.com" value="<?php print $reqUser[1] ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="form-firstName" class="form-label">Nombre</label>
                                <input name="firstName" type="text" class="form-control" id="form-firstName" value="<?php print $reqUser[2] ?>" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="form-lastName" class="form-label">Apellidos</label>
                                <input name="lastName" type="text" class="form-control" id="form-lastName" value="<?php print $reqUser[3] ?>">
                            </div>
                        </div>
                    </form>
                    <div class="row border-1 border rounded my-2 mx-1">
                        <form class="col-12 align-items-center" method='post'>
                            <div class="row">
                                <div class="col justify-content-between d-flex align-items-center  py-2">
                                    <h5 class="mb-0">Metodos de Pago</h5>
                                    <button type="submit" name="subaction" value="add-payment" class="btn btn-sm">Añadir</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="card-num" class="form-label">Numero de Tarjeta</label>
                                    <input name="num" type="number" class="form-control" id="card-num" placeholder="1234567891234567" value="<?php if (isset($_POST["email"])) print $_POST["email"] ?>" required>
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="card-cvv" class="form-label">CVV</label>
                                    <input name="cvv" type="number" max="999" class="form-control" placeholder="123" id="card-cvv" value="<?php if (isset($_POST["firstName"])) print $_POST["firstName"] ?>" required>
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="card-exp" class="form-label">Fecha Caducidad</label>
                                    <input name="exp" type="text" class="form-control" id="card-exp" placeholder="01/24" value="<?php if (isset($_POST["lastName"])) print $_POST["lastName"] ?>" required>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="user-edit">
                            <input type="hidden" name="nick" value="<?php print $_POST["nick"] ?>">
                            <input type="hidden" name="id" value="<?php print $_POST["id"] ?>">
                        </form>
                    </div>
                    <div class="row border-1 border rounded my-2 mx-1">
                        <?php
                        $first = true;
                        foreach ($cards as $card) {
                            $type = (str_starts_with($card["num"], '4')) ? 'Visa' : 'Mastercard';
                            if ($first) {
                                $first = false;
                            } else { ?>
                                <hr class="my-0">
                            <?php } ?>
                            <form method="post" class="col-12 align-items-center justify-content-between d-flex py-2">
                                <p class="m-0"><?php print $type . ':' . $card["num"] . ' | ' . date("m/y", $card["date"]); ?></p>
                                <input type="hidden" name="card" value="<?php print $card['num'] . $card['date'] ?>">
                                <input type="hidden" name="action" value="user-edit">
                                <input type="hidden" name="nick" value="<?php print $_POST["nick"] ?>">
                                <input type="hidden" name="id" value="<?php print $_POST["id"] ?>">
                                <button type="submit" name="subaction" value="remove-payment" class="btn btn-sm">Borrar
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" form="dismiss-form">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="apply-form" name="action" value="user-apply">Aplicar</button>
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
                    <form id="modal-form" method="post" onsubmit="return validate()">
                        <div class="row justify-content-center">
                            <div id="passwd-alert" class="alert alert-danger col-11 d-none" role="alert">
                                Las contraseñas no coinciden!
                            </div>
                        </div>
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
                        <input type="hidden" value="<?php echo $_POST["id"]; ?>" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" form="model-cancel">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="action" value="user-passwd-apply" form="modal-form">Aplicar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const myModal = new bootstrap.Modal('#myModal', {
            keyboard: false
        })
        myModal.show();

        function validate(e) {

            let inputs = document.getElementById("modal-form").querySelectorAll("input")

            if (inputs[0].value === inputs[1].value) {
                return true;
            } else {
                document.getElementById("passwd-alert").classList.remove('d-none')
                document.getElementById("passwd-alert").classList.add('shake')
                setTimeout(() => {
                    document.getElementById("passwd-alert").classList.remove('shake')
                }, 1000);
                inputs[0].style.borderColor = 'red';
                inputs[1].style.borderColor = 'red';
                return false;
            }

        }

        let passwd1 = document.getElementById("passwd")
        let passwd2 = document.getElementById("passwd2")

        passwd1.addEventListener('input', function() {
            if (!passwd1.value && !passwd2.value) {
                passwd1.classList.remove('success-input')
                passwd2.classList.remove('success-input')
                passwd1.classList.remove('error-input')
                passwd2.classList.remove('error-input')
                return;
            }

            if (!passwd2.value) {return;}

            if (passwd1.value === passwd2.value) {
                passwd1.classList.remove('error-input')
                passwd2.classList.remove('error-input')
                passwd1.classList.add('success-input')
                passwd2.classList.add('success-input')
            } else {
                passwd1.classList.add('error-input')
                passwd2.classList.add('error-input')
                passwd1.classList.remove('success-input')
                passwd2.classList.remove('success-input')
            }

        })

        passwd2.addEventListener('input', function() {
            if (passwd1.value === passwd2.value) {
                passwd1.classList.remove('error-input')
                passwd2.classList.remove('error-input')
                if (!passwd1.value && !passwd2.value) {
                    passwd1.classList.remove('success-input')
                    passwd2.classList.remove('success-input')
                } else {
                    passwd1.classList.add('success-input')
                    passwd2.classList.add('success-input')
                }
            } else {
                passwd1.classList.add('error-input')
                passwd2.classList.add('error-input')
                passwd1.classList.remove('success-input')
                passwd2.classList.remove('success-input')
            }
        })

    </script>

    <?php
}
?>

<!-- Modal -->
<div class="modal fade modal-lg" id="add-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir Usuario</h1>
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
                        <div class="col-8 mb-3">
                            <label for="add-nick" class="form-label">Nick</label>
                            <div class="input-group">
                                <span class="input-group-text" id="at">@</span>
                                <input name="nick" id="add-nick" type="text" class="form-control" placeholder="Username" aria-label="Nick" aria-describedby="at" value="<?php if (isset($_POST["nick"])) echo $_POST["nick"] ?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="add-role" class="form-label ms-1">Rol</label>
                            <select class="form-select" id="add-role" name="role" required>
                                <option value="">Elije...</option>
                                <option value="admin" <?php if (isset($_POST["role"]) && $_POST["role"] === "admin") {echo "selected";} ?>>admin</option>
                                <option value="user" <?php if (isset($_POST["role"]) && $_POST["role"] === "user") {echo "selected";} ?>>user</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona un rol valido.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="add-email" class="form-label">Correo Electronico</label>
                        <input name="email" type="email" class="form-control" id="add-email" placeholder="usuario@ejemplo.com" value="<?php if (isset($_POST["email"])) print $_POST["email"] ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="add-firstName" class="form-label">Nombre</label>
                            <input name="firstName" type="text" class="form-control" id="add-firstName" value="<?php if (isset($_POST["firstName"])) print $_POST["firstName"] ?>" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="add-lastName" class="form-label">Apellidos</label>
                            <input name="lastName" type="text" class="form-control" id="add-lastName" value="<?php if (isset($_POST["lastName"])) print $_POST["lastName"] ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="add-cancel">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="add-form" name="action" value="user-add">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const addModal = new bootstrap.Modal('#add-modal', {
        keyboard: false
    })

    <?php
        if (isset($_POST["action"]) && $_POST["action"] === "user-add") print "addModal.show()"
    ?>

    document.getElementById('display-add-button').addEventListener('click', function () {addModal.show()})
</script>

