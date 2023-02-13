<?php
/** @var $content
 * @var array $columns

 */
var_dump($columns); die;
?>

<table>
	<caption> Редактирование продукции</caption>
	<tr>
		<?php foreach ($columns as $column): ?>
		<th><?=$column?></th>
		<?php endforeach ?>

		<th class="td__change"></th>
		<th class="td__delete"> </th>
	</tr>
	<tr>

		<td><a href="#" class="td__change" >Изменить </a></td>
		<td><a href="#" class="td__delete" >Удалить </a></td>
	</tr>
</table>