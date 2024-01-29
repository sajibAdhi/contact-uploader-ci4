<?php
$title = $title ?? 'Button';
$type = $type ?? 'submit';
$class = $class ?? 'btn-default';
?>

<?= form_button(['type' => $type], $title, "class='btn $class'") ?>
