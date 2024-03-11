<?= $this->extend('layout/app') ?>


<?= $this->section('pageStyles') ?>
<?= load_select2_styles() ?>
<?= load_datatable_styles() ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>
<!-- Filter Form card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contacts Filter</h3>

        <!-- contacts card tool-->
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Filter Form -->
        <div class="row">
            <!-- category -->
            <div class="form-group col-sm-4">
                <label for="categories">Category</label>
                <select name="categories[]" id="categories" class="form-control selectTwo" multiple
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
                <th>No</th>
                <th>Contact</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>


<?= $this->section('pageScripts') ?>

<?= load_select2_scripts() ?>
<?= load_datatable_scripts() ?>

<?= initialize_select2() ?>

<!-- datatable serverside -->
<script>
    <!-- datatable serverside -->
    $(function () {
        let categories = $('#categories');

        let table = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": `<?= route_to('sms_service.contact.index_datatable')?>`,
                "type": "GET",
                "data": {
                    categories: () => categories.val(),
                }
            },
            order: [],
            columns:
                [
                    {data: "no", orderable: false},
                    {data: "number"},
                    {data: "category_name"}
                ]
        });

        table.buttons().container().appendTo('#datatable' + '_wrapper .col-md-6:eq(0)');


        categories.change(function () {
            table.ajax.reload();
        });
    });
</script>


<!-- Contacts Filter State-->
<script>
    $(function () {
        let categories = $('#categories');
        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);
        console.log(params.get('categories'));
        if (params.has('categories')) {
            let selectedCategories = params.get('categories').split(',');
            categories.val(selectedCategories).trigger('change');
        }
    });
</script>
<?= $this->endSection() ?>
