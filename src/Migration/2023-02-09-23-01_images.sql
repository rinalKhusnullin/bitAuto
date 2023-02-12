CREATE TABLE IF NOT EXISTS images
(
	ID int not null auto_increment,
	PATH varchar(500) not null,
	IS_MAIN bit DEFAULT false,
	ID_PRODUCT int not null,
	PRIMARY KEY (ID),
	FOREIGN KEY FK_PT_PRODUCT (ID_PRODUCT)
	REFERENCES products(ID)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
);