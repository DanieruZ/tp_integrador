CREATE DATABASE IF NOT EXISTS pets;
USE pets;

CREATE TABLE IF NOT EXISTS rol (
  rolId INT NOT NULL AUTO_INCREMENT,
  rol VARCHAR(50) NOT NULL,
  PRIMARY KEY (rolId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS person (
  personId INT NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  dni VARCHAR(10) NOT NULL,
  email VARCHAR(50) NOT NULL,
  gender ENUM('female', 'male', 'other') NOT NULL,
  isActive BOOLEAN NOT NULL DEFAULT '0',
  rolId INT NOT NULL,
  PRIMARY KEY (personId),  
  FOREIGN KEY (rolId) REFERENCES rol (rolId),  
  UNIQUE (dni, email) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS review (
  reviewId INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL,
  message VARCHAR(50) NOT NULL,
  rate INT NOT NULL,
  personId INT NOT NULL,
  PRIMARY KEY (reviewId),
  FOREIGN KEY (personId) REFERENCES person (personId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS agenda (
  scheduleId INT NOT NULL AUTO_INCREMENT,
  startDate DATE NOT NULL,
  endDate DATE NOT NULL,
  state BOOLEAN DEFAULT '0',
  personId INT NOT NULL,
  size VARCHAR(50),
  pet_type VARCHAR(50),
  cost FLOAT,
  PRIMARY KEY (scheduleId),
  FOREIGN KEY (personId) REFERENCES person (personId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS pet (
  petId INT NOT NULL AUTO_INCREMENT,
  petname VARCHAR(50) NOT NULL,
  size ENUM('small', 'medium', 'large' , 'x-large') NOT NULL,
  pet_type ENUM('dog', 'cat', 'bird') NOT NULL,
  breed VARCHAR(50) NOT NULL,
  thumbnail LONGBLOB NOT NULL,
  vaccination LONGBLOB NOT NULL,
  PRIMARY KEY (petId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE gallery (
 imageId INT NOT NULL AUTO_INCREMENT,
 image LONGBLOB NOT NULL,
 created DATETIME NOT NULL,
 petId INT,
 PRIMARY KEY (imageId),
 FOREIGN KEY (petId) REFERENCES pet (petId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS book (
  bookId INT NOT NULL AUTO_INCREMENT,
  startDateBook DATE NOT NULL,
  endDateBook DATE NOT NULL,
  stateBook BOOLEAN DEFAULT '0',
  statePayment BOOLEAN DEFAULT '0',
  stateReview BOOLEAN DEFAULT '0',
  personId INT NOT NULL,
  PRIMARY KEY (bookId),
  FOREIGN KEY (personId) REFERENCES person (personId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS person_book (
  person_bookId INT NOT NULL AUTO_INCREMENT,
  ownerId INT,
  petId INT,
  bookId INT,
  PRIMARY KEY (person_bookId),
  FOREIGN KEY (ownerId) REFERENCES person (personId) ON DELETE SET NULL,
  FOREIGN KEY (petId) REFERENCES pet (petId) ON DELETE SET NULL,
  FOREIGN KEY (bookId) REFERENCES book (bookId) ON DELETE SET NULL,
  UNIQUE (ownerId, petId, bookId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS pet_owner (
  pet_ownerId INT NOT NULL AUTO_INCREMENT,
  personId INT,
  petId INT,
  PRIMARY KEY (pet_ownerId),
  FOREIGN KEY (personId) REFERENCES person (personId) ON DELETE SET NULL,
  FOREIGN KEY (petId) REFERENCES pet (petId) ON DELETE SET NULL,
  UNIQUE (personId, petId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
       (10, 'admin', 'admin', '12345', 'admin@gmail.com', 'male', 0, 1);
              
INSERT INTO pet
VALUES (1, 'sasha', 'large', 'dog', 'collie', '', ''),
       (2, 'bronco', 'medium', 'dog', 'bulldog', '', ''),
       (3, 'misa', 'small', 'cat', 'red cat', '', ''),
       (4, 'olly', 'small', 'dog', 'poodle', '', ''),
       (5, 'wanted', 'small', 'cat', 'somali', '', ''),
	   (6, 'chuli', 'large', 'dog', 'doberman', '', ''),
       (7, 'musa', 'small', 'cat', 'siamese', '', ''),
       (8, 'snow', 'small', 'cat', 'somali', '', ''),
       (9, 'hueso', 'large', 'dog', 'rotewailer', '', ''),
       (10, 'lucky', 'medium', 'dog', 'siberian', '', '');      

INSERT INTO pet_owner
VALUES (1, 5, 2),
       (2, 5, 6),     
       (3, 1, 4),     
       (4, 7, 7),     
       (5, 2, 3),     
       (6, 1, 10),
	   (7, 8, 8),     
       (8, 2, 1),     
       (9, 7, 5),     
       (10, 3, 9);