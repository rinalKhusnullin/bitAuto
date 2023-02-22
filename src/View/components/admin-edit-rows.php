<?php
/** @var $tegs
 * @var $content
 * @var $className
 */
?>

<tr>
	<form action = "" method="POST">
		<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' // @TODO прокидывать ?>">
		<input type="hidden" name="item" value="<?= $className // @TODO переименовать $tableName ?>">
			<?php  foreach ($content as $key => $item) :  ?>
				<td> <?= ES\HtmlService::getHtmlTag($key, $item) ?> </td>
			<?php endforeach; ?>
		<td><button type="submit">Сохранить</button></td>
	</form>
	<?php if (is_object($content)): ?>
	<td>
		<form action="/admin/edit/delete/" method="POST">
			<input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' // @TODO прокидывать ?>">
			<input type="hidden" name="table" value="<?= $className // @TODO переименовать $tableName ?>">
			<input type="hidden" name="id" value="<?= $content->id?>">
			<input type="submit" value="удалить">
		</form>
	</td>
	<?php endif; ?>
</tr>






