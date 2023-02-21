<!DOCTYPE html>
<html lang="ru">
<?php
/**
 * @var string $title
 * @var $content
 * @var array $columns
 * @var $role
 */

?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/styles/reset.css">
	<link rel="stylesheet" href="/styles/adminPanelStyle.css">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>
<nav class="nav">
	<p>Панель управления</p>
	<ul>
		<li class="nav_li"><a href="/admin/?products">Продукция</a></li>
		<li class="nav_li"><a href="/admin/?orders">Заказы</a></li>
		<li class="nav_li"><a href="/admin/?users">Пользователи</a></li>
		<li class="nav_li"><a href="/admin/?brands">Бренд</a></li>
		<li class="nav_li"><a href="/admin/?carcases">Кузов</a></li>
		<li class="nav_li"><a href="/admin/?transmissions">КПП</a></li>
	</ul>
</nav>
<div class="wrapper">
	<header class="header">

		<label class="user-info">
			<span>Пользователь: <?=$role?> </span> <!-- Имя пользователя -->
			<a href="/" target="_blank">На сайт</a>
			<a href="/logout/">Logout</a>

		</label>
	</header>
	<div class="container">
		<?= $content ?>
	</div>
</div>
<script src="/scripts/hideShowPassword.js"></script>
</body>
</html>
