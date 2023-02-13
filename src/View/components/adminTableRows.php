<?php
/** @var $content */
foreach ($content as $items) {
	if (is_object($items)) { ?>
		<tr>
			<?php foreach ($items as $item) : ?>
			<td> <?= $item ?></td>
			<?php endforeach; ?>
			<td><a href="#">Изменить</a></td>
			<td><a href="#">Удалить</a></td>
		</tr>
	<?php }
}

?>


