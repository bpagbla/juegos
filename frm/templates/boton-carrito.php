<div class="d-flex justify-content-end flex-column ">

    <button type="button" class="btn btn-primary position-relative carrito mt-4 me-5" data-bs-toggle="collapse"
        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <svg class="bi m-1" width="25" height="25">
            <use xlink:href="#cart" />
        </svg>
        <?php
        if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
            ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border-light">
                <?php echo count($_SESSION["carrito"]) ?>
                <span class="visually-hidden">productos en carrito</span></span>
            <?php
        }

        ?>

    </button>

    <div class="collapse mt-4 me-5" id="collapseExample">
        <div class="card cardCarrito" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Tu cesta</h5>
                <p class="card-text">Total: PRECIO</p>
            </div>
            <ul class="list-group list-group-flush">
                <?php
                if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
                    foreach ($_SESSION["carrito"] as $idJuego => $item) {
                        include "frm/templates/productos-carrito.php";
                    }
                }


                ?>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
</div>