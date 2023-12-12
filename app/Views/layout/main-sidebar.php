<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <?php //echo $this->include('layout\sidebar-user-panel') ?>

        <!-- search form (Optional) -->
        <?php //echo $this->include('layout\sidebar-search-form') ?>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>

            <!-- Category -->
            <li>
                <a href="<?= route_to('category.index') ?>">
                    <i class="fas fa-book"></i> <span>Category</span>
                </a>
            </li>

            <!-- Content -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-mobile"></i> <span>Content</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= route_to('contact.content.index') ?>">List</a></li>
                    <li><a href="<?= route_to('contact.content.upload') ?>">Upload Contact</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>