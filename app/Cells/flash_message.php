<?php if (!empty($message)) : ?>
    <div class="alert p-2 alert-<?= $type ?? null ?> alert-dismissible">
        <button class="close close-button" aria-label="Close" type="button" data-dismiss="alert">
            <span aria-hidden="true"><span>&times;</span></span>
        </button>
        <?= $message ?>
    </div>
<?php endif; ?>