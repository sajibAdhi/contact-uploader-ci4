<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Settings</h3>
    </div>
    <?= form_open(route_to('settings'), ['class' => "form-horizontal"]) ?>
    <div class="box-body">

        <?php /** @var App\Models\CategoryModel[] $categories */ ?>
        <?php if (!empty($settings)): ?>
            <?php foreach ($settings as $index => $setting): ?>
                <?= view_cell(\App\Cells\InputFieldCell::class, [
                    'label' => $index,
                    'name' => $index,
                    'defaultValue' => $setting
                ]) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">No Settings Configured</td>
            </tr>
        <?php endif; ?>
    </div>

    <?= view_cell(\App\Cells\FormSubmitCell::class, [
        'title' => 'Update',
    ], 300) ?>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
