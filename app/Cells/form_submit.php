<div class="card-footer">
    <?= view_cell('ButtonCell', ['title' => 'Cancel', 'type' => 'reset', 'class' => 'btn-secondary'], 300) ?>
    <?= view_cell('ButtonCell', ['title' => $title ?? 'Submit', 'type' => 'submit', 'class' => 'btn-primary float-right'], 300) ?>
</div>