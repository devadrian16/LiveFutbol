## Descripcion

Aplicacion sobre marcadores de futbol utilizando www.api-football.com para el proyecto de fin de grado en DAW.

## Requisitos

Laravel, composer, jetstream

## Descargar Dependencias del Proyecto

Como las dependencias del proyecto las maneja composer debemos ejecutar el comando:

> composer install

## Configurar Entorno

La configuración del entorno se hace en el archivo .env pero esé archivo no se puede versionar según las restricciones del archivo .gitignore, igualmente en el proyecto hay un archivo de ejemplo .env.example debemos copiarlo con el siguiente comando:

> cp .env.example .env
 
Luego es necesario modificar los valores de las variables de entorno para adecuar la configuración a nuestro entorno de desarrollo, por ejemplo los parámetros de conexión a la base de datos.
 
## Generar Clave de Seguridad de la Aplicación

> php artisan key:generate
 
## Migrar la Base de Datos
 
El proyecto ya tiene los modelos, migraciones y seeders generados. Entonces lo único que nos hace falta es ejecutar la migración y ejecutar el siguiente comando:
 
> php artisan migrate

## Archivo .htaccess(para redirigir a public todas las peticiones)

    IfModule mod_rewrite.c

    RewriteEngine on
    
    RewriteCond %{REQUEST_URI} !^public
    
    RewriteRule ^(.*)$ public/$1 [L]
    
    IfModule


