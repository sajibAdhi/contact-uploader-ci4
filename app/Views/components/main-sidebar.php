<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <?php // echo $this->include('layout\sidebar-user-panel')?>

        <!-- search form (Optional) -->
        <?php // echo $this->include('layout\sidebar-search-form')?>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <!-- if the url is base_url/operator_bills then include the 'OperatorBill\Views\components\main-sidebar-menu' -->

        <?php if (strpos(current_url(), base_url() . 'operator_bills') === 0) : ?>
            <?= $this->include('OperatorBill\Views\components\main-sidebar-menu'); ?>
        <?php else: ?>
            <?= $this->include('components/main-sidebar-menu'); ?>
        <?php endif; ?>

        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>