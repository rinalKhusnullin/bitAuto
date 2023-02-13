CREATE TABLE IF NOT EXISTS users
(
	ID int not null auto_increment,
	PASS nvarchar(200) not null,
	LOGIN nvarchar(50) not null,
    FIRST_NAME nvarchar(50) not null,
    LAST_NAME nvarchar(50) not null,
	MAIL nvarchar(50) not null,
	ROLE nvarchar (50) default 'user',
	PRIMARY KEY (ID)
);