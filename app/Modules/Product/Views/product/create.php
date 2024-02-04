<?= $this->extend('layout/app') ?>

<?= $this->section('main') ?>
    <div class="card card-default">
        <?= view_cell(\App\Cells\CardHeaderCell::class, ['title' => "Create Product"]) ?>

        <?= form_open(route_to('product.store'), ['class' => 'form-horizontal']) ?>

        <div class="card-body">
            <div class="form-group <?= validation_show_error('name') ? 'has-error' : '' ?>">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="<?= old('name') ?>">
                <?php if (validation_show_error('name')): ?>
                    <span class="help-block
                        <?= validation_show_error('name') ? 'has-error' : '' ?>">
                            <?= $validation->getError('name') ?>
                        </span>

                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('price') ? 'has-error' : '' ?>">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control"
                       value="<?= old('price') ?>">
                <?php if (validation_show_error('price')): ?>
                    <span class="help-block
                        <?= validation_show_error('price') ? 'has-error' : '' ?>">
                            <?= $validation->getError('price') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('description') ? 'has-error' : '' ?>">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"
                          rows="5"><?= old('description') ?></textarea>
                <?php if (validation_show_error('description')): ?>
                    <span class="help-block
                        <?= validation_show_error('description') ? 'has-error' : '' ?>">
                            <?= $validation->getError('description') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('image') ? 'has-error' : '' ?>">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php if (validation_show_error('image')): ?>
                    <span class="help-block
                        <?= validation_show_error('image') ? 'has-error' : '' ?>">
                            <?= $validation->getError('image') ?>
                        </span>
                <?php endif; ?>
            </div>

            <div class="form-group <?= validation_show_error('status') ? 'has-error' : '' ?>">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Select a status</option>
                    <option value="active"
                        <?= old('status') == 'active' ? 'selected' : '' ?>>
                        Active
                    </option>
                    <option value="inactive"
                        <?= old('status') == 'inactive' ? 'selected' : '' ?>>
                        Inactive
                    </option>
                </select>
                <?php if (validation_show_error('status')): ?>
                    <span class="help-block
                        <?= validation_show_error('status') ? 'has-error' : '' ?>">
                            <?= $validation->getError('status') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('quantity') ? 'has-error' : '' ?>">
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" id="quantity" class="form-control"
                       value="<?= old('quantity') ?>">
                <?php if (validation_show_error('quantity')): ?>
                    <span class="help-block
                        <?= validation_show_error('quantity') ? 'has-error' : '' ?>">
                            <?= $validation->getError('quantity') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('sku') ? 'has-error' : '' ?>">
                <label for="sku">SKU</label>
                <input type="text" name="sku" id="sku" class="form-control"
                       value="<?= old('sku') ?>">
                <?php if (validation_show_error('sku')): ?>
                    <span class="help-block
                        <?= validation_show_error('sku') ? 'has-error' : '' ?>">
                            <?= $validation->getError('sku') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('barcode') ? 'has-error' : '' ?>">
                <label for="barcode">Barcode</label>
                <input type="text" name="barcode" id="barcode" class="form-control"
                       value="<?= old('barcode') ?>">
                <?php if (validation_show_error('barcode')): ?>
                    <span class="help-block
                        <?= validation_show_error('barcode') ? 'has-error' : '' ?>">
                            <?= $validation->getError('barcode') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('weight') ? 'has-error' : '' ?>">
                <label for="weight">Weight</label>
                <input type="text" name="weight" id="weight" class="form-control"
                       value="<?= old('weight') ?>">
                <?php if (validation_show_error('weight')): ?>
                    <span class="help-block
                        <?= validation_show_error('weight') ? 'has-error' : '' ?>">
                            <?= $validation->getError('weight') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('length') ? 'has-error' : '' ?>">
                <label for="length">Length</label>
                <input type="text" name="length" id="length" class="form-control"
                       value="<?= old('length') ?>">
                <?php if (validation_show_error('length')): ?>
                    <span class="help-block
                        <?= validation_show_error('length') ? 'has-error' : '' ?>">
                            <?= $validation->getError('length') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('width') ? 'has-error' : '' ?>">
                <label for="width">Width</label>
                <input type="text" name="width" id="width" class="form-control"
                       value="<?= old('width') ?>">
                <?php if (validation_show_error('width')): ?>
                    <span class="help-block
                        <?= validation_show_error('width') ? 'has-error' : '' ?>">
                            <?= $validation->getError('width') ?>
                        </span>
                <?php endif; ?>
            </div>
            <div class="form-group
                <?= validation_show_error('height') ? 'has-error' : '' ?>">
                <label for="height">Height</label>
                <input type="text" name="height" id="height" class="form-control"
                       value="<?= old('height') ?>">
                <?php if (validation_show_error('height')): ?>
                    <span class="help-block
                        <?= validation_show_error('height') ? 'has-error' : '' ?>">
                            <?= $validation->getError('height') ?>
                        </span>
                <?php endif; ?>
            </div>
        </div>

        <?= view_cell(\App\Cells\FormSubmitCell::class) ?>

        <?= form_close() ?>
    </div>

<?= $this->endSection() ?>