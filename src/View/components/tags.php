<?php
	/**
	 * @var array $tags
	 * @var $brands
	 * @var $carcases
	 * @var $transmissions
	 */
?>


<form action="/" method="get" class="dropdown__form di">
    <div class="dropdown__wraper di">
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">Марка</div>
            <?php foreach ($brands as $brand): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="brand_<?=$brand->id?>" type="radio" name="brand" value="<?=$brand->value?>">
                    <label class="dropdown__radio di" for="brand_<?=$brand->id?>"><?= htmlspecialchars($brand->value) ?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">Тип кузова</div>
            <?php foreach ($carcases as $carcase): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="carcase_<?=$carcase->id?>" type="radio" name="carcase" value="<?=$carcase->value?>">
                    <label class="dropdown__radio di" for="carcase_<?=$carcase->id?>"><?= htmlspecialchars($carcase->value) ?></label>
                </div>
            <?php endforeach ?>
        </div>
        <div class="dropdown__tag di">
            <div class="dropdown__tag-name di">КПП</div>
            <?php foreach ($transmissions as $transmission): ?>
                <div class="dropdown__tag-item di">
                    <input class="dropdown__radio di" id="transmission_<?=$transmission->id?>" type="radio" name="transmission" value="<?=$transmission->value?>">
                    <label class="dropdown__radio di" for="transmission_<?=$transmission->id?>"><?= htmlspecialchars($transmission->value) ?></label>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <button type="submit" class="dropdown__btn">Найти</button>
</form>