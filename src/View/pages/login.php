<?php
/**
 * @var $errors
 */
?>


<form action="/login/" method="post">
	<?php if($errors):?>
		<?php foreach ($errors as $error) :?>
			<div><?= $error?></div>
		<?php endforeach; ?>
	<?php endif; ?>
	<input required type="text" name="login" placeholder="login">
	<input required type="password" name="password" placeholder="password">
	<button>Sign in</button>
</form>