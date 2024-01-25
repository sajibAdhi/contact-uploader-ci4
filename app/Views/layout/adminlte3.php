<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?? \App\Constants\ApplicationConstant::SHORT_NAME ?>|<?= \App\Constants\ApplicationConstant::NAME ?>
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-----------------------------
    | Application Page Style Here |
    ------------------------------>
    <?= $this->renderSection('styles') ?>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Preloader -->
    <!--    --><?php //= $this->include('components/adminlte3/preloader')?>

    <!-- Navbar -->
    <?= $this->include('components/adminlte3/navbar') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('components/adminlte3/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?= $this->include('components/adminlte3/content-header') ?>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <!-------------------------------
                | Application Page Content Here |
                -------------------------------->
                <?= $this->renderSection('content') ?>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <!--    --><?php ////= $this->include('components/adminlte3/control-sidebar')?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->include('components/adminlte3/footer') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url() ?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-----------------------------
    | Application Page Scripts Here |
    ------------------------------>
<?= $this->renderSection('scripts') ?>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
