<?php
/**
 * @var $content
 */

use ES\Services\HtmlService;

?>
<?php if (!is_array($content)) : ?>
	<?= $content; ?>
<?php else: ?>
<?php foreach ($content as $items) : ?>
<?php if (is_object($items) || is_array($items)) : ?>
	<tr class="table-content">
	<?php foreach ($items as $key => $item) : ?>
		<?= HtmlService::renderAdminTable($key, $item) ?>
	<?php endforeach; ?>
			<td>
				<a class="change-btn" href="/admin/edit/<?= strtolower((new \ReflectionClass($items))->getShortName()) ?>s/<?= $items->id ?>/">Изменить</a>
			</td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>


