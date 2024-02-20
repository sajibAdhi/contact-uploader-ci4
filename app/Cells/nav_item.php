<li class="nav-item">
    <a href="<?= $link ?? null ?>"
       class="nav-link <?= !empty($link) ? active_link($link) : null ?>">
        <i class="nav-icon fas <?= $icon ?? 'fa-circle' ?> "></i>
        <p><?= $name ?? null ?></p>
    </a>
</li>