/*creacion de base de datos */
CREATE DATABASE tienda_master;
USE tienda_master;

CREATE TABLE usuarios(
id int(255) auto_increment NOT NULL,
nombre  varchar(100) NOT NULL,
apellido    varchar(100) NOT NULL,
email   varchar(255) NOT NULL,
password varchar(255) NOT NULL,
rol varchar(20),
imagen varchar(255),
CONSTRAINT pk_usuario PRIMARY KEY (id),
CONSTRAINT uq_email UNIQUE (email)
)ENGINE=InnoDB;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'admin', 'admin@admin.com.ar', '0000', 'admin', NULL);


CREATE TABLE categoria(
id int(255) auto_increment NOT NULL,
nombre  varchar(100) NOT NULL,
CONSTRAINT pk_categoria PRIMARY KEY (id)
)ENGINE=InnoDB;

INSERT INTO categoria VALUES(NULL, 'Manga corta');
INSERT INTO categoria VALUES(NULL, 'Tirantes');
INSERT INTO categoria VALUES(NULL, 'Manga larga');
INSERT INTO categoria VALUES(NULL, 'Sudaderas');

CREATE TABLE productos(
    id int(255) auto_increment NOT NULL,
    categoria_id int(255) NOT NULL,
    nombre varchar(25) NOT NULL,
    descripcion text,
    precio float(100,2) NOT NULL,
    stock int(255) NOT NULL,
    oferta varchar(2),
    fecha date NOT NULL,
    imagen varchar(255),
    CONSTRAINT pk_producto PRIMARY KEY (id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id) REFERENCES categoria(id)
)ENGINE= InnoDB;
CREATE TABLE pedidos(
    id int(255) auto_increment NOT NULL,
    usuario_id int(255) NOT NULL,
    provincia varchar(50) NOT NULL,
    localidad varchar(100) NOT NULL,
    direccion varchar(255) NOT NULL,
    coste float(200,2) NOT NULL,
    estado varchar(20) NOT NULL,
    fecha date,
    hora time,
    CONSTRAINT pk_pedidos PRIMARY KEY (id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos(
    id int(255) auto_increment NOT NULL,
    pedido_id int(255) NOT NULL,
    producto_id int(255) NOT NULL,
    unidades int(50) NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY (id),
    CONSTRAINT fk_lineas_pedido_id FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_lineas_pedido_producto FOREIGN KEY (producto_id) REFERENCES productos(id)
    )ENGINE=InnoDB;