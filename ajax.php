<?php
session_start();
include_once "model.php";
include_once "clases/carrito.php";


recalcPrecios();

$promociones = model::sacarPromociones();

$hoy = new DateTimeImmutable();

$idsPromociones = array_keys($promociones);
// ELIMINAR PROMOCIONES QUE YA NO EXISTEN EN LA BASE DE DATOS
foreach ($_SESSION["promoAct"] as $key => $valores) {
    if (!in_array($key, $idsPromociones)) {
        unset($_SESSION["promoAct"][$key]);
        recalcPrecios();

    }
}

foreach ($promociones as $key => $valores) {
    $fechaPromo = new DateTimeImmutable($valores[0]);
    $interval = $fechaPromo->diff($hoy);
    $diasDif = (int) $interval->format('%R%a');

    //si no está activada se comprueba
    if (!isset($_SESSION["promoAct"][$key])) {
        if ($diasDif >= 0 && $diasDif <= $valores[3]) {
            //si está dentro del tiempo de la promoción
            $_SESSION["promoAct"][$key] = $valores;
            $_SESSION["confetti"] = true;
            $title = "🎉¡Nueva promoción!🎉";
            $body = "Disfruta de un " . $valores[2] . "% de descuento en todos los juegos por " . $valores[1] . " hasta el día " . date('Y-m-d', strtotime($valores[0] . ' + ' . $valores[3] . ' days'));

            $_SESSION["notifications"][] = array($title, $body, 5000);
            recalcPrecios();

        }
    } else {
        //si está activada se comprueba que siga activa
        if ($diasDif > $valores[3]) {
            unset($_SESSION["promoAct"][$key]);
            recalcPrecios();
        }/*  */
        echo false;
    }
}


function recalcPrecios(){
    $_SESSION["totalPrecio"]=0;
    $carrito = new Carrito();
    $carrito = unserialize($_SESSION['carrito']);

    $juegos = $carrito->getCarrito() ;


    foreach ($juegos as $key => $value) {
        $precio = $value[1] / 100;

        if (!empty($_SESSION["promoAct"])) {
            foreach ($_SESSION["promoAct"] as $promo => $valores) {
                $precio = $precio * (1 - $valores[2] / 100);
            }
        }
        $_SESSION["totalPrecio"] += $precio;
    }
    echo true;
}
