<?php
/**
 * @var $products
 * @var $pagination
 */
?>

<?php foreach ($products as $product):?>
	<?= \ES\Controller\TemplateEngine::view('/Product/product-card',$product->getData())?>
<?php endforeach?>

<?= $pagination ?>

