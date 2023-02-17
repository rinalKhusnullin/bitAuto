<?php
/**
 * @var array $columns
 * @var $content
 * @var $pagination
 */
if(is_array($columns))
{
?>
<table>
	<caption><h1> Редактирование </h1></caption>
	<tr>
		<?php foreach ($columns as $column) {?>
		<th><?= $column?></th>
		<?php } ?>
		<th class="td__change"></th>

	</tr>
		<?php } echo $content; ?>
</table>
<?= $pagination ?>