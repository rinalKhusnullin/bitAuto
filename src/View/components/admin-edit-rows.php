<?php
/** @var $tegs
 * @var $content
 * @var $className
 */
?>

<tr>
	<form action = "" method="POST">
		<input type="hidden" name="item" value="<?= $className ?>">
		<?php  foreach ($content as $key => $item) :  ?>
			<td> <?= ES\HtmlService::getHtmlTag($key, $item) ?> </td>
		<?php endforeach; ?>
		<td><button type="submit">Сохранить</button></td>
	</form>
	<?php if (is_object($content)): ?>
	<td>
		<a href="/admin/edit/delete/?<?= array_key_first($_GET)?>=<?= $content->id?>">удалить</a>
	</td>
	<?php endif; ?>
</tr>






