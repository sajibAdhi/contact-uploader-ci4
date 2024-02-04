<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <!-- product dashboard -->
        <li class="nav-item">
            <a href="<?= route_to('product') ?>"
               class="nav-link <?= active_link(route_to('product')) ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('product.create') ?>"
               class="nav-link <?= active_link(route_to('product.create')) ?>">
                <i class="nav-icon fas fa-plus-square"></i>
                <p>Create</p>
            </a>
        </li>
    </ul>
</nav>