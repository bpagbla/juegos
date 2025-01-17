<div class="col-auto py-3">
    <div class="card prestado bg-body-tertiary" style="width: 18rem;">

        <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill badgePrestado shadow">
            Disponible hasta: <?php print $prestado[4] ?>
            <span class="visually-hidden">unread messages</span>
        </span>
        <!--Include the image of the game-->
        <img src="../<?php print $prestado[2] ?>" class="card-img-top" alt="...">
        <div class="card-body"> <!--Include the title of the game in the card-->
            <h5 class="card-title text-white"><?php print $prestado[1] ?></h5>
            <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-primary">Info</button>
                <button class="btn btn-sm btn-primary">Jugar</button>
                <form action="" method="POST">
                    <input type="hidden" name="idUs1<?php print $prestado[0] ?>" value="<?php print $prestado[5] ?>">
                    <input type="submit" class="btn btn-sm btn-primary" name="devolver<?php print $prestado[0] ?>"
                        value="Devolver">

                </form>
            </div>
        </div>
    </div>
</div>