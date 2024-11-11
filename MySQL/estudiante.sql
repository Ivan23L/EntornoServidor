/* 
CRUD FUNCIONES BÁSICAS PARA BASES DE DATOS
-CREATE permite crear una tabla
-READ permite leer 
-
*/
USE animes_bd;	-- establece conexion con la base de datos
SELECT * FROM animes; -- selecciona todo de todos los animes 
/*INTENTAR NO PONER COMENTARIOS A LA HORA DE EJECUTAR EL SCRIPT*/
SELECT * FROM animes ORDER BY anno_estreno; -- orden ascendente ASC predeterminado
SELECT * FROM animes ORDER BY anno_estreno DESC;
SELECT * FROM animes WHERE titulo = "Frieren";
SELECT * FROM animes WHERE titulo LIKE "f%"; -- .* Todos los animes que comienzan por la letra F 
SELECT * FROM animes WHERE titulo LIKE "%n";
SELECT * FROM animes WHERE titulo LIKE "%a%"; -- Cualquier anime cuyo titulo contenga minimo una A
SELECT * FROM animes WHERE titulo LIKE "%frieren%"; -- por si hay varias temporadas devuelve todo lo que contenga frieren
SELECT * FROM animes WHERE titulo LIKE "%tragones%";
SELECT * FROM animes WHERE titulo LIKE "f%";
-- Mostrar el titulo nombre del estudio y anno de estreno de animes, cuyo anio está entre 2010 y 2020
SELECT titulo, nombre_estudio, anno_estreno 
	FROM animes
    WHERE anno_estreno BETWEEN 2010 AND 2020
    ORDER BY titulo;

SELECT * FROM estudios;
SELECT * FROM animes;

-- vamos a mostrar el titulo del anime, su estudio y la ciudad del estudio
SELECT a.titulo, e.nombre_estudio, e.ciudad
	FROM animes AS a JOIN estudios AS e
		ON a.nombre_estudio = e.nombre_estudio;
-- igualamos la clave foránea con la clave primaria con la que se relaciona

SET AUTOCOMMIT = 0; -- esto es el autoguardado en 0 está quitado
SET SQL_SAFE_UPDATES = 0; -- deshabilitamos el modo niños

/*
ESTOY BORRANDO LA BASE DE DATOS PARA VOLVER A LA COPIA DE SEGURIDAD
(NO RECOMIENDO HACER EN CASA)
*/
DELETE FROM animes;
SELECT * FROM animes;
ROLLBACK;
/*
	COMMIT -> GUARDAR
    ROLLBACK -> VOLVER AL ÚLTIMO PUNTO DE GUARDADO 
*/
/*
Una serie de instrucciones es atómica cuando se ejecuta como si fuera solamente 1
Si alguna de sus partes falla, todo falla y se deshacen los cambios
	UPDATE accounts SET saldo -= 30 WHERE id = "1331";
    UPDATE accounts SET saldo += 30 WHERE id = "012";
*/