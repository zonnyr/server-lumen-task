# Servidor del desafío de tareas

Para este proyecto utilizamos lumen en el lado del servidor y react en el lado del cliente

## Pasos a seguir para la instalacion 

1)	Para iniciar la instalacion, vamos a crear un archivo llamado .env 
	este archivo nos ayudara con la conexion a la base de datos (hey un ejemplo llamado .env.example)
	dentro de el colocars tus datos de acceso al servidor de la BD, nombre de la tabla,
	nombre de usuario, y contaseña

2	abrir una consola y ejecutar el comando: composer install , 
	esto instala archivos necesarios para la ejecucion del proyecto

2)	luego ejecutar el comando: php artisan migrate:refresh
	para que se creen las tablas en la bases de datos

3) 	Ejecuta el comando: php artisan jwt:secret y luego: php artisan cache:clear
	esto es para crear la clave secreta del JWT y limpiamos cahce

4)	ejecuta el comando para correr el proyecto de lumen: php -S localhost:8000 -t public
	y ya el proyecto deberia estar andando sin problemas

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
