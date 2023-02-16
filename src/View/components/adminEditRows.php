<?php
/** @var $tegs
 * @var $content
 */
?>

<tr>
	<?php
	// echo '<pre>';
	// var_dump($tegs);
	// var_dump($content);
	?>
	<?php  foreach ($content as $key => $item) :  ?>
		<td> <?= ES\HtmlService::getHtmlTag($key, $item) ?> </td>
	<?php endforeach; ?>
	<td><a href="#">Сохранить</a></td>
	<td>
		<a href="/admin/edit/delete/?<?= array_key_first($_GET)?>=<?= $content->id?>">удалить</a>
	</td>
</tr>






