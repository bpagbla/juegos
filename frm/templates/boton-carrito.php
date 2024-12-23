<div class="d-flex justify-content-end flex-column">

    <button type="button" class="btn btn-primary position-relative carrito mt-4 me-5"
            data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
            aria-controls="collapseExample">
        <svg class="bi m-1" width="25" height="25">
            <use xlink:href="#cart" />
        </svg> <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border-light">+99
                        <span class="visually-hidden">productos en carrito</span></span>
    </button>

    <div class="collapse mt-4 me-5" id="collapseExample">
        <div class="card cardCarrito" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Tu cesta</h5>
                <p class="card-text">Total: PRECIO</p>
            </div>
            <ul class="list-group list-group-flush">
                <?php
                include "frm/templates/productos-carrito.php";
                ?>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
</div>
