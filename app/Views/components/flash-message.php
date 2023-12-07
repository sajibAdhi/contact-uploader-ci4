<!-- Success Message -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success" >
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Error Message -->
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Warning Message -->
<?php if(session()->getFlashdata('warning')): ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('warning') ?>
    </div>
<?php endif; ?>