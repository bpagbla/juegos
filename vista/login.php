<?php
include "../frm/login.php";

if ($loginAttempt) { print "<script async src='../js/login.js'></script>"; }

if(isset($_SESSION["nuevaCuenta"])) { print "<script async src='../js/nuevaCuenta.js'></script>"; }

?>
</body>
</html>
