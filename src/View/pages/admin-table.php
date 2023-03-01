<?php
/**
 * @var $tableName
 * @var array $columns
 * @var $content
 * @var $pagination
 * @var string $deleteMessage
 * @var string $addItemLink
 */

use ES\Services\HtmlService;

if(is_array($columns))
{
?>
<?php if($deleteMessage):?>
	<?php foreach ($deleteMessage as $message) :?>
		<div><?= $message ?></div>
	<?php endforeach; ?>
<?php endif; ?>
<table>
	<caption><a href="/admin/add/<?=$addItemLink?>/" class="admin__add">Добавить новую строку <?= $tableName ?></a></caption>
	<tr class="columns">
		<?php foreach ($columns as $column):?>
			<?= HtmlService::renderColumn($column) ?>
		<?php endforeach; ?>
		<th class="td__change"></th>

	</tr>
		<?php } echo $content; ?>
</table>
<?= $pagination ?>