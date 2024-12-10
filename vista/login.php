<?php
include "../frm/login.php";

if ($loginAttempt) {
    print "<script async src='../js/login.js'></script>";
}

if (isset($_SESSION["nuevaCuenta"]) && $_SESSION["nuevaCuenta"]==true) {
    print "<script async src='../js/nuevaCuenta.js'></script>";
    $_SESSION["nuevaCuenta"]=false;
}

?>
</body>

</html>