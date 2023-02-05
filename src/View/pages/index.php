<?php
/**
 * @var $products
 */
?>

<?php foreach ($products as $product):?>
	<?= \ES\Controller\TemplateEngine::view('/Product/product-card',$product->getData())?>
<?php endforeach?>