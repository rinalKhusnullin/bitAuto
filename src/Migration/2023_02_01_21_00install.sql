CREATE TABLE IF NOT EXISTS migration
(
	ID int not null auto_increment,
	NAME varchar(255) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS products
(
	ID int not null auto_increment,
	NAME varchar(255) not null,
	SHORT_DESCRIPTION varchar(255) not null,
	FULL_DESCRIPTION varchar(500) not null,
	PRODUCT_PRIСE int not null,
	IS_ACTIVE bit,
	DATE_CREATION datetime,
	DATE_UPDATE datetime,
	PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS tags
(
	ID int not null auto_increment,
	NAME varchar(100) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS products_tags
(
	ID_PRODUCT int not null,
	ID_TAG int not null,

	FOREIGN KEY FK_PT_PRODUCT (ID_PRODUCT)
		REFERENCES products(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,

	FOREIGN KEY FK_PT_TAG (ID_TAG)
		REFERENCES tags(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS images
(
	ID int not null auto_increment,
	PATH varchar(500) not null,
	WIDTH int not null,
	HEIGHT int not null,
	IS_MAIN bit DEFAULT false,
	ID_PRODUCT int not null,

	PRIMARY KEY (ID),
	FOREIGN KEY FK_PT_PRODUCT (ID_PRODUCT)
		REFERENCES products(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS users
(
	ID int not null auto_increment,
	PASS char(40) not null,
	LOGIN nvarchar(50) not null,
	MAIL nvarchar(50) not null,
	PRIMARY KEY (ID)
	);

CREATE TABLE IF NOT EXISTS orders
(
	ID int not null auto_increment,
	PRODUCT_ID int not null,
	PRODUCT_PRICE int not null,
	STATUS varchar(100) not null,
	DATE_CREATION datetime,
	CUSTOMER_NAME varchar(100) not null,
	CUSTOMER_PHONE bigint,
	CUSTOMER_MAIL nvarchar(50) not null,
	COMMENT varchar(500),
	PRIMARY KEY (ID)
);