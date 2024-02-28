<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>

    <div class="card">
        <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => 'Products']) ?>

        <div class="card-body">
            <div class="d-flex justify-content-around">
                <a href="<?= route_to('product.create') ?>" class="btn btn-primary mb-3">Create</a>
                <a href="<?= route_to('product.upload') ?>" class="btn btn-primary mb-3">Upload</a>
            </div>
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>QRCode</th>
                </tr>
                </thead>
                <tbody>

                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="4">No products found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product->name ?></td>
                            <td><?= $product->description ?></td>
                            <td>
                                <img style="width: 100px" class="img-responsive img-bordered-sm"
                                     src="<?= $product->qrcode ?>" alt="qrcode">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>
<?= $this->endSection() ?>