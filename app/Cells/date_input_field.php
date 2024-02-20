<div class="form-group row <?= validation_show_error($name ?? '') ? 'has-warning' : '' ?>">
    <label for="<?= $id ?? null ?>" class="control-label col-sm-3">
        <?= $label ?? null ?>:
    </label>

    <div class="col-sm-9">
        <div class="input-group date" id="<?= $id ?? null ?>" data-target-input="nearest" data-toggle="datetimepicker">
            <div class="input-group-append" data-target="#<?= $id ?? null ?>">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            <input type="text" class="form-control datetimepicker-input" data-target="#<?= $id ?? null ?>"
                   name="<?= $name ?? null ?>"
                   value="<?= set_value($name ?? '', $defaultValue ?? null) ?>"
                <?= ($readonly ?? false) ? 'readonly' : '' ?>
            />
        </div>
        <span class="help-block"><?= validation_show_error($name ?? '') ?></span>
    </div>
</div>