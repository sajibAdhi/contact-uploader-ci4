<?= $this->extend('layout/app') ?>


<?= $this->section('pageStyles') ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>
<!--Dashboard Ui-->
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => 'Welcome to the dashboard']) ?>
        </div>
    </div>
</div>

<?php if (empty($dashboardData)): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                No data found
            </div>
        </div>
    </div>
<?php else: ?>
    <!--Dashboard components of total category and their total numbers capsule -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Categories</span>
                    <span class="info-box-number">
                        <?= $dashboardData->totalCategories ?>
                        <small>Categories</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Contacts</span>
                    <span class="info-box-number"><?= $dashboardData->totalContacts ?>
                        <small>Contacts</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <!--Dashboard components of each category and their total numbers small-box random color -->
    <div class="row">
        <?php if (!empty($dashboardData->categories)): ?>
            <?php foreach ($dashboardData->categories as $category): ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="small-box bg-<?= ($category->contacts_count < 1) ? 'light' : 'success' ?>">
                        <div class="inner">
                            <h3><?= $category->contacts_count ?></h3>
                            <p><?= $category->name ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <?php if ($category->contacts_count > 0) : ?>
                            <a href="<?= route_to('sms_service.contact') . "?categories=$category->id" ?>"
                               class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                        <?php else: ?>
<!--                            <a href="--><?php //= route_to('sms_service.contact') ?><!--" class="small-box-footer">No contacts <i-->
<!--                                        class="fas fa-arrow-circle-right"></i></a>-->
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<!-- Card gradiant Calender -->

<?= $this->endSection() ?>


<?= $this->section('pageStyles') ?>
<?= $this->endSection() ?>
