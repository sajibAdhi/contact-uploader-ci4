<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <img src="<?= base_url('dist/img/avatar5.png') ?>" class="user-image" alt="<?= auth()->user()->username ?? '{{username}}' ?>">
        <!-- hidden-xs hides the username ?? '{{username}}' on small devices so only the image appears. -->
        <span class="hidden-xs"><?= auth()->user()->username ?? '{{username}}' ?></span>
    </a>
    <ul class="dropdown-menu">

        <!-- The user image in the menu -->
        <li class="user-header">
            <img src="<?= base_url('dist/img/avatar5.png') ?>" class="img-circle" alt="<?= auth()->user()->username ?? '{{username}}' ?>">

            <p>
                <?= auth()->user()->username ?? '{{username}}' ?> - {{ Designation}}
                <small>Member since <?= date('M, Y', strtotime(auth()->user()->created_at)) ?></small>
            </p>
        </li>

        <!-- Menu Body -->
        <?php // echo $this->include('components/header-navbar-right-user-menu-body')?>

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <a href="<?= route_to('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>

    </ul>
</li>