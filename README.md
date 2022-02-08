## Instrucciones de despliegue

1. Copiar el archivo .env.example y renombrarlo a .env
2. Cambiar en el archivo .env todos los datos correspondientes al ambiente en que se va a desplegar el aplicativo.
3. En la terminal: ```composer install```
4. Instalar Node JS, si aún no se ha instalado.
5. En la terminal: ```npm install```
6. En la terminal: ```npm run dev``` (Puede que la primera vez que se ejecute aparezca un error. Se soluciona volviendo a correr este mismo comando).
7. Se crea una base de datos vacía con el nombre: proyectoFinalPrWeb
8. Correr las migraciones con el comando ```php artisan migrate```. Vendrán algunos registros por defecto en la base de datos.
9. Para el funcionamiento de las imágenes se debe correr el comando: ```php artisan storage:link```.
10. Para correr el proyecto, se corre el comando ```php artisan serve```.
