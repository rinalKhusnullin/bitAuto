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
		<li class="nav_li"><a href="/admin/?products">Продукция</a></li>
		<li class="nav_li"><a href="/admin/?orders">Заказы</a></li>
		<li class="nav_li"><a href="/admin/?users">Пользователи</a></li>
		<li class="nav_li"><a href="/admin/?brands">Бренд</a></li>
		<li class="nav_li"><a href="/admin/?carcases">Кузов</a></li>
		<li class="nav_li"><a href="/admin/?transmissions">КПП</a></li>
		<li class="nav_li"><a href="/admin/?config">Конфигурация</a></li>
	</ul>
</nav>
<wrapper>
	<header class="header">
		<label class="search">
			<input type="search" placeholder="Поиск по названию">
			<input type="button" value="Искать">
		</label>
		<label class="user-info">
			<span>Пользователь: admin</span> <!-- Имя пользователя -->
			<input type="button" value="На сайт" href="#">
			<input type="button" value="Logout" href="#">
		</label>
	</header>
	<container>
		<?= $content ?>
	</container>
</wrapper>
</body>
<html>
