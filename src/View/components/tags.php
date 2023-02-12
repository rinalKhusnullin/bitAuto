<?php
	/**
	 * @var array $tags
	 */
$brands = $tags[0];
$carceses = $tags[1];
$transmissions = $tags[2];
?>


<form action="/" method="get" class="dropdown__form di">
    <div class="dropdown__wraper di">
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">Марка</div>
            <?php foreach ($brands as $brand): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="brand_<?=$brand['BRAND']?>" type="radio" name="brand" value="<?=$brand['BRAND']?>">
                    <label class="dropdown__radio di" for="brand_<?=$brand['BRAND']?>"><?=$brand['BRAND']?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">Тип кузова</div>
            <?php foreach ($carceses as $carcase): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="carcase_<?=$carcase['CARCASE']?>" type="radio" name="carcase" value="<?=$carcase['CARCASE']?>">
                    <label class="dropdown__radio di" for="carcase_<?=$carcase['CARCASE']?>"><?=$carcase['CARCASE']?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">КПП</div>
            <?php foreach ($transmissions as $transmission): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="transmission_<?=$transmission['TRANSMISSION']?>" type="radio" name="transmission" value="<?=$transmission['TRANSMISSION']?>">
                    <label class="dropdown__radio di" for="transmission_<?=$transmission['TRANSMISSION']?>"><?=$transmission['TRANSMISSION']?></label>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <button type="submit" class="dropdown__btn">Найти</button>
</form>