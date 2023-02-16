<!DOCTYPE html>
<html lang="ru">
<?php
/**
 * @var string $title
 * @var $content
 * @var array $columns
 */

?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/styles/reset.css">
	<link rel="stylesheet" href="/styles/adminPanelStyle.css">
	<title><?= $title ?></title>
</head>

<body>
<nav class="nav">
	<p>Панель управления</p>
	<ul>
		<li class="nav_li"><a href="/admin/?product">Продукция</a></li>
		<li class="nav_li"><a href="/admin/?order">Заказы</a></li>
		<li class="nav_li"><a href="/admin/?user">Пользователи</a></li>
		<li class="nav_li"><a href="/admin/?brand">Бренд</a></li>
		<li class="nav_li"><a href="/admin/?carcase">Кузов</a></li>
		<li class="nav_li"><a href="/admin/?transmission">КПП</a></li>
		<li class="nav_li"><a href="/admin/?config">Конфигурация</a></li>
	</ul>
</nav>
<div class="wrapper">
	<header class="header">
		<label class="search">
			<input type="search" placeholder="Поиск по названию">
			<input type="button" value="Искать">
		</label>
		<label class="user-info">
			<span>Пользователь: admin</span> <!-- Имя пользователя -->
			<a href="/" target="_blank">На сайт</a>
			<a href="/logout/">Logout</a>

		</label>
	</header>
	<div class="container">
		<?= $content ?>
	</div>
</div>
</body>
</html>
