<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?= $this->include('components/adminlte3/sidebar/brand-logo') ?>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- Sidebar user panel (optional) -->
        <!--        --><?php //= $this->include('components/adminlte3/sidebar/user-panel')?>

        <!-- SidebarSearch Form -->
        <!--        --><?php //= $this->include('components/adminlte3/sidebar/search-form')?>

        <!-- Sidebar Menu -->
        <?php if (strpos(current_url(), base_url() . 'operator_bills') === 0) : ?>
            <?= $this->include('App\\Modules\\OperatorBill\Views\components\adminlte3\sidebar\menu'); ?>
        <?php elseif (strpos(current_url(), base_url() . 'products') === 0): ?>
            <?= $this->include('App\\Modules\\Product\\Views\\components\\adminlte3\\sidebar\\menu'); ?>
        <?php else: ?>
            <?= $this->include('components/adminlte3/sidebar/menu') ?>
        <?php endif; ?>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>