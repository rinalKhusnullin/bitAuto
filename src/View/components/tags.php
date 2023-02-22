<?php
	/**
	 * @var array $tags
	 */
	// @todo убрать этот рудимент
$brands = $tags['brand'];
$carceses = $tags['carcase'];
$transmissions = $tags['transmission'];
?>


<form action="/" method="get" class="dropdown__form di">
    <div class="dropdown__wraper di">
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">Марка</div>
            <?php foreach ($brands as $brand): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="brand_<?=$brand?>" type="radio" name="brand" value="<?=$brand?>">
                    <label class="dropdown__radio di" for="brand_<?=$brand?>"><?=$brand?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">Тип кузова</div>
            <?php foreach ($carceses as $carcase): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="carcase_<?=$carcase?>" type="radio" name="carcase" value="<?=$carcase?>">
                    <label class="dropdown__radio di" for="carcase_<?=$carcase?>"><?=$carcase?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">КПП</div>
            <?php foreach ($transmissions as $transmission): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="transmission_<?=$transmission?>" type="radio" name="transmission" value="<?=$transmission?>">
                    <label class="dropdown__radio di" for="transmission_<?=$transmission?>"><?=$transmission?></label>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <button type="submit" class="dropdown__btn">Найти</button>
</form>