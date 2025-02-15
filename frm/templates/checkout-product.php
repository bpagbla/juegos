<?php
$precioOriginal = $item[1] / 100;
$precioDesc = $precioOriginal;

if (!empty($_SESSION["promoAct"])) {
    foreach ($_SESSION["promoAct"] as $key => $value) {
        $precioDesc = $precioDesc * (1 - $value[2] / 100);
    }
}

?>

<li class="list-group-item d-flex justify-content-between lh-sm">
    <div>
        <h6 class="my-0"><?php echo $item[0] ?></h6>
        <small class="text-body-secondary">Brief description</small>
    </div>
    <span class="text-body-secondary"><?php if (!empty($_SESSION["promoAct"])) {
        print "<span class='tachado'>";
    }
    print $precioOriginal . "€";
    if (!empty($_SESSION["promoAct"])) {
        print "</span> ";
        print "<span class='nuevoPrecio'>" . $precioDesc . "€</span>";
    } ?></span>
</li>