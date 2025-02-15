<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Awesome Website</title>
    <!-- js-dos style sheet -->
    <link rel="stylesheet" href="css/js-dos.css">
    <!-- js-dos -->
    <script src="js/js-dos.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/base.css">
</head>
<body>
<form id="return-form" method="get"></form>
<header style="height: 5vh;background-color: #0F0F1AFF;align-items: center; display: flex; justify-content: end">
    <button class="btn btn-primary btn-sm me-3" form="return-form" type="submit" name="page" value="principal">Volver</button>
</header>
<div id="dos" style="width: 100vw; height: 95vh;"></div>
<script>
    Dos(document.getElementById("dos"), {
        url: "<?php print $ruta;?>",
    });
</script>
</body>
</html>