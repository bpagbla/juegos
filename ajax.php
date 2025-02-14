<?php
session_start();
include_once "model.php";
/* include_once "index.php"; */
$promociones = model::sacarPromociones();

$hoy = new DateTimeImmutable();

foreach ($_SESSION["promoAct"] as $key => $value) {
    if (!array_key_exists($key, $promociones)) {
        unset($_SESSION["promoAct"][$key]);
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

            /* controlador::sendNotification("🎉¡Nueva promoción!🎉", "Disfruta de un " . $valores[1] . "% de descuento en todos los juegos por " . $valores[0] . " hasta el día " . date('Y-m-d', strtotime($valores[0] . ' + ' . $valores[3] . ' days'))); */
        }
    } else {
        //si está activada se comprueba que siga activa
        if ($diasDif > $valores[3]) {
            unset($_SESSION["promoAct"][$key]);
        }/*  */

    }
}

echo json_encode(["promociones" => $promociones, "confetti" => $_SESSION["confetti"] ?? false]);