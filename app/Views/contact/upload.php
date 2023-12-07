<?= $this->extend('layout\app') ?>

<?= $this->section('styles') ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url() ?>bower_components/select2/dist/css/select2.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="box box-default">
    <form class="form-horizontal" action="<?= route_to('contact.upload') ?>" method="post"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="box-body">
            <div class="form-group row">
                <label for="category" class="control-label col-sm-3">Select a category:</label>
                <div class=" col-sm-9">
                    <select class="form-control select2" name="category" id="category">
                        <option value="">Select a Category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <input type="text" class="form-control col-sm-9" style="margin-top: 10px" name="category_name"
                           placeholder="Category Name">
                </div>
            </div>

            <div class="form-group row">
                <label for="contacts" class="control-label col-sm-3">Contacts CSV:</label>
                <div class=" col-sm-9">
                    <input type="file" class="form-control col-sm-9" name="contacts_file" id="contacts" accept=".csv">
                </div>
            </div>
        </div>

        <?= $this->include('components\form-submit') ?>
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
