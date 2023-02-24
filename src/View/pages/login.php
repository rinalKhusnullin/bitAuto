<?php
/**
 * @var $errors
 */
?>


<form class="auth" action="/login/" method="post">
	<h1 class="auth_title"> SIGN IN </h1>
	<?php if($errors):?>
		<?php foreach ($errors as $error) :?>
			<div class="error"><?= $error ?></div>
		<?php endforeach; ?>
	<?php endif; ?>
	<input required type="text" name="login" placeholder="Логин" class="login">
	<input required type="password" name="password" placeholder="Пароль" class="password">
	<button class="sign">Войти</button>
</form>