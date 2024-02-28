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
        <?= $this->include('App\\Modules\\OperatorBill\Views\components\adminlte3\sidebar\menu'); ?>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>