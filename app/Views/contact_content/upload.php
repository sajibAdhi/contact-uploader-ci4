<?= $this->extend('layout/app') ?>

<?= $this->section('styles') ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url() ?>bower_components/select2/dist/css/select2.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Contact Content Upload Form</h3>
    </div>
    <form class="form-horizontal" action="<?= route_to('contact.content.upload') ?>" method="post"
          enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="box-body">
            <!-- Category -->
            <div class="form-group <?= validation_show_error('category') ? 'has-warning' : '' ?>">
                <label for="category" class="control-label col-sm-3">Select a category:</label>
                <div class=" col-sm-9">
                    <select class="form-control select2" name="category" id="category" style="width: 100%">
                        <option value="">Select a Category</option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('category', $category->id) ?>>
                                    <?= $category->name ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <span class="help-block"><?= validation_show_error('category') ?></span>
                </div>
            </div>

            <!-- Category Name -->
            <div class="form-group <?= validation_show_error('category_name') ? 'has-warning' : '' ?>">
                <label for="category_name" class="col-sm-3"></label>
                <div class=" col-sm-9">
                    <input type="text" class="form-control col-sm-9" name="category_name" id="category_name"
                           value="<?= set_value('category_name') ?>" placeholder="Category Name">
                    <span class="help-block"><?= validation_show_error('category_name') ?></span>
                </div>
            </div>

            <!-- Contacts File -->
            <div class="form-group <?= validation_show_error('contacts_file') ? 'has-warning' : '' ?>">
                <label for="contacts" class="control-label col-sm-3">Contacts CSV:</label>
                <div class=" col-sm-9">
                    <input type="file" class="form-control col-sm-9 " name="contacts_file" id="contacts"
                           accept=".csv,.xls,.xlsx" required>
                    <span class="help-block"><?= validation_show_error('contacts_file') ?></span>
                </div>
            </div>
        </div>

        <?= view_cell('FormSubmitCell', [], 300) ?>
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
