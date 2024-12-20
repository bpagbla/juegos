<div class="col px-3">
    <div class="row justify-left">
        <h2 class="mt-3">Tus Juegos</h2>
    </div>
    <div class="row justify-content-start align-items-end">
        <?php
        //Iterate over the games the user has and print the card for the game using the template
        foreach ($games as $game) {
            include('frm/templates/card-principal.php');
        }
        ?>
    </div>
</div>