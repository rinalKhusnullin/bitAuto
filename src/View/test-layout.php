<?php
/**
 * @var $var1
 * @var array $values
 */
?>

<div>
	<?= $var1?>
	<section>
		<?php foreach($values as $value):?>
			<?= $value?>
		<?php endforeach;?>
	</section>
</div>
