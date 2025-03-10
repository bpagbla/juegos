<div class="col-auto py-3">
    <div class="card bg-body-tertiary" style="width: 18rem;">
        <!--Include the image of the game-->
        <img src="../<?php print $game[2] ?>" class="card-img-top" alt="Portada de <?php print $game[1] ?>">
        <div class="card-body"> <!--Include the title of the game in the card-->
            <h5 class="card-title text-white"><?php print $game[1] ?></h5>

            <!-- PRECIO -->
            <?php
            $precioOriginal = $game[3] / 100;
            $precioDesc = $precioOriginal;

            if (!empty($_SESSION["promoAct"])) {
                foreach ($_SESSION["promoAct"] as $key => $value) {
                    $precioDesc = $precioDesc * (1 - $value[2] / 100);
                }
            }

            ?>


            <p class="card-text"><?php if (!empty($_SESSION["promoAct"])) {
                print "<span class='tachado'>";
            }
            print $precioOriginal . "€";
            if (!empty($_SESSION["promoAct"])) {
                print "</span> ";
                print "<span class='nuevoPrecio'>" . $precioDesc . "€</span>";
            } ?></p>


            <div class="d-flex justify-content-between">
                <form method="get">
                    <input type="hidden" name="page" value="juegos">
                    <button class="btn btn-sm" name="display" value="<?php print $game[0] ?>">Info</button>
                </form>
                <form action="" method="post">
                    <div class="<?php if (isset($game[4]))
                        echo " owned" ?>">
                            <input type="submit" value="Comprar" class="btn btn-sm btn-primary <?php if (isset($game[4]))
                        echo "disabled" ?>" name="juegoCompra<?php print $game[0] ?>">

                        <?php if (isset($game[4]))
                            echo "<span class='ownedText'>Ya tienes este juego</span>" ?>

                        </div>
                    </form>
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop<?php print $game[0] ?>">Regalar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop<?php print $game[0] ?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Regalar Juego</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="regalarJuego<?php print $game[0] ?>">
                    <div class="mb-3">
                        <label for="regaloNickname" class="form-label">¿A quién quieres regalar este juego?</label>
                        <input type="text" class="form-control" id="regaloNickname"
                            name="regaloNickname<?php print $game[0] ?>" required placeholder="nickname">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="idJuegoRegalo<?php print $game[0] ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="regalarJuego<?php print $game[0] ?>">Regalar
                </button>
            </div>
        </div>
    </div>
</div>