<?= $this->extend('layout/app') ?>

<?php helper('adminlte3'); ?>


<?= $this->section('styles') ?>
<!-- DataTables -->
<?= load_datatable_styles() ?>
<?= $this->endSection() ?>


<?= $this->section('pageScripts') ?>
<!-- DataTables -->
<?= load_datatable_scripts() ?>

<?= initialize_datatable('') ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>
<?= $this->endSection() ?>
