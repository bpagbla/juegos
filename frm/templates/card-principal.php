<div class="col-auto py-3">
    <div class="card bg-body-tertiary" style="width: 18rem;">
        <!--Include the image of the game-->
        <img src="../<?php print $game[2] ?>" class="card-img-top" alt="...">
        <div class="card-body"> <!--Include the title of the game in the card-->
            <h5 class="card-title text-white"><?php print $game[1] ?></h5>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-primary">Info</a>
                <a href="#" class="btn btn-sm btn-primary">Jugar</a>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#modalPrestar">Prestar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPrestar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalPrestarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPrestarLabel">Prestar Juego</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="prestarJuego">
                        <div class="mb-3">
                            <label for="prestarNickname" class="form-label">¿A quién quieres prestar este juego?</label>
                            <input type="text" class="form-control" id="prestarNickname" name="prestarNickname<?php print $game[0] ?>" required placeholder="nickname">
                        </div>
                        <div class="mb-3">
                        <label for="finPrestamo" class="form-label">¿Hasta cuándo?</label>
                            <input type="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" required name="finPrestamo" id="finPrestamo" name="finPrestamo<?php print $game[0] ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="idJuegoPrestar<?php print $game[0] ?>">
                        </div>
                    </form>

                    <div class="bg-warning-subtle border border-warning rounded shadow">
                        <p class="text-warning pt-3 ps-3"> No podrás jugar a este juego mientras está prestado.</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="prestarJuego">Prestar</button>
                </div>
            </div>
        </div>
    </div>