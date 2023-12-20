<div class="form-group <?= validation_show_error('category_name') ? 'has-warning' : '' ?>">
    <label for="<?= $id ?? $name ?? null ?>" class="control-label col-sm-3">
        <?= $label ?? null ?>
    </label>
    <div class=" col-sm-9">
        <input type="<?= $type ?? null ?>"
               class="form-control" name="<?= $name ?? null ?>"
               id="<?= $id ?? $name ?? null ?>"
               value="<?= set_value($name ?? null, $defaultValue ?? null) ?>"
               placeholder="<?= $placeholder ?? null ?>">
        <span class="help-block"><?= validation_show_error($name ?? null) ?></span>
    </div>
</div>