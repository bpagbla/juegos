<button type="button" class="btn btn-sm btn-primary col-auto m-2"> <?php print $genre ?> <svg class="bg-transparent"
        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x"
        viewBox="0 0 16 16">
        <use href="#remove"></use>
    </svg></button>

<input type="hidden" name="gen[]" value="<?php print $genreId ?>">

<input type="hidden" name="gen<?php print $genreId ?>" value="<?php print $genre ?>">