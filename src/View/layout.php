<?php
/**
 * @var string $title
 * @var $content
 */
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/styles/reset.css">
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="shortcut icon" href="/images/logo.ico" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200;300;400;500&display=swap" rel="stylesheet">
	<title><?= $title ?></title>
</head>

<body>
<header class="header">
	<div class="header__main-header">
		<div class="container">
			<div class="header__logo">
				<a href="/" class="header__logo-link"><!--link to main page-->
					<img src="/images/logo.svg" alt="" class="header__logo-img">
				</a>
			</div>
			<div class="header__search">
				<form class="header__search-form" action="/" method="get"><!--get request to search into database-->
					<input class="header__search-input" type="text" name="search_query" placeholder="Введите название автомобиля">
					<button class="header__search-btn">
						<img src="/images/search-icon.svg" alt="search" class="header__search-icon">
					</button>
				</form>
			</div>
			<div class="header__address">
				<a href="https://yandex.ru/maps/org/bitriks24/1126159654/?ll=20.488308%2C54.719150&z=16.67"
				   class="header__address-link" target="_blank"> <!--link to yandex maps with bitrix24 -->
					<img src="/images/mark-map.svg" alt="" class="header__address-icon icon">
				</a>
				<p class="header__address-description">
					Калининград <br> Гостиная, 3
				</p>
			</div>
			<div class="header__contacts">
				<a href="tel:+78002501860" class="header__contacts-link"> <!-- bitrix24 tel -->
					<img src="/images/contacts.svg" alt="" class="header__contacts-icon icon">
				</a>
				<p class="header__contacts-description">
					8-800-250-18-60
				</p>
			</div>
		</div>
	</div>
	<div class="header__side-header">
		<div class="container">
			<ul class="header__menu">
				<li class="header__menu-item"><a href="/" class="header__menu-link">Каталог</a>
				</li> <!--link to catalog -->
				<li class="header__menu-item">
					<div class="header__dropdown-menu">
						<a href="##" id="dropdown-btn" class="header__menu-link dropdown-btn undroped" onclick="dropdown(); return false">Марки автомобилей</a>
						<div class="header__dropdown-tags" id="dropdown-content">
							<a href="##" class="header__dropdown-link">Mazda</a> <!-- links to get products with need tag -->
							<a href="##" class="header__dropdown-link">Toyota</a>
							<a href="##" class="header__dropdown-link">Volkswagen</a>
							<a href="##" class="header__dropdown-link">BMW</a>
							<a href="##" class="header__dropdown-link">Tesla</a>
						</div>
					</div>
				</li>
				<li class="header__menu-item"><a href="/about-company" class="header__menu-link">О компании</a>
				<li class="header__menu-item"><a href="/contacts" class="header__menu-link">Контакты</a> 
				</li> 
			</ul>
		</div>
	</div>
</header>
<section class="main-content">
	<div class="container">

		<?= $content ?>

	</div>
</section>

<footer class="footer">
	<div class="container">
		<ul class="footer__info-list">
			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="/images/team/matvey-img.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a> <!--link to matvey vk -->
							<a href="#" class="info-item__link bitrix"></a> <!--link to matvey bitrix -->
						</div>
					</div>
					<h4 class="info-item__name">Матвей</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>
			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="/images/team/gleb-img.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a> <!--link to gleb vk -->
							<a href="#" class="info-item__link bitrix"></a> <!--link to gleb bitrix -->
						</div>
					</div>
					<h4 class="info-item__name">Глеб</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>
			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="/images/team/tatyana-img.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a> <!--link to tatyana vk -->
							<a href="#" class="info-item__link bitrix"></a> <!--link to tatyana bitrix -->
						</div>
					</div>
					<h4 class="info-item__name">Татьяна</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>
			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="/images/team/daniil-img.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a> <!--link to daniil vk -->
							<a href="#" class="info-item__link bitrix"></a> <!--link to daniil bitrix -->
						</div>
					</div>
					<h4 class="info-item__name">Даниил</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>
			<li class="footer__info-item">
				<div class="info-item__img">
					<img src="/images/team/rinal-img.png" alt="" class="info-item__icon">
				</div>
				<div class="info-item__description">
					<div class="info-item__socials">
						<div class="info-item__social">
							<a href="#" class="info-item__link vk"></a> <!--link to rinal vk -->
							<a href="#" class="info-item__link bitrix"></a> <!--link to rinal bitrix -->
						</div>
					</div>
					<h4 class="info-item__name">Риналь</h4>
					<div class="info-item__mail"></div>
				</div>
			</li>
		</ul>
		<div class="footer__team-info">
			<div class="footer__team-name">КОМНАДА2</div>
			<div class="footer__team-description">Разработка интернет-магазина</div>
		</div>
	</div>
</footer>

<script src="/scripts/dropdown.js"></script>
</body>

</html>