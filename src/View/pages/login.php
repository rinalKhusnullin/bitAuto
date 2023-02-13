<?php
/**
 * @var $errors
 */

?>


<form action="/login/" method="post">
	<?php if($errors):?>
		<div>
			<?=$errors[0]?>
		</div>
	<?php endif; ?>
	<input required type="text" name="login" placeholder="login">
	<input required type="password" name="password" placeholder="password">
	<button>Sign in</button>
</form>