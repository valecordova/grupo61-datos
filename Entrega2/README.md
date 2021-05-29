La carga de datos no nos funcionó porque fue lo último que vimos, está el archivo para hacer la carga, los errores son por duplicados y porque habían errores en el orden, pero tomando el orden correcto debería funcionar. Este es como se crearon las tablas: CREATE TABLE Direcciones (id int PRIMARY KEY, nombre varchar(200) NOT NULL, comuna varchar(30) NOT NULL);

CREATE TABLE Tiendas (id int PRIMARY KEY, nombre varchar(50) NOT NULL, did int NOT NULL, id_jefe int NOT NULL,comuna varchar(30) NOT NULL,  FOREIGN KEY(did) REFERENCES Direcciones(id));

CREATE TABLE Productos (id int NOT NULL, PRIMARY KEY(id), nombre varchar(40) NOT NULL, descripcion varchar(50) NOT NULL, precio int NOT NULL, CHECK( precio BETWEEN 1 AND 10000000));

CREATE TABLE Vende (id int, id_producto int NOT NULL, id_tienda int NOT NULL, PRIMARY KEY(id), FOREIGN KEY(id_producto) REFERENCES Tiendas(id), FOREIGN KEY(id_tienda) REFERENCES Productos(id));

CREATE TABLE Trabajadores (id int PRIMARY KEY, nombre varchar(100), rut varchar(12) NOT NULL, edad int NOT NULL, sexo varchar(10) NOT NULL, tid int NOT NULL, FOREIGN KEY(tid) REFERENCES Tiendas(id), CHECK( edad BETWEEN 12 AND 150));

CREATE TABLE Usuarios (id int,  nombre varchar(50) NOT NULL, sexo varchar(10) NOT NULL, rut varchar(12) NOT NULL, edad int NOT NULL, did int NOT NULL, CHECK( edad BETWEEN 12 AND 150), FOREIGN KEY(did) REFERENCES Direcciones(id));

CREATE TABLE Compras (id int NOT NULL, cantidad int NOT NULL, tid int NOT NULL, uid int NOT NULL, precio int NOT NULL, FOREIGN KEY(tid) REFERENCES Tiendas(id), FOREIGN KEY(uid) REFERENCES Usuarios(id), CHECK( precio >= 1));

CREATE TABLE PNoComestibles (id int NOT NULL, alto int NOT NULL, largo int NOT NULL, ancho int NOT NULL, peso int NOT NULL, CHECK(alto > 0), CHECK(largo > 0), CHECK(ancho > 0), CHECK(peso > 0));

CREATE TABLE PComestibles (id int NOT NULL, f_expiracion date NOT NULL);

CREATE TABLE PCongelados (id int NOT NULL, peso int NOT NULL, CHECK(peso > 0));

CREATE TABLE PFrescos (id int NOT NULL, t_t_ambiente int NOT NULL, CHECK(t_t_ambiente > 0));

CREATE TABLE PConserva (id int NOT NULL, m_conservacion varchar(10) NOT NULL);
