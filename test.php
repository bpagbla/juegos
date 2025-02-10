<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // initialize SOAP client and call web service function
    $client=new SoapClient(null,array('uri'=>'https://localhost/','location'=>'https://localhost/cardChecker.php'));
    $resp=$client->resolve($_GET['num']);
    // dump response
    print_r($resp);
    ?>
</body>
</html>