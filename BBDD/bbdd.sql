CREATE DATABASE IF NOT EXISTS proyecto_test;
USE proyecto_test;

CREATE TABLE IF NOT EXISTS preguntas(
	id int NOT NULL AUTO_INCREMENT,
	texto VARCHAR(255),
	respuesta_correcta CHAR(1),
	PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS respuestas(
	id int NULL AUTO_INCREMENT,
	texto VARCHAR(255),
	pregunta_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES preguntas(id)

);


CREATE TABLE IF NOT EXISTS categorias(
	id int NULL AUTO_INCREMENT,
	texto VARCHAR(255),
	PRIMARY KEY (id)

);


CREATE TABLE IF NOT EXISTS preguntas_categorias(
	id int NULL AUTO_INCREMENT,
	pregunta_id int,
	categoria_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES preguntas(id),
	FOREIGN KEY (categoria_id) REFERENCES categorias(id)
	
);





