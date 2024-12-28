<div class="row pt-3">
    <div class="col">
        <div class="card bg-body-tertiary">
            <div class="card-body d-flex justify-content-between">
                <h5 class="card-title m-0 d-inline-block"><?php print $genero[0] . " | " . $genero[1] ?></h5>
                <div class="d-inline-block">
                    <form method="post">
                        <input type="hidden" name="id" value="<?php print $genero[0] ?>">
                        <input type="hidden" name="nombre" value="<?php print $genero[1] ?>">
                        <button class="btn btn-sm btn-primary" name="action" value="genero-edit">Editar</button>
                        <button class="btn btn-sm btn-primary" name="action" value="genero-delete">Borrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>