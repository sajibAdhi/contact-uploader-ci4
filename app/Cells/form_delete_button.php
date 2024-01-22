<form style="display: inline-block;"
      method="POST" action="<?= $action ?? null ?>"
      onsubmit="return confirm('Are you sure you want to <?= strtolower($buttonTitle ?? null) ?> this item?');">
    <?= csrf_field() ?>
    <?= form_hidden('_method', 'DELETE') ?>
    <button type="submit" class="btn btn-sm">
        <?php if (! empty($icon)): ?>
            <i class="<?= $icon ?>"></i>
        <?php endif; ?>
        <?= $buttonTitle ?? null ?>
    </button>
</form>