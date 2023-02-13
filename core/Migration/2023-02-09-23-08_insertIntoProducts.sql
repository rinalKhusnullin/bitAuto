INSERT INTO products
(
 	ID,
 	NAME,
 	FULL_DESCRIPTION,
 	IS_ACTIVE,
 	DATE_CREATION,
 	PRODUCT_PRICE,
 	ID_BRAND,
 	ID_CARCASE,
 	ID_TRANSMISSION)
VALUES
	(1, 'Mazda 3', 'Мазда 3- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 Skyactiv-Vehiche с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', true, CURRENT_DATE(), 450000, 1, 1, 1),
	(2,'Mazda CX-5', 'Mazda CX-5 пятиместный кроссовер.
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
и несколькими пассажирами на борту.', true, CURRENT_DATE(), 2700000, 1,2,1),
	(3,'Toyota Camry', 'Седан Toyota Camry нового поколения — эталон среди автомобилей бизнес-класса,
который по праву удерживает лидирующие позиции в своем сегменте.
Он построен на модульной архитектуре TNGA, которая обеспечивает
владельцам весомые бонусы и отличные тех характеристики — свежий дизайн,
премиальный комфорт, впечатляющие ходовые качества и особый характер.
Выпускается с 2017 года, в Российской Федерации старт продаж 2 апреля 2018 года.
Автомобиль получил прежние двигатели 2,0 и 2,5 а также обновленную 3,5-литровую «шестерку»
 в сочетании с 8 диапазонным «автоматом». Двигатель 3,5 оснащён комбинированным типом впрыска,
 специально для российского рынка дефорсирован до 249 л. с.
Летом 2020 года модернизировали внешний вид и интерьер модели — передний бампер,
экран мультимедийного комплекса, диагональ дисплея (увеличили максимальный размер до 9 дюймов)
, улучшенная шумоизоляция, появление доработанного комплекса Toyota Safety Sense 2.5+.
 Электронику научили удержанию автомобиля в полосе, автоматическому возобновлению движения
после короткой остановки при включённом, а система экстренного торможения теперь распознаёт
 автомобили, едущие навстречу, а также пешеходов и велосипедистов.', true, CURRENT_DATE(), 2498000,2,3,1),
	(4, 'Toyota Solara','Toyota Solara начала производиться с 1998 года и показывала уверенный спрос
на рынке вплоть до 2007 года, после чего автомобиль сняли с конвейера.
За всю историю производства автомобиль получил 2 поколения, которые включали
рестайлинг и несколько кузовных вариаций. Toyota Solara выпускались в форм-факторе
двух дверного купе или кабриолет.
Особенностью автомобиля считался молодежно-спортивный дизайн транспортного средства.
Toyota Solara, независимо от комплектации или серии кузова, имеет агрессивную экстерьерную
часть кузова и комфортабельный просторный салон с полуспортивными креслами для переднего ряда.', true, CURRENT_DATE(), 600000,2,4,1),
	(5, 'VolksWagen Multivan', 'Volkswagen Multivan T6 – минивэн M-класса, передний и полный привод.
 Механика и робот. Бензиновые и дизельные двигатели мощностью от 84 до
204 лошадиных сил.
Микроавтобус VW Multivan – классический семейный транспорт.
«Вэн» – значит вместительный. А «мульти» означает, что интерьер
относительно просто и оперативно может быть трансформирован в
пространство для перевозки грузов. Обновленный Multivan довольно
сильно отличается от своего предшественника — как дизайном кузова,
 так и оформлением интерьера. Кузов теперь получил 12 лет гарантии
 от сквозной коррозии. Салон был спроектирован заново и стал более роскошным.
 Главной характерной чертой его является трансформация. Для большего удобства
на полу сделали специальные полозья по которым можно передвигать задние сиденья,
 изменяя конфигурацию салона. Еще на стадии изготовления автомобиля заказчик может
 выбрать одну из нескольких основных схем размещения кресел в салоне. Это могут быт
 либо классические несколько рядов в пассажирской версии, либо размещение кресел
 «лицом к лицу» в люксовой модификации. Впечатляет список дополнительных опций.
 При желании покупателя установят складывающийся столик и сдвижные боковые двери
с двух сторон, которые могут быть оборудованы электроприводом. В салоне появилась
масса ящичков, кармашков и полочек, призванных поднять комфорт на новый уровень.', true, CURRENT_DATE(), 1150000,3,5,2),
	(6, 'VolksWagen Passat', 'Volkswagen Passat — семейство среднеразмерных автомобилей компании Volkswagen,
 производившееся с 1973 по 2022 год. Название Пассат произошло от
одноимённого ветра.
Volkswagen Passat B8 впервые был показан в потсдамском дизайн-центре Volkswagen
3 июля 2014 года. Новый Passat B8 был построен на новой платформе MQB,
 на которой также базировалось семейство VW Golf[25]. По сравнению с предшественником B6,
седан Passat B8 стал короче на 2 мм (4767 мм), а колёсная база выросла на 79 мм (до 2791 мм),
 33 мм прибавилось к длине салона. Ширина увеличилась на 12 мм (до 1832 мм),
 а высота уменьшилась на 14 мм (1456 мм). Свесы кузова стали короче на 67 мм спереди
и 13 мм сзади.', true, CURRENT_DATE(), 1150000,3,6,1),
    (7, 'Mazda 6', 'Мазда 6- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 Skyactiv-Vehiche с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', true, CURRENT_DATE(), 500000, 1, 3, 1),
       (8,'Toyota LandCruiser', 'Toyota LandCruiser пятиместный кроссовер.
Его габаритные размеры составляют: длина 4550 мм,
ширина 1840 мм, высота 1690 мм, колесная база 2700 мм,
а величина дорожного просвета равняется 192 миллиметрам.
Такой клиренс свойственен автомобилям, подготовленным к
тяжелым условиям эксплуатации . Они с легкостью перенесут
поездку по грунтовке, смогут штурмовать бордюры во время парковки
 и сохранят приемлемую плавность хода во время движения по разбитой дороге
 с твердым покрытием.
Багажник Toyota LandCruiser обладает неплохой вместительностью.
При поднятых спинках второго ряда сидений, сзади остается вплоть
до 505 литров свободного пространства. Благодаря такому объему,
автомобиль отлично справится с повседневными задачами городского жителя
и не ударит в грязь лицом даже во время длительной поездки с обилием багажа
и несколькими пассажирами на борту.', true, CURRENT_DATE(), 2750000, 2,2,1),
       (9,'Toyota Corolla', 'Седан Toyota Corolla нового поколения — эталон среди автомобилей бизнес-класса,
который по праву удерживает лидирующие позиции в своем сегменте.
Он построен на модульной архитектуре TNGA, которая обеспечивает
владельцам весомые бонусы и отличные тех характеристики — свежий дизайн,
премиальный комфорт, впечатляющие ходовые качества и особый характер.
Выпускается с 2017 года, в Российской Федерации старт продаж 2 апреля 2018 года.
Автомобиль получил прежние двигатели 2,0 и 2,5 а также обновленную 3,5-литровую «шестерку»
 в сочетании с 8 диапазонным «автоматом». Двигатель 3,5 оснащён комбинированным типом впрыска,
 специально для российского рынка дефорсирован до 249 л. с.
Летом 2020 года модернизировали внешний вид и интерьер модели — передний бампер,
экран мультимедийного комплекса, диагональ дисплея (увеличили максимальный размер до 9 дюймов)
, улучшенная шумоизоляция, появление доработанного комплекса Toyota Safety Sense 2.5+.
 Электронику научили удержанию автомобиля в полосе, автоматическому возобновлению движения
после короткой остановки при включённом, а система экстренного торможения теперь распознаёт
 автомобили, едущие навстречу, а также пешеходов и велосипедистов.', true, CURRENT_DATE(), 3978000,2,3,2),
       (10, 'Toyota Yaris','Toyota Yaris начала производиться с 1998 года и показывала уверенный спрос
на рынке вплоть до 2007 года, после чего автомобиль сняли с конвейера.
За всю историю производства автомобиль получил 2 поколения, которые включали
рестайлинг и несколько кузовных вариаций. Toyota Yaris выпускались в форм-факторе
двух дверного купе или кабриолет.
Особенностью автомобиля считался молодежно-спортивный дизайн транспортного средства.
Toyota Yaris, независимо от комплектации или серии кузова, имеет агрессивную экстерьерную
часть кузова и комфортабельный просторный салон с полуспортивными креслами для переднего ряда.', true, CURRENT_DATE(), 3600000,2,1,2),
       (11, 'VolksWagen Golf', 'VolksWagen Golf – минивэн M-класса, передний и полный привод.
 Механика и робот. Бензиновые и дизельные двигатели мощностью от 84 до
204 лошадиных сил.
Микроавтобус VolksWagen Golf – классический семейный транспорт.
«Вэн» – значит вместительный. А «мульти» означает, что интерьер
относительно просто и оперативно может быть трансформирован в
пространство для перевозки грузов. Обновленный VolksWagen Golf довольно
сильно отличается от своего предшественника — как дизайном кузова,
 так и оформлением интерьера. Кузов теперь получил 12 лет гарантии
 от сквозной коррозии. Салон был спроектирован заново и стал более роскошным.
 Главной характерной чертой его является трансформация. Для большего удобства
на полу сделали специальные полозья по которым можно передвигать задние сиденья,
 изменяя конфигурацию салона. Еще на стадии изготовления автомобиля заказчик может
 выбрать одну из нескольких основных схем размещения кресел в салоне. Это могут быт
 либо классические несколько рядов в пассажирской версии, либо размещение кресел
 «лицом к лицу» в люксовой модификации. Впечатляет список дополнительных опций.
 При желании покупателя установят складывающийся столик и сдвижные боковые двери
с двух сторон, которые могут быть оборудованы электроприводом. В салоне появилась
масса ящичков, кармашков и полочек, призванных поднять комфорт на новый уровень.', true, CURRENT_DATE(), 2220000,3,1,1),
       (12, 'VolksWagen Sirocco', 'VolksWagen Sirocco — семейство среднеразмерных автомобилей компании Volkswagen,
 производившееся с 1973 по 2022 год. Название Sirocco произошло от
одноимённого ветра.
Volkswagen Passat B8 впервые был показан в потсдамском дизайн-центре Volkswagen
3 июля 2014 года. Новый Sirocco B8 был построен на новой платформе MQB,
 на которой также базировалось семейство VW Golf[25]. По сравнению с предшественником B6,
седан Sirocco B8 стал короче на 2 мм (4767 мм), а колёсная база выросла на 79 мм (до 2791 мм),
 33 мм прибавилось к длине салона. Ширина увеличилась на 12 мм (до 1832 мм),
 а высота уменьшилась на 14 мм (1456 мм). Свесы кузова стали короче на 67 мм спереди
и 13 мм сзади.', true, CURRENT_DATE(), 5995000,3,4,2),
       (13, 'VolksWagen beatle', 'Мазда 3- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 VolksWagen beatle с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', true, CURRENT_DATE(), 700000, 3, 4, 2),
       (14,'VolksWagen Tiguan', 'VolksWagen Tiguan пятиместный кроссовер.
Его габаритные размеры составляют: длина 4550 мм,
ширина 1840 мм, высота 1690 мм, колесная база 2700 мм,
а величина дорожного просвета равняется 192 миллиметрам.
Такой клиренс свойственен автомобилям, подготовленным к
тяжелым условиям эксплуатации . Они с легкостью перенесут
поездку по грунтовке, смогут штурмовать бордюры во время парковки
 и сохранят приемлемую плавность хода во время движения по разбитой дороге
 с твердым покрытием.
Багажник Toyota LandCruiser обладает неплохой вместительностью.
При поднятых спинках второго ряда сидений, сзади остается вплоть
до 505 литров свободного пространства. Благодаря такому объему,
автомобиль отлично справится с повседневными задачами городского жителя
и не ударит в грязь лицом даже во время длительной поездки с обилием багажа
и несколькими пассажирами на борту.', true, CURRENT_DATE(), 3450000, 3,2,1),
       (15,'VolksWagen Polo', 'Седан VolksWagen Polo нового поколения — эталон среди автомобилей бизнес-класса,
который по праву удерживает лидирующие позиции в своем сегменте.
Он построен на модульной архитектуре TNGA, которая обеспечивает
владельцам весомые бонусы и отличные тех характеристики — свежий дизайн,
премиальный комфорт, впечатляющие ходовые качества и особый характер.
Выпускается с 2017 года, в Российской Федерации старт продаж 2 апреля 2018 года.
Автомобиль получил прежние двигатели 2,0 и 2,5 а также обновленную 3,5-литровую «шестерку»
 в сочетании с 8 диапазонным «автоматом». Двигатель 3,5 оснащён комбинированным типом впрыска,
 специально для российского рынка дефорсирован до 249 л. с.
Летом 2020 года модернизировали внешний вид и интерьер модели — передний бампер,
экран мультимедийного комплекса, диагональ дисплея (увеличили максимальный размер до 9 дюймов)
, улучшенная шумоизоляция, появление доработанного комплекса VolksWagen Polo.
 Электронику научили удержанию автомобиля в полосе, автоматическому возобновлению движения
после короткой остановки при включённом, а система экстренного торможения теперь распознаёт
 автомобили, едущие навстречу, а также пешеходов и велосипедистов.', true, CURRENT_DATE(), 3453000,3,3,2),
       (16, 'VolksWagen Touareg','VolksWagen Touareg начала производиться с 1998 года и показывала уверенный спрос
на рынке вплоть до 2007 года, после чего автомобиль сняли с конвейера.
За всю историю производства автомобиль получил 2 поколения, которые включали
рестайлинг и несколько кузовных вариаций. VolksWagen Touareg выпускались в форм-факторе
двух дверного купе или кабриолет.
Особенностью автомобиля считался молодежно-спортивный дизайн транспортного средства.
VolksWagen Touareg, независимо от комплектации или серии кузова, имеет агрессивную экстерьерную
часть кузова и комфортабельный просторный салон с полуспортивными креслами для переднего ряда.', true, CURRENT_DATE(), 7774000,3,2,1),
       (17, 'Nissan Juke', 'Nissan Juke – минивэн M-класса, передний и полный привод.
 Механика и робот. Бензиновые и дизельные двигатели мощностью от 84 до
204 лошадиных сил.
Микроавтобус Nissan Juke – классический семейный транспорт.
«Вэн» – значит вместительный. А «мульти» означает, что интерьер
относительно просто и оперативно может быть трансформирован в
пространство для перевозки грузов. Обновленный Nissan Juke довольно
сильно отличается от своего предшественника — как дизайном кузова,
 так и оформлением интерьера. Кузов теперь получил 12 лет гарантии
 от сквозной коррозии. Салон был спроектирован заново и стал более роскошным.
 Главной характерной чертой его является трансформация. Для большего удобства
на полу сделали специальные полозья по которым можно передвигать задние сиденья,
 изменяя конфигурацию салона. Еще на стадии изготовления автомобиля заказчик может
 выбрать одну из нескольких основных схем размещения кресел в салоне. Это могут быт
 либо классические несколько рядов в пассажирской версии, либо размещение кресел
 «лицом к лицу» в люксовой модификации. Впечатляет список дополнительных опций.
 При желании покупателя установят складывающийся столик и сдвижные боковые двери
с двух сторон, которые могут быть оборудованы электроприводом. В салоне появилась
масса ящичков, кармашков и полочек, призванных поднять комфорт на новый уровень.', true, CURRENT_DATE(), 2220000,4,2,2),
       (18, 'Nissan Almera' ,'Nissan Almera — семейство среднеразмерных автомобилей компании Nissan,
 производившееся с 1973 по 2022 год. Название Sirocco произошло от
одноимённого ветра.
Nissan Almera B8 впервые был показан в потсдамском дизайн-центре Nissan
3 июля 2014 года. Новый Sirocco B8 был построен на новой платформе MQB,
 на которой также базировалось семейство VW Golf[25]. По сравнению с предшественником B6,
седан Nissan Almera B8 стал короче на 2 мм (4767 мм), а колёсная база выросла на 79 мм (до 2791 мм),
 33 мм прибавилось к длине салона. Ширина увеличилась на 12 мм (до 1832 мм),
 а высота уменьшилась на 14 мм (1456 мм). Свесы кузова стали короче на 67 мм спереди
и 13 мм сзади.', true, CURRENT_DATE(), 1140000,4,3,2),
       (19, 'Nissan Qashqai', 'Мазда 6- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 Nissan Qashqai с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', true, CURRENT_DATE(), 666000, 4, 2, 1),
       (20,'Lexus RX300', 'Lexus RX300 пятиместный кроссовер.
Его габаритные размеры составляют: длина 4550 мм,
ширина 1840 мм, высота 1690 мм, колесная база 2700 мм,
а величина дорожного просвета равняется 192 миллиметрам.
Такой клиренс свойственен автомобилям, подготовленным к
тяжелым условиям эксплуатации . Они с легкостью перенесут
поездку по грунтовке, смогут штурмовать бордюры во время парковки
 и сохранят приемлемую плавность хода во время движения по разбитой дороге
 с твердым покрытием.
Багажник Lexus RX300 обладает неплохой вместительностью.
При поднятых спинках второго ряда сидений, сзади остается вплоть
до 505 литров свободного пространства. Благодаря такому объему,
автомобиль отлично справится с повседневными задачами городского жителя
и не ударит в грязь лицом даже во время длительной поездки с обилием багажа
и несколькими пассажирами на борту.', true, CURRENT_DATE(), 2754000, 5,2,1),
       (21,'Lexus GS300', 'Седан 21. Lexus GS300 нового поколения — эталон среди автомобилей бизнес-класса,
который по праву удерживает лидирующие позиции в своем сегменте.
Он построен на модульной архитектуре TNGA, которая обеспечивает
владельцам весомые бонусы и отличные тех характеристики — свежий дизайн,
премиальный комфорт, впечатляющие ходовые качества и особый характер.
Выпускается с 2017 года, в Российской Федерации старт продаж 2 апреля 2018 года.
Автомобиль получил прежние двигатели 2,0 и 2,5 а также обновленную 3,5-литровую «шестерку»
 в сочетании с 8 диапазонным «автоматом». Двигатель 3,5 оснащён комбинированным типом впрыска,
 специально для российского рынка дефорсирован до 249 л. с.
Летом 2020 года модернизировали внешний вид и интерьер модели — передний бампер,
экран мультимедийного комплекса, диагональ дисплея (увеличили максимальный размер до 9 дюймов)
, улучшенная шумоизоляция, появление доработанного комплекса Toyota Safety Sense 2.5+.
 Электронику научили удержанию автомобиля в полосе, автоматическому возобновлению движения
после короткой остановки при включённом, а система экстренного торможения теперь распознаёт
 автомобили, едущие навстречу, а также пешеходов и велосипедистов.', true, CURRENT_DATE(), 3978000,5,3,1),
       (22, 'Lexus ES300','Lexus ES300 начала производиться с 1998 года и показывала уверенный спрос
на рынке вплоть до 2007 года, после чего автомобиль сняли с конвейера.
За всю историю производства автомобиль получил 2 поколения, которые включали
рестайлинг и несколько кузовных вариаций. Lexus ES300 выпускались в форм-факторе
двух дверного купе или кабриолет.
Особенностью автомобиля считался молодежно-спортивный дизайн транспортного средства.
Toyota Yaris, независимо от комплектации или серии кузова, имеет агрессивную экстерьерную
часть кузова и комфортабельный просторный салон с полуспортивными креслами для переднего ряда.', true, CURRENT_DATE(), 3600000,5,3,1),
       (23, 'Audi 5', 'Audi 5 – минивэн M-класса, передний и полный привод.
 Механика и робот. Бензиновые и дизельные двигатели мощностью от 84 до
204 лошадиных сил.
Микроавтобус Audi 5 – классический семейный транспорт.
«Вэн» – значит вместительный. А «мульти» означает, что интерьер
относительно просто и оперативно может быть трансформирован в
пространство для перевозки грузов. Обновленный Audi 5 довольно
сильно отличается от своего предшественника — как дизайном кузова,
 так и оформлением интерьера. Кузов теперь получил 12 лет гарантии
 от сквозной коррозии. Салон был спроектирован заново и стал более роскошным.
 Главной характерной чертой его является трансформация. Для большего удобства
на полу сделали специальные полозья по которым можно передвигать задние сиденья,
 изменяя конфигурацию салона. Еще на стадии изготовления автомобиля заказчик может
 выбрать одну из нескольких основных схем размещения кресел в салоне. Это могут быт
 либо классические несколько рядов в пассажирской версии, либо размещение кресел
 «лицом к лицу» в люксовой модификации. Впечатляет список дополнительных опций.
 При желании покупателя установят складывающийся столик и сдвижные боковые двери
с двух сторон, которые могут быть оборудованы электроприводом. В салоне появилась
масса ящичков, кармашков и полочек, призванных поднять комфорт на новый уровень.', true, CURRENT_DATE(), 2770000,6,4,1),
       (24, 'Audi 6', 'Audi 6 — семейство среднеразмерных автомобилей компании Volkswagen,
 производившееся с 1973 по 2022 год. Название Sirocco произошло от
одноимённого ветра.
Audi 6 B8 впервые был показан в потсдамском дизайн-центре Audi
3 июля 2014 года. Новый Sirocco B8 был построен на новой платформе MQB,
 на которой также базировалось семейство VW Golf[25]. По сравнению с предшественником B6,
седан Sirocco B8 стал короче на 2 мм (4767 мм), а колёсная база выросла на 79 мм (до 2791 мм),
 33 мм прибавилось к длине салона. Ширина увеличилась на 12 мм (до 1832 мм),
 а высота уменьшилась на 14 мм (1456 мм). Свесы кузова стали короче на 67 мм спереди
и 13 мм сзади.', true, CURRENT_DATE(), 7878000,6,3,1),
       (25, 'Audi 8', 'Audi 8- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 Audi 8 с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', true, CURRENT_DATE(), 666666, 6, 2, 1),
       (26,'Toyota Rav4', 'Toyota Rav4 пятиместный кроссовер.
Его габаритные размеры составляют: длина 4550 мм,
ширина 1840 мм, высота 1690 мм, колесная база 2700 мм,
а величина дорожного просвета равняется 192 миллиметрам.
Такой клиренс свойственен автомобилям, подготовленным к
тяжелым условиям эксплуатации . Они с легкостью перенесут
поездку по грунтовке, смогут штурмовать бордюры во время парковки
 и сохранят приемлемую плавность хода во время движения по разбитой дороге
 с твердым покрытием.
Багажник Toyota LandCruiser обладает неплохой вместительностью.
При поднятых спинках второго ряда сидений, сзади остается вплоть
до 505 литров свободного пространства. Благодаря такому объему,
автомобиль отлично справится с повседневными задачами городского жителя
и не ударит в грязь лицом даже во время длительной поездки с обилием багажа
и несколькими пассажирами на борту.', true, CURRENT_DATE(), 8790000, 2,2,1),
       (27,'Toyota Alphard', 'Toyota Alphard нового поколения — эталон среди автомобилей бизнес-класса,
который по праву удерживает лидирующие позиции в своем сегменте.
Он построен на модульной архитектуре TNGA, которая обеспечивает
владельцам весомые бонусы и отличные тех характеристики — свежий дизайн,
премиальный комфорт, впечатляющие ходовые качества и особый характер.
Выпускается с 2017 года, в Российской Федерации старт продаж 2 апреля 2018 года.
Автомобиль получил прежние двигатели 2,0 и 2,5 а также обновленную 3,5-литровую «шестерку»
 в сочетании с 8 диапазонным «автоматом». Двигатель 3,5 оснащён комбинированным типом впрыска,
 специально для российского рынка дефорсирован до 249 л. с.
Летом 2020 года модернизировали внешний вид и интерьер модели — передний бампер,
экран мультимедийного комплекса, диагональ дисплея (увеличили максимальный размер до 9 дюймов)
, улучшенная шумоизоляция, появление доработанного комплекса Toyota Alphard.
 Электронику научили удержанию автомобиля в полосе, автоматическому возобновлению движения
после короткой остановки при включённом, а система экстренного торможения теперь распознаёт
 автомобили, едущие навстречу, а также пешеходов и велосипедистов.', true, CURRENT_DATE(), 4848000,2,5,1),
       (28, 'Mazda 5', 'Mazda 5 начала производиться с 1998 года и показывала уверенный спрос
на рынке вплоть до 2007 года, после чего автомобиль сняли с конвейера.
За всю историю производства автомобиль получил 2 поколения, которые включали
рестайлинг и несколько кузовных вариаций. Mazda 5 выпускались в форм-факторе
двух дверного купе или кабриолет.
Особенностью автомобиля считался молодежно-спортивный дизайн транспортного средства.
Mazda 5, независимо от комплектации или серии кузова, имеет агрессивную экстерьерную
часть кузова и комфортабельный просторный салон с полуспортивными креслами для переднего ряда.', true, CURRENT_DATE(), 888000,1,6,2),
       (29, ' Lexus LM', ' Lexus LM – минивэн M-класса, передний и полный привод.
 Механика и робот. Бензиновые и дизельные двигатели мощностью от 84 до
204 лошадиных сил.
 Lexus LM – классический семейный транспорт.
«Вэн» – значит вместительный. А «мульти» означает, что интерьер
относительно просто и оперативно может быть трансформирован в
пространство для перевозки грузов. Обновленный  Lexus LM довольно
сильно отличается от своего предшественника — как дизайном кузова,
 так и оформлением интерьера. Кузов теперь получил 12 лет гарантии
 от сквозной коррозии. Салон был спроектирован заново и стал более роскошным.
 Главной характерной чертой его является трансформация. Для большего удобства
на полу сделали специальные полозья по которым можно передвигать задние сиденья,
 изменяя конфигурацию салона. Еще на стадии изготовления автомобиля заказчик может
 выбрать одну из нескольких основных схем размещения кресел в салоне. Это могут быт
 либо классические несколько рядов в пассажирской версии, либо размещение кресел
 «лицом к лицу» в люксовой модификации. Впечатляет список дополнительных опций.
 При желании покупателя установят складывающийся столик и сдвижные боковые двери
с двух сторон, которые могут быть оборудованы электроприводом. В салоне появилась
масса ящичков, кармашков и полочек, призванных поднять комфорт на новый уровень.', true, CURRENT_DATE(), 1110000,5,5,1),
       (30, 'Nissan Quest', 'Nissan Quest — семейство среднеразмерных автомобилей компании Nissan,
 производившееся с 1973 по 2022 год. Название Sirocco произошло от
одноимённого ветра.
Nissan Quest B8 впервые был показан в потсдамском дизайн-центре Nissan
3 июля 2014 года. Новый Sirocco B8 был построен на новой платформе MQB,
 на которой также базировалось семейство VW Golf[25]. По сравнению с предшественником B6,
седан Nissan Quest B8 стал короче на 2 мм (4767 мм), а колёсная база выросла на 79 мм (до 2791 мм),
 33 мм прибавилось к длине салона. Ширина увеличилась на 12 мм (до 1832 мм),
 а высота уменьшилась на 14 мм (1456 мм). Свесы кузова стали короче на 67 мм спереди
и 13 мм сзади.', true, CURRENT_DATE(), 1140000,4,5,2);