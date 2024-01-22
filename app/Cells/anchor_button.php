<a class="btn btn-sm" href="<?= $href ?? null ?>" onclick="<?= $onclick ?? null ?>">
    <?php if (! empty($icon)): ?>
        <i class="<?= $icon ?>"></i>
    <?php endif; ?>
    <?= $title ?? null ?>
</a>
