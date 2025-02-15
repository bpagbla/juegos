<li class="list-group-item">
    <?php
     $precioOriginal = $item[1] / 100;
     $precioDesc = $precioOriginal;
 
 
     if (!empty($_SESSION["promoAct"])) {
         foreach ($_SESSION["promoAct"] as $key => $value) {
             $precioDesc = $precioDesc * (1 - $value[2] / 100);
         }
     }
 
 
     echo $item[0] . ": ";
     if (!empty($_SESSION["promoAct"])) {
         print "<span class='tachado'>";
     }
     print $precioOriginal . "€";
     if (!empty($_SESSION["promoAct"])) {
         print "</span> ";
         print "<span class='nuevoPrecio'>" . $precioDesc . "€</span>";
     }
 
    ?>
    <form action="" method="post">
        <input type="submit" value="Eliminar" name="borrar<?php print $idJuego ?>">
    </form>
</li>