<?php
session_start();
include_once "model.php";
/* include_once "index.php"; */
$promociones = model::sacarPromociones();

$hoy = new DateTimeImmutable();

$idsPromociones = array_keys($promociones);

// ELIMINAR PROMOCIONES QUE YA NO EXISTEN EN LA BASE DE DATOS
foreach ($_SESSION["promoAct"] as $key => $valores) {
    if (!in_array($key, $idsPromociones)) {
        unset($_SESSION["promoAct"][$key]);
        echo true;

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
            echo true;

        }
    } else {
        //si está activada se comprueba que siga activa
        if ($diasDif > $valores[3]) {
            unset($_SESSION["promoAct"][$key]);
        }/*  */
        echo false;
    }
}
