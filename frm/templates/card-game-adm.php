<div class="col-auto py-3">
    <div class="card bg-body-tertiary" style="width: 18rem;">
        <!--Include the image of the game-->
        <img src="../<?php print $game[2] ?>" class="card-img-top" alt="...">
        <div class="card-body"> <!--Include the title of the game in the card-->
            <h5 class="card-title"><?php print $game[1] ?></h5>
            <div class="d-flex justify-content-around">

                <form method="post">
                    <input type="hidden" name="idJuego" value="<?php print $game[0] ?>">
                    <button class="btn btn-sm btn-primary" name="action" value="game-edit">Editar</button>
                    <button class="btn btn-sm btn-primary" name="action" value="game-delete">Borrar</button>
                </form>

            </div>
        </div>
    </div>
</div>