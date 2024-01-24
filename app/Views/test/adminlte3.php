<?= $this->extend('layout/adminlte3') ?>

<?= $this->section('content') ?>

<!--<div class="box box-primary">-->
<!--    <div class="box-header with-border">-->
<!--        <h3 class="box-title">Settings</h3>-->
<!--    </div>-->
<!--    --><?php //= form_open(route_to('settings'), ['class' => "form-horizontal"]) ?>
<!--    <div class="box-body">-->
<!---->
<!--        --><?php ///** @var App\Models\CategoryModel[] $categories */ ?>
<!--        --><?php //if (!empty($settings)): ?>
<!--            --><?php //foreach ($settings as $index => $setting): ?>
<!--                --><?php //= view_cell(\App\Cells\InputFieldCell::class, [
//                    'label' => $index,
//                    'name' => $index,
//                    'defaultValue' => $setting
//                ]) ?>
<!--            --><?php //endforeach; ?>
<!--        --><?php //else: ?>
<!--            <tr>-->
<!--                <td colspan="3" class="text-center">No Settings Configured</td>-->
<!--            </tr>-->
<!--        --><?php //endif; ?>
<!--    </div>-->
<!---->
<!--    --><?php //= view_cell(\App\Cells\FormSubmitCell::class, [
//        'title' => 'Update',
//    ], 300) ?>
<!--    --><?php //= form_close() ?>
</div>

<?= $this->endSection() ?>
