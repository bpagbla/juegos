<?php include_once 'clases/carrito.php';
if (isset($_SESSION['carrito'])) {
    $arrayCarrito = unserialize($_SESSION["carrito"])->getCarrito() ?? "";
    ?>
    <div class="d-flex justify-content-end flex-column ">

        <button type="button" class="btn btn-primary position-relative carrito mt-4 me-5" data-bs-toggle="collapse"
            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <svg class="bi m-1" width="25" height="25">
                <use xlink:href="#cart" />
            </svg>
            <?php
            if (!empty($arrayCarrito)) {
                ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border-light">
                    <?php echo count($arrayCarrito) ?>
                    <span class="visually-hidden">productos en carrito</span></span>
                <?php
            }

            ?>

        </button>

        <div class="collapse mt-4 me-5" id="collapseExample">
            <div class="card cardCarrito" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tu cesta</h5>
                    <p class="card-text"><?php if (isset($_SESSION["totalPrecio"]))
                        echo $_SESSION["totalPrecio"] . "€" ?></p>
                    </div>
                    <ul class="list-group list-group-flush rounded-bottom">
                        <?php
                    if (!empty($arrayCarrito) && count($arrayCarrito) > 0) {
                        foreach ($arrayCarrito as $idJuego => $item) {
                            include "frm/templates/productos-carrito.php";
                        }
                    }
                    ?>
                </ul>
                <button type="submit" class="btn" name="page" value="checkout" form="checkout-form">Checkout</button>
                <form method="get" id="checkout-form">
                </form>
            </div>
        </div>
    </div>
<?php } ?>