<?php 
/**
 * @var Product $car
 */
?>

<div class="product-card">
    <div class="product-card__img-block">
        <img src="tmp-autoimg/auto-id-<?=$car->id?>.png" alt="" class="product-card__img">
    </div>
    <div class="product-card__description">
        <h2 class="product-card__title"><a href="/product/id/<?=$car->id?>" class="product-card__hlink"><?= $car->title?></a></h2> <!-- link to detailed page -->
        <!-- chr - its characteristics -->
        <ul class="product-card__chr-list">
            <li class="product-card__chr">
                <div class="product-card__chr-title">Марка</div>
                <div class="product-card__chr-value"><?= $car->brand ?></div>
            </li>

            <li class="product-card__chr">
                <div class="product-card__chr-title">Тип кузова</div>
                <div class="product-card__chr-value"><?= $car->carcaseType ?></div>
            </li>

            <li class="product-card__chr">
                <div class="product-card__chr-title">КПП</div>
                <div class="product-card__chr-value"><?= $car->transmission?></div>
            </li>
            <li class="product-card__chr">
                <div class="product-card__chr-title">Цена</div>
                <div class="product-card__chr-value"><?= $car->price?></div>
            </li>
        </ul>
        <a href="#" class="product-card__more">Купить</a> <!-- generate new product detailed page with id -->
    </div>
</div>