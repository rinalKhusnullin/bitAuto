<?php
/**
 * @var string $title
 * @var $content
 * @var array $tags
 * @var string $role
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
	<link rel="stylesheet" href="/styles/adaptive.css">
	<link rel="shortcut icon" href="/images/header/logo.ico" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200;300;400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
	<title><?= $title ?></title>
</head>

<body>
<header class="header">
	<div class="header__main-header">
		<div class="container">
			<div class="header__logo">
				<a href="/" class="header__logo-link">
					<img src="/images/header/logo.svg" alt="" class="header__logo-img">
				</a>
			</div>
			<div class="header__search">
				<form class="header__search-form" action="/" method="get"><!--get request to search into database-->
					<input class="header__search-input" type="text" name="search_query" placeholder="Введите название автомобиля">
					<button class="header__search-btn">
						<img src="/images/header/search-icon.svg" alt="search" class="header__search-icon">
					</button>
				</form>
			</div>
			<div class="header__address">
				<a href="https://yandex.ru/maps/org/bitriks24/1126159654/?ll=20.488308%2C54.719150&z=16.67"
				   class="header__address-link" target="_blank"> <!--link to yandex maps with bitrix24 -->
					<img src="/images/header/mark-map.svg" alt="" class="header__address-icon icon">
				</a>
				<p class="header__address-description">
					Калининград <br> Гостиная, 3
				</p>
			</div>
			<div class="header__contacts">
				<a href="tel:+78002501860" class="header__contacts-link"> <!-- bitrix24 tel -->
					<img src="/images/header/contacts.svg" alt="" class="header__contacts-icon icon">
				</a>
				<p class="header__contacts-description">
					8-800-250-18-60
				</p>
			</div>
			<?php if($role==='admin') : ?>
			<a href="/admin/" class="header__admin">Admin</a>
			<?php endif ?>
		</div>
	</div>
	<div class="header__side-header">
		<div class="container">
			<div class="mb__header-side">
				<a href="/" class="mb__header-logo">
					<img src="/images/header/logo.svg" alt="">
				</a>
				
			</div>
			<ul class="header__menu">
				<li class="header__menu-item"><a href="/" class="header__menu-link">Каталог</a>
				</li> <!--link to catalog -->
				<li class="header__menu-item">
					<div class="header__dropdown-menu">
						<a href="##" id="dropdown-btn" class="header__menu-link dropdown-btn undroped" onclick="dropdown(); return false">Категории</a>
						<div class="header__dropdown-tags di" id="dropdown-content">
							<?= \ES\Controller\TemplateEngine::view('components/tags', ['tags' => $tags]) ?>
						</div>
					</div>
				</li>
<!--				<li class="header__menu-item"><a href="/about-company/" class="header__menu-link">О компании</a>-->
				<li class="header__menu-item"><a href="/contacts/" class="header__menu-link">Контакты</a> 
				</li> 
			</ul>
			<a id="hamburger-btn" class="mb__hamburger-icon" onclick="ShowHamburger(); return false;">
				Меню
			</a>
			<div id="hamburger-content" class="mb__hamburger">
				<div class="hamburger__wrapper">
					<ul class="hamburger__items">
						<li class="hamburger__item">
							<a href="/" class="hamburger__link">Каталог</a>
						</li>
						<li class="hamburger__item">
							<a href="##" id="mb_dropdown" class="header__menu-link dropdown-btn undroped" onclick="mb_dropdown(); return false">Категории</a>
							<div class="header__dropdown-tags di" id="mb_dropdown-content">
								<?= \ES\Controller\TemplateEngine::view('components/tags', ['tags' => $tags]) ?>
							</div>
						</li>
						<li class="hamburger__item">
							<a href="/contacts/" class="hamburger__link">Контакты</a>
						</li>
					</ul>
				</div>
			</div>
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
<script>
	function ShowHamburger(){
		document.getElementById('hamburger-content').classList.toggle('visible');
	}

	function mb_dropdown(){
		document.getElementById("mb_dropdown-content").classList.toggle("visible");

    if (document.getElementById("mb_dropdown").classList.contains("droped")) 
    {
        document.getElementById("mb_dropdown").classList.remove('droped');
        document.getElementById("mb_dropdown").classList.add('undroped');
    }
    else if (document.getElementById("mb_dropdown").classList.contains("undroped")) 
    {
        document.getElementById("mb_dropdown").classList.remove('undroped');
        document.getElementById("mb_dropdown").classList.add('droped');
    } 
}


</script>
</body>

</html>