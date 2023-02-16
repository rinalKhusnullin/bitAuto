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
		<form action="" method="post">
			<input type="hidden" name="id" value="<?=$content->id?>">
			<input type="hidden" name="table-name" value="products">
			<button>Удалить</button>
		</form>
	</td>
</tr>






