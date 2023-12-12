<?= $this->extend('layout/app') ?>

<?= $this->section('styles') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Categories</h3>
    </div>
    <form class="form-horizontal" action="<?= route_to('category.store') ?>" method="post"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="box-body">
            <!-- Category -->
            <div class="form-group <?= validation_show_error('category') ? 'has-warning' : '' ?>">
                <label for="category" class="control-label col-sm-3">
                    Category: <span class="text-danger">*</span>
                </label>
                <div class=" col-sm-9">
                    <input type="text" class="form-control col-sm-9" name="category" id="category"
                           value="<?= set_value('category') ?>" placeholder="Category Name">
                    <span class="help-block"><?= validation_show_error('category') ?></span>
                </div>
            </div>
        </div>

        <?= $this->include('components/form-submit') ?>
    </form>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Select2 -->
<script src="<?= base_url('bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
//Initialize Select2 Elements
<script>
    $('.select2').select2()
</script>
<?= $this->endSection() ?>
