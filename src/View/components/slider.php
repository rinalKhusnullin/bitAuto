<?php
/** 
 * @var int $id
 */
?>
<div class="swiper">
    <div class="swiper-wrapper">
        <?php for ($i = 1; $i < 4; $i++): ?>
            <div class="swiper-slide">
                <img src="/tmp-autoimg/<?="$id/$i"?>.png" alt="">
            </div>
        <?php endfor ?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<script src="/scripts/slider.js"></script>