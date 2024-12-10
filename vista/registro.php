<?php
//Shows the registry page
include "../frm/registro.php";

//If the user tried to register but this failed, include the js to show the error toast
if ($allPosts && !$added) {
    print "<script src='../js/errorRegistro.js'></script>";
}
print "</body>";
print "</html>";
