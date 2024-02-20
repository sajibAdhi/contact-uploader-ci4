<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <!-- product dashboard -->
        <?= view_cell(\App\Cells\NavItemCell::class, [
            'name' => 'Products',
            'link' => route_to('product'),
            'icon' => 'fa-th'
        ]) ?>

        <!-- product create -->
        <?= view_cell(\App\Cells\NavItemCell::class, [
            'name' => 'Create',
            'link' => route_to('product.create'),
            'icon' => 'fa-plus-square'
        ]) ?>

        <!-- product upload -->
        <?= view_cell(\App\Cells\NavItemCell::class, [
            'name' => 'Upload',
            'link' => route_to('product.upload'),
            'icon' => 'fa-upload'
        ]) ?>
    </ul>
</nav>