<?php

class Vista{
    public static function MuestraRegistro() {

        include "../frm/registro.php";
        if ($added) { print "<script async src='../js/login.js'></script>"; }
        print "</body>";
        print "</html>";

    }

}