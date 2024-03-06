<?= $this->extend('layout/app') ?>

<?= $this->section('pageStyles') ?>
<?= load_select2_styles() ?>
<?= load_datepicker_styles() ?>
<?= load_datatable_styles() ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<!-- Filter Form card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Search</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Filter Form -->
        <form action="<?= base_url(route_to('sms_service.import_data')) ?>" autocomplete="off">
            <div class="row">

                <!-- category -->
                <div class="form-group col-sm-4">
                    <label for="category">Category</label>
                    <select name="to_contact_categories[]" id="to_contact_categories" class="form-control selectTwo"
                            multiple
                            data-placeholder="Select a Category"
                            style="width: 100%;">
                        <option value="all" <?= set_select('to_contact_categories', 'all', true) ?> >
                            All
                        </option>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= set_select('to_contact_categories', $category->id) ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <!-- Date range -->
                <div class="form-group col-sm-4">
                    <label for="daterange">Date range:</label>

                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control float-right date-range-picker" name="daterange"
                               value="<?= set_value('daterange') ?>">
                    </div>
                    <!-- /.input group -->
                </div>

                <!-- limit -->
                <div class="form-group col-sm-4">
                    <label for="limit">Limit</label>
                    <?= form_dropdown(
                        'limit',
                        [
                            '' => 'Default',
                            '10' => '10',
                            '25' => '25',
                            '50' => '50',
                            '100' => '100',
                            '200' => '200',
                            '500' => '500',
                            '1000' => '1000',
                            '5000' => '5000',
                        ],
                        set_value('limit', ''),
                        "class='form-control selectTwo' width='100%'"
                    ) ?>
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
        <h3 class="card-title">Contacts Contents</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="datatable1" class="table table-sm table-hover table-bordered">
            <thead>
            <tr>
                <th>Aggregator</th>
                <th>Operator</th>
                <th>Form</th>
                <th>To</th>
                <th>ToCategory</th>
                <th>Date</th>
                <th>Status</th>
                <th>Content</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var App\Models\ContactContentModel[] $contacts */ ?>
            <?php if (empty($contactContents)): ?>
                <tr>
                    <td colspan="7" class="text-center">No data found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contactContents as $contactContent): ?>
                    <tr>
                        <td><?= $contactContent->aggregator_name ?></td>
                        <td><?= $contactContent->operator_name ?></td>
                        <td><?= $contactContent->from_number ?></td>
                        <td><?= $contactContent->to_number ?></td>
                        <td><?= $contactContent->to_number_category ?></td>
                        <td><?= $contactContent->date ?></td>
                        <td><?= $contactContent->status ?></td>
                        <td><?= $contactContent->content ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Aggregator</th>
                <th>Operator</th>
                <th>Form</th>
                <th>To</th>
                <th>Date</th>
                <th>Status</th>
                <th>Content</th>
            </tr>
            </tfoot>
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
<?= load_datepicker_scripts() ?>
<?= load_datatable_scripts() ?>

<?= initialize_select2('.selectTwo') ?>
<?= initialize_date_range_picker('.date-range-picker',) ?>
<?= $this->endSection() ?>
