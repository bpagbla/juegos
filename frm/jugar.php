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
</head>
<body>
<div id="dos" style="width: 100vw; height: 60vw;"></div>

<script>
    Dos(document.getElementById("dos"), {
        url: "<?php print $ruta;?>",
    });
</script>
</body>
</html>