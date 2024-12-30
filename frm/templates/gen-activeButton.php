<button type="button" class="btn btn-sm btn-primary"> <?php print $genre[1] ?> <svg class="bg-transparent"
        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x"
        viewBox="0 0 16 16">
        <use href="#remove"></use>
    </svg></button>

<input type="hidden" name="gen[]" value="<?php print $genre[0] ?>">

<input type="hidden" name="gen<?php print $genre[0] ?>" value="<?php print $genre[1] ?>">'