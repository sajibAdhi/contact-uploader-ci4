<?php if (! empty($message)): ?>
    <div class="alert p-2 alert-<?= $type ?? null ?>">
        <?= $message ?>
    </div>
<?php endif; ?>