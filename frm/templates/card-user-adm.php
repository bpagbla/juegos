<div class="row pt-3">
    <div class="col">
        <div class="card bg-body-tertiary">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title m-0 d-inline-block"><?php print $user[0] . " | " . $user[1] ?></h5>
                <div class="d-inline-block">
                    <form method="post">
                        <input type="hidden" name="user" value="<?php print $user[0]?>">
                        <button class="btn btn-sm btn-primary" name="action" value="user-edit">Editar</button>
                        <button class="btn btn-sm btn-primary" name="action" value="user-delete">Borrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>