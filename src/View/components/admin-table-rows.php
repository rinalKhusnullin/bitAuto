<?php
/** @var $tegs
 * @var $content
 */
?>
<?php if (!is_array($content)) : ?>
	<?= $content; ?>
<?php else: ?>
	<?php foreach ($content as $items) :  ?>
		<?php if (is_object($items) || is_array($items)) : ?>
			<tr>
				<?php foreach ($items as $key => $item) :  ?>
				<td> <?= $key==='password' ? 'Скрыт' :$item ?> </td>
				<?php endforeach; ?>
				<td><a href="/admin/edit/?<?= strtolower((new \ReflectionClass($items))->getShortName())?>=<?= $items->id?>">Изменить</a></td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>


