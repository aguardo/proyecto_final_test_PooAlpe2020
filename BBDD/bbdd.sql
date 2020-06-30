CREATE DATABASE IF NOT EXISTS proyecto_test;
USE proyecto_test;

CREATE  TABLE test (
	id int NOT NULL AUTO_INCREMENT,
	description VARCHAR(100) NOT NULL,
	fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id)
);

CREATE  TABLE imagen (
	id int NOT NULL AUTO_INCREMENT,
	url VARCHAR(100) NOT NULL,
	PRIMARY KEY(id)
);


CREATE  TABLE pregunta(
	id int NOT NULL AUTO_INCREMENT,
	texto VARCHAR(255) NOT NULL,
	respuesta_correcta CHAR(1) NOT NULL,
	image_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (image_id) REFERENCES imagen(id)

);



CREATE  TABLE pregunta_test(
	id int NOT NULL AUTO_INCREMENT,
	pregunta_id int,
	test_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES pregunta(id),
	FOREIGN KEY (test_id) REFERENCES test(id)
	
);


CREATE  TABLE respuesta(
	id int NULL AUTO_INCREMENT,
	texto VARCHAR(255) NOT NULL,
	pregunta_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES pregunta(id)

);


CREATE  TABLE categoria(
	id int NULL AUTO_INCREMENT,
	texto VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)

);


CREATE  TABLE pregunta_categoria(
	id int NULL AUTO_INCREMENT,
	pregunta_id int,
	categoria_id int,
	PRIMARY KEY (id),
	FOREIGN KEY (pregunta_id) REFERENCES pregunta(id),
	FOREIGN KEY (categoria_id) REFERENCES categoria(id)
	
);