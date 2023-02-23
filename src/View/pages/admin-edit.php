<?php
/**
 * @var $tableName
 * @var array $columns
 * @var $content
 * @var int $len
 * @var $className
 */
if (is_array($columns))
{
?>
<table>
	<caption> <?= $tableName ?> </caption>
	<tbody class="tbody_edit">
		<form action = "" method="POST">
		<?php for($i=0;$i<$len;$i++):?>
			<tr class="tr_edit">
				<th class="th_edit"><?= $columns[$i] ?></th>
				<input type="hidden" name="item" value="<?= $className ?>">
				<td class="td_edit"> <?= ES\HtmlService::getHtmlTag($columns[$i], $content[$columns[$i]]) ?> </td>
			</tr>
				<?php endfor;?>
			<tr class="tr_edit">
			<th class="th_edit"></th>
			<td class="td_edit"><button type="submit">Сохранить</button></td>
			</tr>
			<?php if (is_object($content)): ?>
				<td>
					<a href="/admin/edit/delete/?<?= array_key_first($_GET)?>=<?= $content->id?>">удалить</a>
				</td>
			<?php endif; }?>
		</form>
	</tbody>
</table>