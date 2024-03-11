<?= $this->extend('layout/app') ?>


<?= $this->section('pageStyles') ?>
<?= load_select2_styles() ?>
<?= load_datatable_styles() ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>
<!-- Contacts Filer -->
<div class="card" id="contactsFilter">
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
        <!-- category -->
        <div class="form-group row">
            <label for="categories" class="col-sm-4">Category</label>
            <div class="col-sm-8">
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
            "responsive": true,

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": `<?= route_to('sms_service.contact.index_datatable')?>`,
                "type": "GET",
                "data": {
                    categories: () => categories.val(),
                }
            },
            "order": [
                [1, "desc"]
            ],
            "columns":
                [
                    {data: "no", orderable: false},
                    {data: "number"},
                    {data: "category_name"}
                ],
            lengthMenu: [
                [10, 25, 50, 100, 1000, 5000, -1],
                [10, 25, 50, 100, 1000, 5000, 'Show all']
            ],
            "dom": 'Blfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        table.buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');


        categories.change(function () {
            // Change the URL without reloading the page
            let newUrl = `<?= route_to('sms_service.contact.index')?>?categories=${categories.val().join(',')}`;
            history.pushState({}, '', newUrl);

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

        if (params.has('categories')) {
            let selectedCategories = params.get('categories').split(',');
            categories.val(selectedCategories).trigger('change');
        }
    });
</script>

<!-- contactsFilter Collapse with localstorage-->
<script>
    $(function () {
        let contactsFilter = $('#contactsFilter');
        let contactsFilterState = localStorage.getItem('contactsFilterState');
        if (contactsFilterState === 'collapsed') {
            contactsFilter.find('.card-tools button').click();
        }
        contactsFilter.on('collapsed.lte.cardwidget', function () {
            localStorage.setItem('contactsFilterState', 'collapsed');
        });
        contactsFilter.on('expanded.lte.cardwidget', function () {
            localStorage.setItem('contactsFilterState', 'expanded');
        });
    });
</script>
<?= $this->endSection() ?>
