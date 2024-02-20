<li class="nav-item">
    <a href="<?= $link ?? null ?>"
       class="nav-link <?= active_link($path ?? null) ?>">
        <i class="nav-icon fas fa-plus-square"></i>
        <p><?= $menu ?? null ?> ;;;;;</p>
    </a>
</li>

<!--<li class="nav-item --><?php //= menu_open(route_to('operator_bill.operator.index') . '/test', route_to('operator_bill.operator.create'),) ?><!--">-->
<!--    <a href="#"-->
<!--       class="nav-link --><?php //= active_link(
//           route_to('operator_bill.operator.index') . '/test',
//           route_to('operator_bill.operator.create'),
//       ) ?><!--"-->
<!--    >-->
<!--        <i class="nav-icon fas fa-tachometer-alt"></i>-->
<!--        <p>-->
<!--            Operator-->
<!--            <i class="right fas fa-angle-left"></i>-->
<!--        </p>-->
<!--    </a>-->
<!--    <ul class="nav nav-treeview">-->
<!--        <li class="nav-item">-->
<!--            <a href="--><?php //= route_to('operator_bill.operator.index') . '/test' ?><!--"-->
<!--               class="nav-link --><?php //= active_link(route_to('operator_bill.operator.index') . '/test') ?><!--">-->
<!--                <i class="far fa-circle nav-icon"></i>-->
<!--                <p>List</p>-->
<!--            </a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a href="--><?php //= route_to('operator_bill.operator.create') ?><!--"-->
<!--               class="nav-link --><?php //= active_link(route_to('operator_bill.operator.create')) ?><!--">-->
<!--                <i class="far fa-circle nav-icon"></i>-->
<!--                <p>Create</p>-->
<!--            </a>-->
<!--        </li>-->
<!--    </ul>-->
<!--</li>-->
