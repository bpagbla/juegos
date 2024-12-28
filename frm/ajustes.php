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
                <input id="nick" name="nick" type="text" class="form-control" aria-label="nick">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="email" class="input-group-text">Email</label>
                <input id="email" name="email" type="email" class="form-control" aria-label="email">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="firstName" class="input-group-text">Nombre</label>
                <input id="firstName" name="firstName" type="text" class="form-control" aria-label="firstName">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="input-group mb-3">
                <label for="lastName" class="input-group-text">Apellidos</label>
                <input id="lastName" name="lastName" type="text" class="form-control" aria-label="lastName">
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
            <input id="passwd1" name="passwd1" type="text" class="form-control" aria-label="nick">
        </div>
        <div class="col-12">
            <label for="passwd2">Repetir Contraseña</label>
            <input id="passwd2" name="passwd2" type="text" class="form-control" aria-label="email">
        </div>
    </div>
</form>
<div class="row border-1 border rounded my-2 mx-1">
    <div class="col-12 align-items-center justify-content-between d-flex py-2">
        <h5 class="mb-0">Metodos de Pago</h5>
        <button type="button" class="btn btn-sm">Añadir</button>
    </div>
</div>
<div class="row border-1 border rounded my-2 mx-1">
    <form method="post" class="col-12 align-items-center justify-content-between d-flex py-2">
        <p class="m-0">Mastercard:4234</p>
        <input type="hidden" name="card" value="1">
        <button type="submit" name="action" value="remove-payment" class="btn btn-sm">Borrar</button>
    </form>
    <hr class="my-0">
    <form method="post" class="col-12 align-items-center justify-content-between d-flex py-2">
        <p class="m-0">Mastercard:4234</p>
        <input type="hidden" name="card" value="1">
        <button type="submit" name="action" value="remove-payment" class="btn btn-sm">Borrar</button>
    </form>
    <hr class="my-0">
    <form method="post" class="col-12 align-items-center justify-content-between d-flex py-2">
        <p class="m-0">Mastercard:4234</p>
        <input type="hidden" name="card" value="1">
        <button type="submit" name="action" value="remove-payment" class="btn btn-sm">Borrar</button>
    </form>
</div>
<?php
print_r($_POST)
?>