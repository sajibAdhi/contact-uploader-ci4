<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Operator Bills</li>

    <li>
        <a href="<?= route_to('operator_bill.index') ?>">
            <i class="fa fa-book"></i> <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="<?= route_to('operator_bill.create') ?>">
            <i class="fa fa-book"></i> <span>Create</span>
        </a>
    </li>

    <!-- Content -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i> <span>Operator</span>
            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= route_to('operator_bill.operator.index') ?>">List</a></li>
            <li><a href="<?= route_to('operator_bill.operator.upload') ?>">Add</a></li>
        </ul>
    </li>


</ul>