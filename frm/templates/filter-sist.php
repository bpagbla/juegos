<div class="col-auto removable-buttons m-2 p-0">
    <button type="button" class="btn btn-sm btn-primary col-auto"> <?php print $_GET['sist'.$sistID] ?> <svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x bg-transparent"
                viewBox="0 0 16 16">
            <use href="#remove"></use>
        </svg>
    </button>

    <input type="hidden" name="sist[]" value="<?php print $sistID ?>">

    <input type="hidden" name="sist<?php print $sistID ?>" value="<?php print $_GET['sist'.$sistID] ?>">
</div>