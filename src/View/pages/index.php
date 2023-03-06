<?php
/**
 * @var $products
 * @var $pagination
 * @var $emptyProduct
 */
?>
<?php if($emptyProduct):?>
<div class="product-not-found">
	<div class="order-status__img">
		<img src="/images/order-status/failed.jpg" alt="" srcset="">
	</div>
	<div class="order-status__desc-block">
		<div class="order-status__title"><?= $products[0]?> :(</div>
	</div>
</div>
<?php return; endif;?>

<div class="product-card__container">
	<?php foreach ($products as $product):?>
		<?= \ES\Services\TemplateEngine::view('/product/product-card', (array)$product)?>
	<?php endforeach?>
</div>

<?= $pagination ?>

