<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-config='{"delay":100000}'>
    <div class="toast-header">
        <strong class="me-auto"><?php print $notification[0]; ?></strong>
        <small class="text-body-secondary">just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        <?php print $notification[1]; ?>
    </div>
</div>
