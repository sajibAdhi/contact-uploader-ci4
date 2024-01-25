<div class="card-footer">
    <?= view_cell('ButtonCell', ['title' => 'Cancel', 'type' => 'reset', 'class' => 'btn-secondary btn-sm'], 300) ?>
    <?= view_cell('ButtonCell', ['title' => $title ?? 'Submit', 'type' => 'submit', 'class' => 'btn-primary float-right btn-sm'], 300) ?>
</div>