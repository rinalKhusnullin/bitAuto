<?php
/** @var $tegs
 * @var $content
 */
?>

<tr>
	<?php  foreach ($content as $key => $item) :  ?>
		<td> <?= ES\HtmlService::getHtmlTag($key, $item); ?> </td>
	<?php endforeach; ?>
	<td><a href="#">Сохранить</a></td>
	<td><a href="#">Удалить</a></td>
</tr>





