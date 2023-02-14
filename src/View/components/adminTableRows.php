<?php
/** @var $tegs
 * @var $content
 */
if (!is_array($content))
{
	echo $content;
}
else
{
foreach ($content as $items) {
	if (is_object($items)) { ?>
		<tr>
			<?php foreach ($items as $item) : ?>
			<td> <?= $item ?></td>
			<?php endforeach; ?>
			<td><a href="#">Изменить</a></td>
			<td><a href="#">Удалить</a></td>
		</tr>
	<?php }
}}

?>


