<?php
    $currentPage = 666; // Текущая страница, веселья ради сделал на 666
    $countPage = 1000; // Сколько всего страниц
?>

<div class="pagination">
    <?php if ($countPage <= 9):?>

        <?php for ($i = 1; $i <= $countPage; $i++):?>
            <a href='##' class='pagination__item <?= ($i === $currentPage) ? "active-page-link" : "" ?>'>
                <?= $i ?>
            </a>     
        <?php endfor ?>

    <?php else: ?>

        <?php if ($currentPage >= 7 && $currentPage <= $countPage - 6): ?>

            <a href='##' class='pagination__item'> 1 </a>
            <span class='pagination__item-dots'> ... </span>

            <?php for ($i = -2; $i <= 2; $i++): ?>
                <?php $different = $i + $currentPage; ?>
                <a href='##' class='pagination__item <?= ($different === $currentPage) ? "active-page-link" : "" ?>'>
                    <?= $different ?>
                </a>
            <?php endfor ?>
            <span class='pagination__item-dots'> ... </span>
            <a href='##' class='pagination__item'>
                <?= $countPage ?>
            </a>

        <?php elseif ($currentPage <= 6): ?>

            <?php for ($i = 1; $i <= 7; $i++): ?>
                <a href='##' class='pagination__item <?= ($i === $currentPage) ? "active-page-link" : "" ?>'>
                    <?= $i ?>
                </a>
            <?php endfor ?>
            <span class='pagination__item-dots'> ... </span>
            <a href='##' class='pagination__item'>
                <?= $countPage ?>
            </a>

        <?php elseif ($currentPage > $countPage - 6): ?>

            <a href='##' class='pagination__item'> 1 </a>
            <span class='pagination__item-dots'> ... </span>
            <?php for ($i = $countPage - 6; $i <= $countPage; $i++):?>
                <a href='##' class='pagination__item <?= ($i === $currentPage) ? "active-page-link" : "" ?>'>
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        <?php endif; ?>
    <?php endif; ?>
</div> 