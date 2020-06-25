CREATE DATABASE IF NOT EXISTS proyecto_test;
USE proyecto_test;

CREATE TABLE IF NOT EXISTS test (
	id int NULL AUTO_INCREMENT,
	description VARCHAR(100),
	fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id)
);


CREATE TABLE IF NOT EXISTS imagen (
	id int NULL AUTO_INCREMENT,
	url VARCHAR(100),
	PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS pregunta(
	id int NOT NULL AUTO_INCREMENT,
	texto VARCHAR(255),
	respuesta_correcta CHAR(1),
	image_id int,
	test_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (image_id) REFERENCES imagen(id),
	FOREIGN KEY (test_id) REFERENCES test(id)

);


CREATE TABLE IF NOT EXISTS respuesta(
	id int NULL AUTO_INCREMENT,
	texto VARCHAR(255),
	pregunta_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES pregunta(id)

);


CREATE TABLE IF NOT EXISTS categoria(
	id int NULL AUTO_INCREMENT,
	texto VARCHAR(255),
	PRIMARY KEY (id)

);


CREATE TABLE IF NOT EXISTS pregunta_categoria(
	id int NULL AUTO_INCREMENT,
	pregunta_id int,
	categoria_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES pregunta(id),
	FOREIGN KEY (categoria_id) REFERENCES categoria(id)
	
);

CREATE TABLE IF NOT EXISTS test (
	id int NULL AUTO_INCREMENT,
	description VARCHAR(100),
	fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id)
);






