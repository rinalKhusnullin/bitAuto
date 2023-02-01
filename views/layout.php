<?php
/**
 * @var string $title
 * @var $content
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/reset.css">
	<link rel="stylesheet" href="styles/style.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200;300;400;500&display=swap" rel="stylesheet">
	<title><?= $title?></title>
</head>

<body>
<header class="header">
	<div class="header__main-header">
		<div class="container">
			<div class="header__logo">
				<a href="/" class="header__logo-link">
					<!--ссылка на главную-->
					<img src="images/logo.svg" alt="" class="header__logo-img">
				</a>
			</div>
			<div class="header__search">
				<form class="header__search-form" action="/" method="get">
					<!--TODO get запрос для взятия из БД-->
					<input class="header__search-input" type="text" name="search_query">
					<button class="header__search-btn"><img src="images/search-icon.svg" alt=""
															class="header__search-icon"></button>
					<!--TODO изображение лупы в поисковую строку-->
				</form>
			</div>
			<div class="header__address">
				<a href="#" class="header__address-link">
					<img src="images/mark-map.svg" alt="" class="header__address-icon icon">
					<!-- TODO Изображение адресов-->
				</a>
				<!--TODO ссылка на адресса -->
			</div>
			<div class="header__contacts">
				<a href="" class="header__contacts-link">
					<img src="images/contacts.svg" alt="" class="header__contacts-icon icon">
					<!-- TODO иконка корзины -->
				</a>
			</div>
		</div>
	</div>
	<div class="header__side-header">
		<div class="container">
			<ul class="header__menu">
				<li class="header__menu-item"><a href="#" class="header__menu-link">О компании</a></li>
				<li class="header__menu-item"><a href="#" class="header__menu-link">Бренды</a></li>
				<li class="header__menu-item"><a href="#" class="header__menu-link">Тэги</a></li>
				<li class="header__menu-item active"><a href="#" class="header__menu-link">Спецпредложения</a></li>
				<li class="header__menu-item"><a href="#" class="header__menu-link">Контакты</a></li>
			</ul>
		</div>
	</div>
</header>
<section class="main-content">
	<?= $content /** Part for base content*/ ?>
</section>
<footer class="footer">
	<div class="container">
		<ul class="footer__info-list">

			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="images/user-picture.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a>
							<a href="#" class="info-item__link bitrix"></a>
						</div>
					</div>
					<h4 class="info-item__name">Матвей</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>

			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="images/user-picture.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a>
							<a href="#" class="info-item__link bitrix"></a>
						</div>
					</div>
					<h4 class="info-item__name">Глеб</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>

			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="images/user-picture.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a>
							<a href="#" class="info-item__link bitrix"></a>
						</div>
					</div>
					<h4 class="info-item__name">Татьяна</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>

			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="images/user-picture.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a>
							<a href="#" class="info-item__link bitrix"></a>
						</div>
					</div>
					<h4 class="info-item__name">Даниил</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>
			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="images/user-picture.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a>
							<a href="#" class="info-item__link bitrix"></a>
						</div>
					</div>
					<h4 class="info-item__name">Риналь</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>

		</ul>
	</div>
</footer>
</body>

</html>