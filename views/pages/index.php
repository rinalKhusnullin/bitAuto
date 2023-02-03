<?php
/**
 * @var $cars
 */
?>

<?php foreach ($cars as $car):?>
	<?= \ES\View\TemplateEngine::view('/components/product-card',$car->getData())?>
<?php endforeach?>

