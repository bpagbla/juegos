<div class="row">
    <?php
    foreach ($games as $game) {
        include "frm/templates/card-admin.php";
    }
    ?>
</div>

<button type="button" class="btn text-white position-fixed posFixBotomRight">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>