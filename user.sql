CREATE TABLE users (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  first_name varchar(80) NOT NULL,
  last_name varchar(80) NOT NULL,
  age int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;