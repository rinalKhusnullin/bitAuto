<?php
/**
 * @var $tableName
 * @var array $columns
 * @var $content
 * @var int $len
 * @var $className
 * @var bool $isAdd
 */
?>

<?php if(count($content) <= 1):?>
	<div><?= $content[0]?></div>
<?php return; endif;?>

<form action="" method="POST">
	<table class="edit_table">
		<caption class="edit_caption"> <?= $tableName ?> </caption>
		<tbody class="tbody_edit">

		<input type="hidden" name="item" value="<?= $className ?>">
		<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
		<?php  for ($i = 0; $i < $len; $i++): ?>
			<tr class="tr_edit">
				<th class="th_edit"><?= $columns[$i] ?></th>

				<td class="td_edit"> <?= \ES\Services\HtmlService::getHtmlTag($columns[$i], $content[$columns[$i]], $content["mainImage"]??'') ?> </td>
			</tr>
		<?php endfor; ?>
		<tr class="tr_edit">
			<th class="th_edit"></th>
			<td class="td_edit">
				<button class="save-btn" type="submit" onclick="return editValidate();">Сохранить</button>
			</td>
		</tr>

		</tbody>
	</table>
</form>

<?php if(!$isAdd):?>
<table class="delete-table">
	<tbody class="tbody_edit">
	<tr class="tr_edit">
		<th class="th_edit"></th>
		<td class="td_edit">
			<form action="/admin/edit/delete/" method="POST">
				<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
				<input type="hidden" name="table" value="<?= $className ?>">
				<input type="hidden" name="id" value="<?= $content['id'] ?>">
				<input class="delete-btn" type="submit" value="Удалить">
			</form>
		</td>
	</tr>
	</tbody>
</table>
<?php endif;?>