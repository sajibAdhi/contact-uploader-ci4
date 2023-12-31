<div class="form-group <?= validation_show_error($name ?? '') ? 'has-warning' : '' ?>">
    <label for="<?= $id ?? null ?>" class="control-label col-sm-3">
        <?= $label ?? null ?>:
    </label>

    <div class="col-sm-9">
        <div class="input-group date <?= $readonly ?? false ? 'asd' : 'datepicker' ?>">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text"
                   class="form-control pull-right "
                   id="<?= $id ?? null ?>"
                   name="<?= $name ?? null ?>"
                   value="<?= set_value($name ?? '', $defaultValue ?? null) ?>"
                <?= $readonly ?? false ? 'readonly' : '' ?>
            >
        </div>
        <span class="help-block"><?= validation_show_error($name ?? '') ?></span>
    </div>
</div>