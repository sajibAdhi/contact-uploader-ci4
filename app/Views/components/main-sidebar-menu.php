<ul class="sidebar-menu" data-widget="tree">
    <li class="header">HEADER</li>

    <!-- Category -->
    <li>
        <a href="<?= route_to('category.index') ?>">
            <i class="fa fa-book"></i> <span>Categories</span>
        </a>
    </li>

    <!-- aggregators -->
    <li>
        <a href="<?= route_to('aggregator.index') ?>">
            <i class="fa fa-book"></i>
            <span>Aggregators</span>
        </a>
    </li>

    <!-- Content -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope"></i> <span>Content</span>
            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= route_to('contact.content.index') ?>">List</a></li>
            <li><a href="<?= route_to('contact.content.upload') ?>">Upload Contact</a></li>
        </ul>
    </li>

    <!-- SETTING -->
    <li>
        <a href="<?= base_url(route_to('settings')) ?>">
            <i class="fa fa-gears"></i> <span>Settings</span>
        </a>
    </li>
</ul>