<div class="col-auto py-3">
    <div class="card bg-body-tertiary" style="width: 18rem;">
        <!--Include the image of the game-->
        <img src="../<?php print $game[2] ?>" class="card-img-top" alt="...">
        <div class="card-body"> <!--Include the title of the game in the card-->
            <h5 class="card-title text-white"><?php print $game[1] ?></h5>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-primary">Info</a>
                <form action="" method="post">
                    <div class="<?php if (isset($game[3]))
                        echo " owned" ?>">
                            <input type="submit" value="Comprar" class="btn btn-sm btn-primary <?php if (isset($game[3]))
                        echo "disabled" ?>" name="juegoCompra<?php print $game[0] ?>">

                        <?php if (isset($game[3]))
                            echo "<span class='ownedText'>Ya tienes este juego</span>" ?>
                            
                        </div>
                    </form>
                    <a href="#" class="btn btn-sm btn-primary">Regalar</a>
                </div>
            </div>
        </div>
    </div>