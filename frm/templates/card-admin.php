<div class="col-auto py-3">
    <div class="card" style="width: 18rem;">
                                        <!--Include the image of the game-->
        <img src="../img/game-thumbnail/<?php print $game[0] ?>.webp" class="card-img-top" alt="...">
        <div class="card-body">    <!--Include the title of the game in the card-->
            <h5 class="card-title"><?php print $game[1] ?></h5>
            <div class="d-flex justify-content-around">
                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                <a href="#" class="btn btn-sm btn-primary">Borrar</a>
            </div>
        </div>
    </div>
</div>