<div class="col-auto my-1 removable-buttons">
    <button type="button" class="btn btn-sm btn-primary col-auto"> <?php print $sist ?> <svg
            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x bg-transparent"
            viewBox="0 0 16 16">
            <use href="#remove"></use>
        </svg>
    </button>

    <input type="hidden" name="sist[]" value="<?php print $sistId ?>">

    <input type="hidden" name="sist<?php print $sistId ?>" value="<?php print $sist ?>">
</div>