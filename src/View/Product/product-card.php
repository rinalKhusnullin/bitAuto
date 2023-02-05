<?php
/**
 * @var int $id ,
 * @var string $brand ,
 * @var string $title ,
 * @var string $carcaseType ,
 * @var string $transmission ,
 * @var int $price
 */
?>

<div class="product-card">
	<div class="product-card__img-block">
		<img src="/tmp-autoimg/auto-id-<?= $id ?>.png" alt="" class="product-card__img">
	</div>
	<div class="product-card__description">
		<h2 class="product-card__title">
			<a href="/" class="product-card__hlink"><?= $title ?></a> <!-- link to detailed page -->
		</h2> 
		<!-- chr - its characteristics -->
		<ul class="product-card__chr-list">
			<li class="product-card__chr">
				<div class="product-card__chr-title">Марка</div>
				<div class="product-card__chr-value"><?= $brand ?></div>
			</li>

			<li class="product-card__chr">
				<div class="product-card__chr-title">Тип кузова</div>
				<div class="product-card__chr-value"><?= $carcaseType ?></div>
			</li>

			<li class="product-card__chr">
				<div class="product-card__chr-title">КПП</div>
				<div class="product-card__chr-value"><?= $transmission ?></div>
			</li>
			<li class="product-card__chr">
				<div class="product-card__chr-title">Цена</div>
				<div class="product-card__chr-value"><?= $price ?></div>
			</li>
		</ul>
		<a href="/product" class="product-card__more">Подробнее</a> <!-- generate new product detailed page with id -->
	</div>
</div>