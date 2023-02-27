<?php
/**
 * @var int $id
 * @var array $images
 */
?>
<div class="swiper">
	<div class="swiper-wrapper">
		<?php foreach ($images as $image): ?>
			<div class="swiper-slide">
				<img src="/uploads/main/<?= $image ?>" alt="">
			</div>
		<?php endforeach; ?>
	</div>
	<div class="swiper-pagination"></div>
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
</div>
<script src="/scripts/slider.js"></script>