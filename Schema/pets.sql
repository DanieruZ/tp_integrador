CREATE DATABASE IF NOT EXISTS pets;
USE pets;

CREATE TABLE IF NOT EXISTS rol (
  rolId INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(50) NOT NULL,
  PRIMARY KEY (rolId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS person (
  personId INT NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  dni VARCHAR(10) NOT NULL,
  email VARCHAR(50) NOT NULL,
  gender ENUM('female', 'male', 'other') NOT NULL,
  isActive BOOLEAN NOT NULL DEFAULT 0,
  rolId INT NOT NULL,
  PRIMARY KEY (personId),  
  FOREIGN KEY (rolId) REFERENCES rol (rolId),  
  UNIQUE (dni, email) 
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS agenda (
  scheduleId INT NOT NULL AUTO_INCREMENT,
  startDate DATE NOT NULL,
  endDate DATE NOT NULL,
  state BOOLEAN DEFAULT 0,
  personId INT,
  size varchar(30),
  pet_type varchar(30),
  cost float,  
  PRIMARY KEY (scheduleId),
  FOREIGN KEY (personId) REFERENCES person (personId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS pet (
  petId INT NOT NULL AUTO_INCREMENT,
  petname VARCHAR(50) NOT NULL,
  size ENUM('small', 'medium', 'large' , 'x-large') NOT NULL,
  pet_type ENUM('dog', 'cat', 'bird') NOT NULL,
  breed VARCHAR(50) NOT NULL,
  PRIMARY KEY (petId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS book (
  bookId INT NOT NULL AUTO_INCREMENT,
  startDate DATE NOT NULL,
  endDate DATE NOT NULL,
  state BOOLEAN DEFAULT '0',
  PRIMARY KEY (bookId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS person_book (
  person_bookId INT NOT NULL AUTO_INCREMENT,
  ownerId INT,
  petId INT,
  keeperId INT,
  bookId INT,
  PRIMARY KEY (person_bookId),
  FOREIGN KEY (ownerId) REFERENCES person (personId) ON DELETE SET NULL,
  FOREIGN KEY (petId) REFERENCES pet (petId) ON DELETE SET NULL,
  FOREIGN KEY (keeperId) REFERENCES person (personId) ON DELETE SET NULL,
  FOREIGN KEY (bookId) REFERENCES book (bookId) ON DELETE SET NULL,
  UNIQUE (ownerId, petId, keeperId, bookId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS pet_owner (
  pet_ownerId INT NOT NULL AUTO_INCREMENT,
  personId INT,
  petId INT,
  PRIMARY KEY (pet_ownerId),
  FOREIGN KEY (personId) REFERENCES person (personId) ON DELETE SET NULL,
  FOREIGN KEY (petId) REFERENCES pet (petId) ON DELETE SET NULL,
  UNIQUE (personId, petId)
)Engine=InnoDB;

INSERT INTO rol
VALUES (1, 'admin'),
       (2, 'owner'),
       (3, 'keeper');     
      
INSERT INTO person
VALUES (1, 'luis', 'gonzales', '64235875', 'luis@gmail.com', 'male', 1, 2),
       (2, 'ana', 'sanchez', '28542336', 'ana@gmail.com', 'female', 0, 2),
       (3, 'pedro', 'perez', '41528996', 'pedro@gmail.com', 'male', 0, 2),
       (4, 'carlos', 'garcia', '18968896', 'carlos@gmail.com', 'male', 1, 3),
       (5, 'susana', 'jerez', '39688964', 'susana@gmail.com', 'female', 0, 2),
	   (6, 'maria', 'rodriguez', '28542996', 'maria@gmail.com', 'female', 1, 3 ),
       (7, 'marcela', 'dominguez', '48538996', 'marcela@gmail.com', 'female', 0, 2),
       (8, 'martin', 'menendez', '19968896', 'martin@gmail.com', 'male', 0, 2),
       (9, 'cristian', 'huerta', '39634484', 'cristian@gmail.com', 'male', 1, 2),
       (10, 'daniel', 'zeta', '77777777', 'daniel@gmail.com', 'male', 0, 1);
      
INSERT INTO agenda
VALUES (1, '2022-10-26', '2022-10-30', 1, 4, 'small', 'dog', 700),
       (2, '2022-10-26', '2022-11-5', 0, 6, null, 'cat', 600);
              
INSERT INTO pet
VALUES (1, 'sasha', 'large', 'dog', 'golden retriever'),
       (2, 'bronco', 'medium', 'dog', 'bulldog'),
       (3, 'misa', 'small', 'cat', 'persian'),
       (4, 'olly', 'small', 'dog', 'poodle'),
       (5, 'wanted', 'small', 'cat', 'somali'),
	   (6, 'chuli', 'large', 'dog', 'doberman'),
       (7, 'musa', 'small', 'cat', 'siamese'),
       (8, 'snow', 'small', 'cat', 'somali'),
       (9, 'hueso', 'large', 'dog', 'rotewailer'),
       (10, 'lucky', 'medium', 'dog', 'siberian');      
       
INSERT INTO book
VALUES (12, '2022-10-26', '2022-10-30', 2),
 (2, '2022-10-26', '2022-10-30', 0),
 (3, '2022-10-26', '2022-10-30', 2);


INSERT INTO person_book
VALUES (1, 2, 4, 4, 1);

INSERT INTO pet_owner
VALUES (1, 5, 2),
       (2, 5, 6),     
       (3, 1, 3),     
       (4, 7, 7),     
       (5, 2, 4),     
       (6, 1, 10),
	   (7, 8, 8),     
       (8, 2, 1),     
       (9, 7, 5),     
       (10, 3, 9);