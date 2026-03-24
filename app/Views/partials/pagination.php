<?php
/**
 * Pagination partial
 * @var array  $pagination  {current_page, last_page, total, per_page}
 * @var string $baseUrl
 */
$pagination = $pagination ?? [];
$baseUrl    = $baseUrl ?? '';
$current    = $pagination['current_page'] ?? 1;
$last       = $pagination['last_page'] ?? 1;

if ($last <= 1) return;
?>
<div class="pagination-area mt-60 d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            <?php if ($current > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= e($baseUrl . '?page=' . ($current - 1)) ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = max(1, $current - 2); $i <= min($last, $current + 2); $i++): ?>
                <li class="page-item <?= $i === $current ? 'active' : '' ?>">
                    <a class="page-link" href="<?= e($baseUrl . '?page=' . $i) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($current < $last): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= e($baseUrl . '?page=' . ($current + 1)) ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
