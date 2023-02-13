CREATE TABLE IF NOT EXISTS products
(
	ID int not null auto_increment,
	NAME varchar(255) not null,
	FULL_DESCRIPTION varchar(2000) not null,
	PRODUCT_PRICE int not null,
-- 	PRODUCT_PRIСE int not null,
	IS_ACTIVE bit,
	ID_BRAND int not null,
	ID_TRANSMISSION int not null,
	ID_CARCASE int not null,
	DATE_CREATION datetime,
	DATE_UPDATE datetime,
	PRIMARY KEY (ID),
	foreign key FK_PRODUCT_BRAND(ID_BRAND)
	references brand(id)
	on update restrict
	on delete restrict,
	foreign key FK_PRODUCT_TRANSMISSION(ID_TRANSMISSION)
	references transmission(id)
	on update restrict
	on delete restrict,
	foreign key FK_PRODUCT_CARCASE(ID_CARCASE)
	references carcase(id)
	on update restrict
	on delete restrict
);