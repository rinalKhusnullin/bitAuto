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
	<form action="" method="POST">
<table>
	<caption> <?= $tableName ?> </caption>
	<tbody class="tbody_edit">

			<input type="hidden" name="item" value="<?= $className ?>">
			<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
		<?php for($i=0;$i<$len;$i++):?>
			<tr class="tr_edit">
				<th class="th_edit"><?= $columns[$i] ?></th>

				<td class="td_edit"> <?= ES\HtmlService::getHtmlTag($columns[$i], $content[$columns[$i]]) ?> </td>
			</tr>
				<?php endfor;?>
			<tr class="tr_edit">
				<th class="th_edit"></th>
				<td class="td_edit"><button type="submit">Сохранить</button></td>
			</tr>

		</tbody>
	</table>
</form>


	<table>
		<tbody class="tbody_edit">
			<tr class="tr_edit">
				<th class="th_edit"></th>
				<td class="td_edit">
					<form action="/admin/edit/delete/" method="POST">
						<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
						<input type="hidden" name="table" value="<?= $className?>">
						<input type="hidden" name="id" value="<?= $content['id']?>">
						<input type="submit" value="удалить">
					</form>
				</td>
			</tr>
		</tbody>
	</table>

<?php }?>