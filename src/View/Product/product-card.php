<?php
/**
 * @var int $Id ,
 * @var string $Brand ,
 * @var string $Name ,
 * @var string $Carcase ,
 * @var string $Transmission ,
 * @var int $Price
 */
?>

<div class="product-card">
	<div class="product-card__img-block">
		<img src="/tmp-autoimg/auto-id-<?= $Id ?>.png" alt="" class="product-card__img">
	</div>
	<div class="product-card__description">
		<h2 class="product-card__title">
			<a href="/" class="product-card__hlink"><?= $Name ?></a> <!-- link to detailed page -->
		</h2> 
		<!-- chr - its characteristics -->
		<ul class="product-card__chr-list">
			<li class="product-card__chr">
				<div class="product-card__chr-title">Марка</div>
				<div class="product-card__chr-value"><?= $Brand ?></div>
			</li>

			<li class="product-card__chr">
				<div class="product-card__chr-title">Тип кузова</div>
				<div class="product-card__chr-value"><?= $Carcase ?></div>
			</li>

			<li class="product-card__chr">
				<div class="product-card__chr-title">КПП</div>
				<div class="product-card__chr-value"><?= $Transmission ?></div>
			</li>
			<li class="product-card__chr">
				<div class="product-card__chr-title">Цена</div>
				<div class="product-card__chr-value"><?= $Price ?></div>
			</li>
		</ul>
		<a href="/product" class="product-card__more">Подробнее</a> <!-- generate new product detailed page with id -->
	</div>
</div>