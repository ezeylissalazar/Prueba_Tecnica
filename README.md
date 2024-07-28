# Proyecto Laravel

Este proyecto es una aplicación Laravel que incluye autenticación, gestión de usuarios, empresas, actividades y conversión de moneda. Aquí se detallan los pasos para instalar y configurar el proyecto.

## Requisitos

- PHP >= 8.3
- Composer
- npm

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. Clona el repositorio:
    ```bash
    git clone https://github.com/ezeylissalazar/Prueba_Tecnica.git
    cd Prueba_Tecnica
    ```

2. Instala las dependencias de PHP:
    ```bash
    composer install
    composer update
    ```

3. Configura el archivo de entorno:
    ```bash
    cp .env.example .env
    ```

4. Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

5. Instala las dependencias de Node.js:
    ```bash
    npm install
    npm run build
    ```

6. Configura el archivo `.env` con tu usuario y clave de base de datos.

7. Ejecuta las migraciones y los seeders:
    ```bash
    php artisan migrate --seed
    ```

## Pruebas Unitarias

Para ejecutar las pruebas unitarias, utiliza el siguiente comando:
    ```bash
    php artisan test
    ```

## Proceso Batch de Importación

El comando de importación es:
    ```bash
    php artisan import:exchange-rates
    ```

1. Opciones de Importación:

2. Para importar todos los datos desde el archivo XML guardado en el proyecto:

El comando de importación es:
    ```bash
    php artisan import:exchange-rates --source=file
    ```

3. Para importar todos los datos desde el archivo XML guardado en el proyecto:

El comando de importación es:
    ```bash
    php artisan import:exchange-rates --source=file
    ```

4. Para importar una cantidad limitada de registros desde el archivo XML:

El comando de importación es:
    ```bash
    php artisan import:exchange-rates --limit=10 --source=file
    ```

5. Para importar desde una URL en lugar de un archivo:

El comando de importación es:
    ```bash
    php artisan import:exchange-rates --source=url
    ```

## Configuración del Correo Electrónico

Para cambiar el correo de envío, edita las siguientes variables en el archivo .env:

MAIL_USERNAME=pruebatecnica717@gmail.com
MAIL_FROM_ADDRESS=pruebatecnica717@gmail.com
MAIL_PASSWORD=brdoknldiealwzdv






