<?= $this->extend('layout/app') ?>

<?= $this->section('styles') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contacts Contents</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered table-striped dataTable">
            <thead>
            <tr>
                <th>Contact</th>
                <th>Category</th>
                <th>Content</th>
                <th>Remarks</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var \App\Models\Contact[] $contacts */ ?>
            <?php if (empty($contacts)): ?>
                <tr>
                    <td colspan="3" class="text-center">No contacts found</td>
                </tr>
            <?php else: ?>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->number ?></td>
                        <td><?= $contact->category_name ?></td>
                        <td><?= $contact->content ?></td>
                        <td><?= $contact->remarks ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Contact</th>
                <th>Category</th>
                <th>Content</th>
                <th>Remarks</th>
            </tr>
            </tfoot>

        </table>
        <?= $pager->links('default', 'bootstrap4') ?>
    </div>
    <!-- /.box-body -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- DataTables -->
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(function () {
        $('.dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['print'],
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': false,
            'info': false,
            'autoWidth': true,
        });
    })
</script>
<?= $this->endSection() ?>
