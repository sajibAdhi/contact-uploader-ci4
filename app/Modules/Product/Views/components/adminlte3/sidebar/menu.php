<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <!--
        <li class="nav-item">
            <a href="<?php //= route_to('operator_bill.index') ?>"
               class="nav-link <?php //= active_link(route_to('operator_bill.index') . '/test') ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
        -->


        <!--        --><?php //= view_cell(\App\Cells\NavItemCell::class, ['navName' => 'Dashboard', 'path' => route_to('operator_bill.index') . '/test'])?>

        <!-- operator_bill dashboard -->
        <li class="nav-item">
            <a href="<?= route_to('operator_bill.index') ?>"
               class="nav-link <?= active_link(route_to('operator_bill.index')) ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= route_to('operator_bill.create') ?>"
               class="nav-link <?= active_link(route_to('operator_bill.create')) ?>">
                <i class="nav-icon fas fa-plus-square"></i>
                <p>Create</p>
            </a>
        </li>

        <li class="nav-item <?= menu_open(route_to('operator_bill.operator.index'), route_to('operator_bill.operator.create')) ?>">
            <a href="#"
               class="nav-link <?= active_link(
                   route_to('operator_bill.operator.index'),
                   route_to('operator_bill.operator.create'),
               ) ?>"
            >
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Operator
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= route_to('operator_bill.operator.index') ?>"
                       class="nav-link <?= active_link(route_to('operator_bill.operator.index')) ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= route_to('operator_bill.operator.create') ?>"
                       class="nav-link <?= active_link(route_to('operator_bill.operator.create')) ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>