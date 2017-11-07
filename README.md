Instrucciones para la instalación:

1.Descargar el repositorio y ponerlo en el servidor.

2.Crear la base de datos (archivo "database.sql" en la raiz del repositorio).

3.Crear usuario y darle persimos en la base de datos con el siguiente comando:

	grant all privileges on mvcblog.* to mvcuser@localhost identified by "mvcblogpass";
	
4.Arrancar el servidor y acceder desde un navegador con la URL que corresponda.