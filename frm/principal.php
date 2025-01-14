<div class="row justify-content-between px-2">
    <div class="col-auto">
        <h2 class="pt-3">Tus Juegos</h2>
    </div>
    <div class="col-auto align-content-end">
        <button class="btn btn-primary">Filters</button>
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