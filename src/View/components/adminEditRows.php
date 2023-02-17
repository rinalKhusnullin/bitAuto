<?php
/** @var $tegs
 * @var $content
 */
?>

<tr>
	<form action = "" method="POST">
		<input type="hidden" name="item" value="<?=(new \ReflectionClass($content))->getShortName();?>">
		<?php  foreach ($content as $key => $item) :  ?>
			<td> <?= ES\HtmlService::getHtmlTag($key, $item) ?> </td>
		<?php endforeach; ?>
		<td><button type="submit">Сохранить</button></td>
	</form>
	<td>
		<a href="/admin/edit/delete/?<?= array_key_first($_GET)?>=<?= $content->id?>">удалить</a>
	</td>
</tr>






