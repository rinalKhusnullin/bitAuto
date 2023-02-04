<?php
/**
 * @var $cars
 */
?>

<?php foreach ($cars as $car):?>
	<?= \ES\Controller\TemplateEngine::view('/components/product-card',$car->getData())?>
<?php endforeach?>

<?= $pagination ?>

