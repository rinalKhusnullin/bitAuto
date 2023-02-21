<?php
/**
 * @var $tableName
 * @var array $columns
 * @var $content
 * @var $pagination
 * @var string $deleteMessage
 */

if(is_array($columns))
{
?>
<?php if($deleteMessage):?>
	<?php foreach ($deleteMessage as $message) :?>
		<div><?= $message?></div>
	<?php endforeach; ?>
<?php endif; ?>
<table>
	<caption><a href="/admin/add?" class="admin__add">Добавить новую строку <?= $tableName ?></a></caption>
	<tr>
		<?php foreach ($columns as $column) {?>
		<th><?= $column?></th>
		<?php } ?>
		<th class="td__change"></th>

	</tr>
		<?php } echo $content; ?>
</table>
<?= $pagination ?>