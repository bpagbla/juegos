<?php
    $items = array();
    if (isset($_SESSION["carrito"])) {
        $items = unserialize($_SESSION["carrito"])->getCarrito();
    }
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Glitched Pixel | Checkout</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/checkout.css">
    <meta name="theme-color" content="#712cf9">
</head>
<body class="bg-body-tertiary">
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
</svg>

<div class="container">
    <main>
        <div class="py-4 text-center">
            <h2>Checkout</h2>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Tu carrito</span>
                    <span class="badge bg-primary rounded-pill"><?php print sizeof($items); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                        foreach ($items as $item) {
                            include "frm/templates/checkout-product.php";
                        }
                    ?>
                    <?php if (sizeof($items) < 1) { ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">No tienes Nada!</h6>
                                <small class="text-body-secondary">Vuelve a la tienda y añade algo antes.</small>
                            </div>
                        </li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong><?php
                            if (isset($_SESSION["totalPrecio"])) {
                                echo $_SESSION["totalPrecio"];
                            } else {
                                echo '00.00€';
                            }
                            ?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <h4 class="mb-3">Dirección de Facturación</h4>
                    </div>
                    <div class="col-auto">
                        <button form="return-form" name="page" value="juegos" type="submit" class="btn btn-primary">Volver</button>
                    </div>
                </div>
                <form method="post" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Hay que introducir el nombre.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Hay que introducir un apellido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Hay que especificar una dirección de facturación.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Dirección 2 <span class="text-body-secondary">(Opcional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Pais</label>
                            <select class="form-select" id="country" required>
                                <option value="">Elige...</option>
                                <option>España</option>
                            </select>
                            <div class="invalid-feedback">
                                Elige un Pais.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">Comunidad Autonoma</label>
                            <select class="form-select" id="state" required>
                                <option value="">Choose...</option>
                                <option>Communidad de Madrid</option>
                                <option>Catalunya</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Codigo Postal</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Hay que introducir el codigo postal.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row justify-content-between mb-4">
                        <div class="col-auto align-content-center">
                            <h4 class="m-0">Tarjeta de Credito</h4>
                        </div>
                        <div class="col-auto">
                            <button form="adm-payment" type="submit" name="page" value="ajustes" class="btn btn-primary btn">Administrar</button>
                        </div>
                    </div>

                    <div class="row border-1 border rounded my-2 mx-1">
                        <?php
                        $first = true;
                        foreach ($cards as $card) {
                            if ($first) {
                                $first = false;
                            } else { ?>
                                <hr class="my-0">
                            <?php } ?>
                            <div class="col-12 align-items-center justify-content-between d-flex py-2">
                                <p class="m-0"><?php print 'Mastercard:'.$card["num"].' | '.date("m/y",$card["date"]); if ($card['date'] < time()) print ' | <span class="text-danger">Caducado</span>'; ?></p>
                                <input class="form-check-input" type="radio" name="card" value="<?php print $card['num'].$card['date'] ?>" required <?php if ($card['date'] < time()) print 'disabled' ?>>
                            </div>
                        <?php }
                        if (sizeof($cards) < 1) { ?>
                            <div class="col-12 align-items-center justify-content-between d-flex py-2">
                                <a class="link" href="/?page=ajustes&redirect=checkout">
                                    <p class="m-0">Añade antes una tarjeta para continuar</p>
                                </a>
                            </div>
                        <?php }
                        ?>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg mb-4" type="submit" name="formPago" <?php if (sizeof($items) < 1) print 'disabled'; ?>>Pagar</button>
                </form>
                <form type="get" id="adm-payment" onsubmit="save()"></form>
                <form type="get" id="return-form" onsubmit="save()"></form>
            </div>
        </div>
    </main>
</div>
<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/checkout.js"></script></body>
</html>
