<div class="col-auto py-3">
    <div class="card bg-body-tertiary" style="width: 18rem;">
        <!--Include the image of the game-->
        <img src="../img/game-thumbnail/<?php print $game[0] ?>.webp" class="card-img-top" alt="...">
        <div class="card-body"> <!--Include the title of the game in the card-->
            <h5 class="card-title text-white"><?php print $game[1] ?></h5>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-primary">Info</a>
                <form action="" method="post">
                    <input type="submit" value="Comprar" class="btn btn-sm btn-primary <?php if (isset($game[2]))
                        echo "disabled" ?>" name="juegoCompra<?php print $game[0] ?>">
                </form>
                <a href="#" class="btn btn-sm btn-primary">Regalar</a>
            </div>
        </div>
    </div>
</div>