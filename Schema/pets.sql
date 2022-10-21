CREATE DATABASE IF NOT EXISTS pets;
USE pets;

CREATE TABLE IF NOT EXISTS rol (
  rolId INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(50) NOT NULL,
  PRIMARY KEY (rolId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS agenda (
  scheduleId INT NOT NULL AUTO_INCREMENT,
  fechaInicio date,
  fechaFin date,  
  PRIMARY KEY (scheduleId)
  )Engine=InnoDB;

CREATE TABLE IF NOT EXISTS person (
  personId INT NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  dni VARCHAR(10) NOT NULL,
  email VARCHAR(50) NOT NULL,
  pass VARCHAR(50) NOT NULL,
  gender ENUM('female', 'male', 'other') NOT NULL,
  isActive BOOLEAN NOT NULL,
  rolId INT NOT NULL,
  scheduleId int NULL,
  PRIMARY KEY (personId),
  FOREIGN KEY (rolId) REFERENCES rol (rolId),
  FOREIGN KEY (scheduleId) REFERENCES agenda (scheduleId),
  UNIQUE (dni, email) 
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS pet (
    petId INT NOT NULL AUTO_INCREMENT,
    petname VARCHAR(50) NOT NULL,
    size ENUM('small', 'medium', 'large' , 'x-large') NOT NULL,
    pet_type ENUM('dog', 'cat', 'bird') NOT NULL,
    breed VARCHAR(50) NOT NULL,
    PRIMARY KEY (petId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS pet_owner (
    pet_ownerId INT NOT NULL AUTO_INCREMENT,
    personId INT NOT NULL,
    petId INT NOT NULL,
    PRIMARY KEY (pet_ownerId),
    FOREIGN KEY (personId) REFERENCES person (personId),
    FOREIGN KEY (petId) REFERENCES pet (petId),
    UNIQUE (personId, petId)
)Engine=InnoDB;



INSERT INTO rol
VALUES (1, 'admin'),
       (2, 'owner'),
       (3, 'keeper');
       
INSERT INTO person
VALUES (1, 'luis', 'gonzales', '64235875', 'luis@gmail.com', '123', 'male', 1, 2),
       (2, 'ana', 'sanchez', '28542336', 'ana@gmail.com', '123', 'female', 1, 2),
       (3, 'pedro', 'perez', '41528996', 'pedro@gmail.com', '123', 'male', 1, 2),
       (4, 'carlos', 'garcia', '18968896', 'carlos@gmail.com', '123', 'male', 1, 3,1),
       (5, 'susana', 'jerez', '39688964', 'susana@gmail.com', '123', 'female', 0, 3),
	     (6, 'maria', 'rodriguez', '28542996', 'maria@gmail.com', '123', 'female', 1, 3),
       (7, 'marcela', 'dominguez', '48538996', 'marcela@gmail.com', '123', 'female', 1, 3),
       (8, 'martin', 'menendez', '19968896', 'martin@gmail.com', '123', 'male', 1, 2),
       (9, 'cristian', 'huerta', '39634484', 'cristian@gmail.com', '123', 'male', 1, 3),
       (10, 'sara', 'connor', '39655784', 'sara@gmail.com', '123', 'female', 1, 2),
       (11, 'sol', 'jaimez', '65499325', 'sol@gmail.com', '123', 'female', 1, 2),
       (12, 'silvia', 'fernandez', '18963584', 'silvia@gmail.com', '123', 'female', 1, 2),
       (13, 'joe', 'figueroa', '58969872', 'joe@gmail.com', '123', 'male', 1, 2),
       (14, 'maica', 'herrera', '21563332', 'maica@gmail.com', '123', 'female', 1, 2),
       (15, 'daniel', 'zeta', '77777777', 'daniel@gmail.com', '123', 'male', 1, 1);
              
INSERT INTO pet
VALUES (1, 'sasha', 'large', 'dog', 'golden retriever'),
       (2, 'bronco', 'large', 'dog', 'doberman'),
       (3, 'misa', 'small', 'cat', 'persian'),
       (4, 'olly', 'small', 'dog', 'poodle'),
       (5, 'wanted', 'small', 'cat', 'somali'),
	     (6, 'chuli', 'large', 'dog', 'rotewailer'),
       (7, 'musa', 'small', 'cat', 'siamese'),
       (8, 'snow', 'small', 'cat', 'siamese'),
       (9, 'hueso', 'medium', 'dog', 'bulldog'),
       (10, 'lucky', 'large', 'dog', 'siberian');      
       
INSERT INTO pet_owner
VALUES (1, 10, 2),
       (2, 8, 6),     
       (3, 13, 3),     
       (4, 2, 7),     
       (5, 8, 4),     
       (6, 14, 10),
	     (7, 11, 8),     
       (8, 12, 1),     
       (9, 1, 5),     
       (10, 3, 9);

       INSERT INTO agenda
VALUES (1, '2022-10-20', '2022-10-25')
