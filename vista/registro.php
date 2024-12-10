<?php

class Vista{
    public static function MuestraRegistro() {

        include "../frm/registro.php";
        if ($loginAttempt) { print "<script async src='../js/login.js'></script>"; }
        print "</body>";
        print "</html>";

    }

}