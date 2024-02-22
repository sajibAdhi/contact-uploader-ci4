<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <!--<li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Starter Pages
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inactive Page</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>-->
        <li class="nav-item <?= menu_open(route_to('sms_service.import_csv'), route_to('sms_service.import_csv.upload')) ?>">
            <a href="#"
               class="nav-link <?= active_link(route_to('sms_service.import_csv'), route_to('sms_service.import_csv.upload')) ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Sms Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?= view_cell(\App\Cells\NavItemCell::class, [
                    'link' => route_to('sms_service.import_csv'),
                    'icon' => 'fas fa-th',
                    'title' => 'Data',
                ]) ?>
                <?= view_cell(\App\Cells\NavItemCell::class, [
                    'link' => route_to('sms_service.import_csv.upload'),
                    'icon' => 'fas fa-th',
                    'title' => 'Import Data',
                ]) ?>
            </ul>
        </li>


        <?= view_cell(\App\Cells\NavItemCell::class, [
            'link' => route_to('sms_service.category'),
            'icon' => 'fas fa-th',
            'title' => 'Categories',
        ]) ?>

        <?= view_cell(\App\Cells\NavItemCell::class, [
            'link' => route_to('sms_service.aggregator'),
            'icon' => 'fas fa-th',
            'title' => 'Aggregators',
        ]) ?>

    </ul>
</nav>