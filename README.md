Instrucciones para la instalación:

1.Descargar el repositorio y ponerlo en la carpeta adecuada del servidor (./www/gesgym/).

2.Crear la base de datos importando el archivo "database.sql" o ejecutando el código que se encuentra en su interior desde el gestor de la base de datos (phpMyAdmin).

3.Ejecutar el siguiente comando para crear un usuario y darle persimos en la base de datos:

	grant all privileges on mvcblog.* to mvcuser@localhost identified by "mvcblogpass";
	
4.Arrancar el servidor y acceder desde un navegador con la URL que corresponda.