<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>

    <div class="card">
        <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => 'Products']) ?>

        <div class="card-body">
            <a href="<?= route_to('product.create') ?>" class="btn btn-primary mb-3">Create</a>
            <div class="row">
                <?php if (empty($products)): ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                No products found
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product->name ?></h5>
                                    <img src="<?= $product->qrcode ?>" alt="Barcode Image">
                                    <?= view_cell('\App\Cells\ActionButtonCell::edit', ['href' => route_to('product.edit', $product->id)]) ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>