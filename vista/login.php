<?php
include "../frm/login.php";

//If attempted to login, show the toast for login error.
if ($loginAttempt) {
    print "<script async src='../js/login.js'></script>";
}

//If succesfully registered. Show the toast of the correct registration.
if (isset($_SESSION["nuevaCuenta"]) && $_SESSION["nuevaCuenta"]==true) {
    print "<script async src='../js/nuevaCuenta.js'></script>";
    $_SESSION["nuevaCuenta"]=false;
}

?>
</body>

</html>