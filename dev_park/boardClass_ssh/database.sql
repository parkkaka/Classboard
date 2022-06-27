CREATE DATABASE board;

 /*쿼리문*/
create table `memo` (
  `idx` int  AUTO_INCREMENT,
  `name` VARCHAR(60),
  `subject` VARCHAR(50),
  `memo` text,
  `pwd` VARCHAR(50),
  `regDate` VARCHAR(20),
  `ip` VARCHAR(60),
  `cnt` int NOT NULL,
  PRIMARY KEY(`idx`)
);


