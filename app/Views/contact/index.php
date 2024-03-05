<?= $this->extend('layout/app') ?>


<?= $this->section('pageStyles') ?>
<?= load_select2_styles() ?>
<?= load_datatable_styles() ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>
<!-- Filter Form card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contacts Contents Search</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Filter Form -->
        <form action="<?= route_to('contact.content.index') ?>" method="GET">
            <div class="row">
                <!-- category -->
                <div class="form-group col-sm-4">
                    <label for="category">Category</label>
                    <select name="categories[]" id="category" class="form-control selectTwo" multiple
                            data-placeholder="Select a Category"
                            style="width: 100%;">
                        <option value="all" <?= set_select('categories', 'all', true) ?> >
                            All
                        </option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('categories', $category->id) ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

            </div> <!-- /.row -->

            <?= view_cell(\App\Cells\ButtonCell::class, ['title' => 'Search', 'class' => 'btn-primary pull-right']) ?>

        </form>
        <!-- /.Filter Form -->
    </div>
    <!-- /.card-body -->
</div>

<!-- Contact Content Table card-->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contacts</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="datatable" class="table table-sm table-hover table-bordered">
            <thead>
            <tr>
                <th>Contact</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var App\Models\ContactModel[] $contacts */ ?>
            <?php if (empty($contacts)): ?>
                <tr>
                    <td colspan="5" class="text-center">No data found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->number ?></td>
                        <td><?= $contact->category_name ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
            </tbody>
        </table>
        <br>
        <?php if (!empty($pager)): ?>
            <?php
            $thisPageStart = $pager->getPerPage() * $pager->getCurrentPage() - $pager->getPerPage() + 1;
            $thisPageEnd = $pager->getPerPage() * $pager->getCurrentPage();
            ?>
            <div class="d-flex justify-content-between">
                <div>
                    Showing <?= $thisPageStart ?> to <?= $thisPageEnd ?> of <?= $pager->getTotal() ?> Entries
                </div>
                <div>
                    <?= $pager->links('default', 'bootstrap4') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>


<?= $this->section('pageScripts') ?>

<?= load_select2_scripts() ?>
<?= load_datatable_scripts() ?>

<?= initialize_select2() ?>
<?php //= initialize_datatable('datatable', [
//    // off page length
//    'lengthMenu' => [10, 25, 50, 100],
//]) ?>
<?= $this->endSection() ?>
