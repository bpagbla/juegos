<div class="row justify-left border-bottom mx-1 mb-2">
    <div class="col">
        <h2 class="mt-3 px-2">Ajustes</h2>
    </div>
</div>
<form method="post">
    <div class="row border-1 border rounded mx-1">
        <div class="col-12 align-items-center justify-content-between d-flex mb-3 border-bottom py-2">
            <h5 class="mb-0">Datos Personales</h5>
            <button type="submit" name="action" value="update-personal" class="btn btn-sm">Aplicar</button>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="nick" class="input-group-text">@</label>
                <input id="nick" name="nick" type="text" class="form-control" aria-label="nick" value="<?php print $_SESSION["nick"]?>">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="email" class="input-group-text">Email</label>
                <input id="email" name="email" type="email" class="form-control" aria-label="email" value="<?php print $userData[1]?>">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="firstName" class="input-group-text">Nombre</label>
                <input id="firstName" name="firstName" type="text" class="form-control" aria-label="firstName" value="<?php print $userData[2]?>">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="lastName" class="input-group-text">Apellidos</label>
                <input id="lastName" name="lastName" type="text" class="form-control" aria-label="lastName" value="<?php print $userData[3]?>">
            </div>
        </div>
    </div>
</form>
<form method="post">
    <div class="row border-1 border rounded my-2 mx-1 pb-3">
        <div class="col-12 align-items-center justify-content-between d-flex mb-2 border-bottom py-2">
            <h5 class="mb-0">Cambiar Contraseña</h5>
            <button type="submit" name="action" value="update-passwd" class="btn btn-sm">Aplicar</button>
        </div>
        <div class="col-12 mb-2">
            <label for="passwd1">Nueva Contraseña</label>
            <input id="passwd1" name="passwd1" type="password" class="form-control" aria-label="nick" value="<?php if (isset($_POST['passwd1'])) { echo $_POST['passwd1']; } ?>">
        </div>
        <div class="col-12">
            <label for="passwd2">Repetir Contraseña</label>
            <input id="passwd2" name="passwd2" type="password" class="form-control" aria-label="email" value="<?php if (isset($_POST['passwd2'])) { echo $_POST['passwd2']; } ?>">
        </div>
    </div>
</form>
<div class="row border-1 border rounded my-2 mx-1">
    <form class="col-12 align-items-center justify-content-between d-flex py-2" method='post'>
        <h5 class="mb-0">Metodos de Pago</h5>
        <button type="submit" name="action" value="add-payment" class="btn btn-sm">Añadir</button>
    </form>
</div>

<div class="row border-1 border rounded my-2 mx-1">
    <?php
    $first = true;
    foreach ($cards as $card) {
        if ($first) {
            $first = false;
        } else { ?>
    <hr class="my-0">
    <?php } ?>
    <form method="post" class="col-12 align-items-center justify-content-between d-flex py-2">
        <p class="m-0"><?php print 'Mastercard:'.$card["num"].' | '.date("m/y",$card["date"]); ?></p>
        <input type="hidden" name="card" value="<?php print $card['num'].$card['date'] ?>">
        <button type="submit" name="action" value="remove-payment" class="btn btn-sm">Borrar</button>
    </form>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade modal-lg" id="payment-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir Metodo de Pago</h1>
                <button type="submit" class="btn-close" form="add-cancel"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div id="passwd-alert" class="alert alert-danger col-11 <?php if (!isset($_POST['submit-card'])) print 'd-none';?>" role="alert">
                        <?php if (isset($_POST['submit-card'])) print "Rellene los campos marcados en rojo correctamente" ?>
                    </div>
                </div>
                <form id="add-cancel" method="post"></form>
                <form id="add-form" method="post">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="add-cancel">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="add-form" name="action" value="payment-submit">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/ajustes.js"></script>
<script>
<?php if (isset($_POST['action']) && $_POST['action'] == 'update-passwd') {
?>
passwd1.classList.add('shake')
passwd2.classList.add('shake')
setTimeout(function () {
    passwd1.classList.remove('shake')
            passwd2.classList.remove('shake')
        }, 1000)
<?php
}
?>

const paymentModal = new bootstrap.Modal('#payment-modal', {
    keyboard: false
})

<?php
if (isset($_POST["action"]) && $_POST["action"] === "add-payment") print "paymentModal.show()"
?>

</script>