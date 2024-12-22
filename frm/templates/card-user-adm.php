<div class="row pt-3">
    <div class="col">
        <div class="card bg-body-tertiary">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title m-0 d-inline-block"><?php print $user[0] . " | " . $user[1] ?></h5>
                <div class="d-inline-block">
                    <form method="post">
                        <input type="hidden" name="id" value="<?php print $user[0]?>">
                        <input type="hidden" name="nick" value="<?php print $user[1]?>">
                        <button class="btn btn-sm btn-primary" name="action" value="user-passwd">Cambiar Contraseña</button>
                        <button class="btn btn-sm btn-primary" name="action" value="user-edit">Editar</button>
                        <?php if ($_SESSION["nick"] !== $user[1]) { ?>
                        <button class="btn btn-sm btn-primary" name="action" value="user-delete">Borrar</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>