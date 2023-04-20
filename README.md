# Lofty - Simplificando pagos
## Backend API

### Prerequisitos
* Apache web server 
    * Habilitar modulo headers para CORS
* Habilitar mod_rewrite
* PHP 8.x
* Composer 2.x
* MySQL
* Libreria GD

#### Instalación
1. Clonar este repositorio
2. Crear una base de datos en limpio
3. Copiar archivo ``` .env.example ```  como ``` .env ``` y configurar la base de datos
4. Con la consola de comandos (CLI), ir a la carpeta root del sistema y ejecutar el comando composer install
5. Generar la llave de la app: ``` php artisan key:generate ```
6. Ejecutar ``` php artisan migrate ``` para generar las tablas
    * Nota: Si desea limpiar la base de datos ejecute el comando: ```php artisan migrate:refresh ```
7. Ejecutar  ``` php artisan db:seed ```  para llenar los catalagos del sistema

#### Finalizar instalación
8. Asegurarse que el servidor tenga habilitado el módulo CORS, de lo contrario la app no podrá consumir los endpoints.

### Swagger
Las especificaciones de la API están documentadas con Swagger. Para habilitarla, siga los siguientes pasos:

1. Ejecutar el comando npm install
2. Ejecutar el comando npm run dev


# Información Adicional

Powered by:

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<b>Version 10.1.1</b>