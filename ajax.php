<?php
include_once "model.php";
/* include_once "index.php"; */
$promociones = model::sacarPromociones();



$hoy = new DateTimeImmutable();

foreach ($promociones as $key => $valores) {
    $fechaPromo = new DateTimeImmutable($valores[0]);
    $interval = $fechaPromo->diff($hoy);
    $diasDif = (int) $interval->format('%R%a');

    //si no está activada se comprueba
    if (!isset($_SESSION["promoAct"][$key])) {
        if ($diasDif >= 0 && $diasDif <= $valores[3]) {
            //si está dentro del tiempo de la promoción
            $_SESSION["promoAct"][$key] = $valores;
            /* controlador::sendNotification("🎉¡Nueva promoción!🎉", "Disfruta de un " . $valores[1] . "% de descuento en todos los juegos por " . $valores[0] . " hasta el día " . date('Y-m-d', strtotime($valores[0] . ' + ' . $valores[3] . ' days'))); */
            $_SESSION["confetti"] = true;
        }
    }else{ 
        //si está activada se comprueba que siga activa
        if ($diasDif > $valores[3]) {
            unset($_SESSION["promoAct"][$key]);
        }

    }
}

echo json_encode( $_SESSION["promoAct"]);