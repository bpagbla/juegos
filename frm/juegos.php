<div class="row px-2 justify-content-around justify-content-lg-start align-items-end">
    <?php
    //Iterate over the games and print the card for the game using the template
    foreach ($games as $game) {
        include('frm/templates/card-juegos.php');
    }
    ?>
</div>
<div class="position-absolute top-0 end-0">
    <?php include "frm/templates/boton-carrito.php" ?>
</div>