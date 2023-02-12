CREATE TABLE IF NOT EXISTS users
(
	ID int not null auto_increment,
	PASS char(40) not null,
	LOGIN nvarchar(50) not null,
	MAIL nvarchar(50) not null,
	ROLE nvarchar (50) default 'user',
	PRIMARY KEY (ID)
);