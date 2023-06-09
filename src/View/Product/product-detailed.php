<?php
/**
 * @var int $id
 * @var int $price
 * @var string $brandType
 * @var string $title
 * @var string $carcaseType
 * @var string $transmission
 * @var string $fullDesc
 * @var string $slider
 * @var string $mainImage
 */
?>
<div class="product-detailed__">
    <div class="product-detailed__main">
        <h1 class="product-detailed__main-title"> <?= htmlspecialchars($title) ?> </h1>
    </div>
    <div class="product-detailed">
        <div class="product-detailed__img">
            <div class="product-detailed__slider"><?= $slider?></div>
            <h2 class="product-detailed__subtitle">Характеристики</h2>
            <div class="product-detailed__subdescription">
                <ul class="product-detailed__characteristics">
                    <li class="product-detailed__characteristic">
                        <div class="product-detailed__name">Марка</div>
                        <div class="product-detailed__underline"></div>
                        <div class="product-detailed__value"><?= htmlspecialchars($brandType) ?></div>
                    </li>
                    <li class="product-detailed__characteristic">
                        <div class="product-detailed__name">Тип кузова</div>
                        <div class="product-detailed__underline"></div>
                        <div class="product-detailed__value"> <?= htmlspecialchars($carcaseType) ?> </div>
                    </li>
                    <li class="product-detailed__characteristic">
                        <div class="product-detailed__name">КПП</div>
                        <div class="product-detailed__underline"></div>
                        <div class="product-detailed__value"> <?= htmlspecialchars($transmissionType) ?> </div>
                    </li>
                </ul>
            </div>
            <div class="product-detailed__price">
                <div class="product-detailed__price-title">Цена</div>
                <div class="product-detailed__underline"></div>
                <div class="product-detailed__price-value"><?= htmlspecialchars($price) ?> &#8381</div>
            </div>
            <button id="buy-btn" onclick="PopUpShow();" class="product-detailed__buy-btn">Купить</button>
        </div>
        <div class="product-detailed__description">
            <h2 class="product-detailed__subtitle">Описание</h2>
            <div class="product-detailed__subdescription"> <?= htmlspecialchars($fullDesc) ?>
            </div>
        </div>
    </div>
</div>
<div class="popup" id="popup">
    <div class="popup__content">
        <div class="poppup__main-title">
            <h1 class="poppup__title">Форма заказа</h1>
            <button class="popup__exit" onclick="PopUpHide();">✖</button>
        </div>
        <div class="poppup__container">

            <div class="poppup__product-info">
                <div class="poppup__img">
                    <img src="/uploads/main/<?= $mainImage ?>" alt="<?= htmlspecialchars($title) ?>">
                </div>
                <h2 class="poppup__product-name"><?= htmlspecialchars($title) ?></h2>
                <div class="poppup__price">
                    <div class="poppup__price-title">Цена</div>
                    <div class="product-detailed__underline"></div>
                    <div class="poppup__price-value"><?= htmlspecialchars($price) ?> &#8381</div>
                </div>
            </div>

            <form class="poppup__form" name="orderForm" onsubmit="return orderValidate();" action="" method="post"> <!-- need to add handler -->

                <div class="poppup__subtitle">ФИО*</div>
                <input id='name_input' type="text" class="poppup__input" name="userFullname" required>
                <div id='name_error' class="poppup__error"><?= (!empty($errors['name'])) ? $errors['name'] : '' ?></div>

                <div class="poppup__subtitle">Телефон*</div>
                <input id="tel" type="tel" class="poppup__input" name="userTel" data-phone-pattern data-phone-clear = "false" required>
                <div id='tel_error' class="poppup__error"> <?= (!empty($errors['numberPhone'])) ? $errors['numberPhone'] : '' ?> </div>

                <div class="poppup__subtitle">Email*</div>
                <input type="email" class="poppup__input" name="userEmail" required>
                <div id='email_error' class="poppup__error"> <?= (!empty($errors['email'])) ? $errors['email'] : '' ?> </div>

                <div class="poppup__subtitle">Адрес*</div>
                <input type="text" class="poppup__input" name="userAddress" required>
                <div id='address_error' class="poppup__error"> <?= (!empty($errors['address'])) ? $errors['address'] : '' ?> </div>

                <div class="poppup__subtitle">Пожелания к заказу</div>
                <textarea type="textarea" class="poppup__input big-input" name="userComment"></textarea>
                <button type="submit" class="poppup__input send-btn">Оформить заказ</button>
            </form>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<script src="/scripts/orderValidate.js"></script>
<script src="/scripts/phoneMask.js"></script>
<script>
    function PopUpShow() {
        $("#popup").show();
    }

    function PopUpHide() {
        $("#popup").hide();
    }
</script>
<?php if (!empty($errors)) : ?>
    <script> 
        $("#popup").show();
    </script>
<?php endif ?>