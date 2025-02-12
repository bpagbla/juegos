<?php
session_start();
//array para guardar las fechas de promocion (con mensaje, descuento y dias que dura la promocion)
//METERLO A LA BBDD
$promociones = $_SESSION["promos"];


$hoy = new DateTimeImmutable();
$activas = array();

foreach ($promociones as $fecha => $valores) {
    $fechaPromo = new DateTimeImmutable($fecha);
    $interval = $fechaPromo->diff($hoy);
    $diasDif = (int) $interval->format('%R%a');

    if ($diasDif >= 0 && $diasDif <= $valores[2]) {
        //si está dentro del tiempo de la promoción
        $activas[$fecha] = $valores;
        unset($_SESSION["promos"][$fecha]);
    }
}

if (!empty($activas)) {
    $_SESSION["promocionesActivas"] = $activas;
    echo true;
}
