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
        <?= view_cell(\App\Cells\NavItemCell::class, [
            'link' => route_to('sms_service.dashboard'),
            'icon' => 'fas fa-tachometer-alt',
            'title' => 'Dashboard',
        ]) ?>

        <li class="nav-item <?= menu_open(route_to('sms_service.import_data'), route_to('sms_service.import_data.upload')) ?>">
            <a href="#"
               class="nav-link <?= active_link(route_to('sms_service.import_data'), route_to('sms_service.import_data.upload')) ?>">
                <i class="nav-icon fas fa-sms"></i>
                <p>
                    Sms Service
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?= view_cell(\App\Cells\NavItemCell::class, [
                    'link' => route_to('sms_service.import_data'),
                    'icon' => 'fas fa-database',
                    'title' => 'Data',
                ]) ?>
                <?= view_cell(\App\Cells\NavItemCell::class, [
                    'link' => route_to('sms_service.import_data.upload'),
                    'icon' => 'fas fa-file-import',
                    'title' => 'Import Data',
                ]) ?>
            </ul>
        </li>

        <?= view_cell(\App\Cells\NavItemCell::class, [
            'link' => route_to('sms_service.contact'),
            'icon' => 'fas fa-address-book',
            'title' => 'Contacts',
        ]) ?>

        <?= view_cell(\App\Cells\NavItemCell::class, [
            'link' => route_to('sms_service.category'),
            'icon' => 'fas fa-list',
            'title' => 'Categories',
        ]) ?>

        <?= view_cell(\App\Cells\NavItemCell::class, [
            'link' => route_to('sms_service.aggregator'),
            'icon' => 'fas fa-project-diagram',
            'title' => 'Aggregators',
        ]) ?>

    </ul>
</nav>