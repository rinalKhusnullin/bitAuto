
<div class="product-detailed__main">
    <h1 class="product-detailed__main-title">MAZDA CX-5</h1> <!-- need to add title for product -->
</div>
<div class="product-detailed">
    <div class="product-detailed__img">
        <img src="/tmp-autoimg/auto-id-2.png" alt=""> <!-- need to add src to img -->
        <div class="product-detailed__price">
            <div class="product-detailed__price-title">Цена</div>
            <div class="product-detailed__price-value">2 700 00 &#8381</div> <!-- need to add price -->
        </div>
        <button id="buy-btn" onclick="PopUpShow();" class="product-detailed__buy-btn">Купить</button>
    </div>
    <div class="product-detailed__description">
        <h2 class="product-detailed__subtitle">Характеристики</h2>
        <div class="product-detailed__subdescription">
            <ul class="product-detailed__characteristics">
                <li class="product-detailed__characteristic">
                    <div class="product-detailed__name">Модель</div>
                    <div class="product-detailed__underline"></div>
                    <div class="product-detailed__value">Mazda CX-5</div> <!-- need to add title for product -->
                </li>
                <li class="product-detailed__characteristic">
                    <div class="product-detailed__name">Тип кузова</div>
                    <div class="product-detailed__underline"></div>
                    <div class="product-detailed__value">Кроссовер</div> <!-- need to add carcaseType -->
                </li>
                <li class="product-detailed__characteristic">
                    <div class="product-detailed__name">КПП</div>
                    <div class="product-detailed__underline"></div>
                    <div class="product-detailed__value">АКПП</div> <!-- need to add АКПП -->
                </li>
            </ul>
        </div>
        <h2 class="product-detailed__subtitle">Описание</h2> <!-- need to add description -->
        <div class="product-detailed__subdescription">Mazda CX-5 пятиместный кроссовер. 
            Его габаритные размеры составляют: длина 4550 мм, 
            ширина 1840 мм, высота 1690 мм, колесная база 2700 мм, 
            а величина дорожного просвета равняется 192 миллиметрам. 
            Такой клиренс свойственен автомобилям, подготовленным к 
            тяжелым условиям эксплуатации . Они с легкостью перенесут 
            поездку по грунтовке, смогут штурмовать бордюры во время парковки
            и сохранят приемлемую плавность хода во время движения по разбитой дороге
            с твердым покрытием.
            Багажник Mazda CX-5 обладает неплохой вместительностью. 
            При поднятых спинках второго ряда сидений, сзади остается вплоть 
            до 505 литров свободного пространства. Благодаря такому объему, 
            автомобиль отлично справится с повседневными задачами городского жителя 
            и не ударит в грязь лицом даже во время длительной поездки с обилием багажа 
            и несколькими пассажирами на борту.
        </div>
    </div>
</div>
<div class="popup" id="popup">
    <div class="popup__content">
        <button class="popup__exit" onclick="PopUpHide();">✖</button>
        <h1 class="poppup__title">Форма заказа</h1>
        <div class="poppup__container">
            
            <div class="poppup__product-info">
                <div class="poppup__img">
                    <img src="/tmp-autoimg/auto-id-2.png" alt=""> <!-- need to add src to img -->
                </div>
                <h2 class="poppup__product-name">MAZDA CX-5</h2> <!-- need to add title for product -->
                <div class="poppup__price">
                    <div class="poppup__price-title">Цена</div>
                    <div class="poppup__price-value">2 700 000 &#8381</div> <!-- need to add price -->
                </div>
            </div>
            <form action="##" method="post"> <!-- need to add handler -->
                <div class="poppup__subtitle">Фамилия*</div>
                <input type="text" class="poppup__input" name="userLastname" required>
                <div class="poppup__subtitle">Имя*</div>
                <input type="text" class="poppup__input" name="userName" required>
                <div class="poppup__subtitle">Телефон*</div>
                <input type="tel" class="poppup__input" name="userTel" required>
                <div class="poppup__subtitle">Email*</div>
                <input type="email" class="poppup__input" name="userEmail" required>
                <div class="poppup__subtitle">Адрес*</div>
                <input type="text" class="poppup__input" name="userAddress" required>
                <div class="poppup__subtitle">Пожелания к заказу</div>
                <textarea type="textarea" class="poppup__input big-input" name="userComment"></textarea>
                <button type="submit" class="poppup__input send-btn">Оформить заказ</button>
            </form>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<script>
    $(document).ready(function(){
        //Скрыть PopUp при загрузке страницы    
        PopUpHide();
    });
    //Функция отображения PopUp
    function PopUpShow(){
        $("#popup").show();
    }
    //Функция скрытия PopUp
    function PopUpHide(){
        $("#popup").hide();
    }
</script>