CREATE TABLE IF NOT EXISTS `order`
(
	ID int not null auto_increment,
	PRODUCT_ID int not null,
	PRODUCT_PRICE int not null,
	STATUS varchar(100) not null,
	DATE_CREATION datetime,
	CUSTOMER_NAME varchar(100) not null,
	CUSTOMER_PHONE varchar(15),
	CUSTOMER_MAIL nvarchar(50) not null,
	COMMENT varchar(500),
	PRIMARY KEY (ID)
);