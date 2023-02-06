<?php
/**
 * @var $products
 * @var $pagination
 */
?>
<div class="product-card__container">
	<?php foreach ($products as $product):?>
		<?= \ES\Controller\TemplateEngine::view('/Product/product-card',$product->getProductCarcase())?>
	<?php endforeach?>
</div>

<?= $pagination ?>

