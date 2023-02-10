<!DOCTYPE html>
<html lang="ru">
<?php
/**
 * @var string $title
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
		<li class="nav_li-active"><a href="#">Продукция</a></li>
		<li class="nav_li"><a href="#">Заказы</a></li>
		<li class="nav_li"><a href="#">Пользователи</a></li>
		<li class="nav_li"><a href="#">Категории</a></li>
		<li class="nav_li"><a href="#">Конфигурация</a></li>
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
		<table>
			<caption> Редактирование продукции</caption>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>BRAND</th>
				<th>PRICE</th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td>1</td>
				<td>MAZDA 3</td>
				<td>MAZDA</td>
				<td>200000</td>
				<td class="td__change"><a href="#">Изменить</a></td>
				<td class="td__delete"><a href="#">Удалить</a></td>
			</tr>
		</table>
	</container>
</wrapper>
</body>

