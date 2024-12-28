<div class="row justify-left px-2">
    <div class="col">
        <h2 class="mt-3">Administrar Géneros</h2>
    </div>
</div>
<button type="button" class="btn text-white position-fixed end-0 bottom-0 m-4">
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