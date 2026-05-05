<?php

/**
 * Custom Bootstrap 4 Pagination Template for CI4
 * 
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="Navigasi halaman paket umroh">
    <ul class="pagination justify-content-center mb-0">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="Halaman pertama">
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Sebelumnya">
                    <i class="fa fa-angle-left"></i> Sebelumnya
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link"><i class="fa fa-angle-double-left"></i></span>
            </li>
            <li class="page-item disabled">
                <span class="page-link"><i class="fa fa-angle-left"></i> Sebelumnya</span>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Selanjutnya">
                    Selanjutnya <i class="fa fa-angle-right"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Halaman terakhir">
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link">Selanjutnya <i class="fa fa-angle-right"></i></span>
            </li>
            <li class="page-item disabled">
                <span class="page-link"><i class="fa fa-angle-double-right"></i></span>
            </li>
        <?php endif; ?>
    </ul>
</nav>
