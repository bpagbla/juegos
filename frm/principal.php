<div class="row justify-left px-2">
    <div class="col">
        <h2 class="mt-3">Tus Juegos</h2>
    </div>
</div>
<div class="row px-2 justify-content-around justify-content-lg-start align-items-end">
    <?php
    //Iterate over the games the user has and print the card for the game using the template
    foreach ($games as $game) {
        include('frm/templates/card-principal.php');
    }
    ?>
</div>
<script src="js/principal.js"></script>