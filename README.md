Documentación Bluebill
1. Introducción
    Stack: Laravel + Blade with Alpine + Pest testing framework + Tailwind + Mariadb.
    Breeze Starter kit

    Nombre del Proyecto: BlueBill

    Descripción: Un simple feed donde usuarios verificados puedan subir sus noticias

    Requisitos Previos:  

        XAMP o descargar por separado PHP 8.x y MySQL
        Composer
        Node.js
        npm
 
 2. Instalación
    Clonar el Proyecto

        git clone https://github.com/larnreact1511/bluebill-v3
        cd bluebill-v3

    Descargar e Instalar Dependencias

    Configurar Variables de Entorno

    Copia el archivo .env.example y renómbralo como .env:

        cp .env.example .env

    Edita el archivo .env y reemplaza los datos de acceso de la base de datos con los tuyos.

    installar composer:

        composer install

    Generar la Clave de la Aplicación:

        php artisan key:generate

    Exportar la Base de Datos

        php artisan migrate 

    Instalar Dependencias Frontend, en la terminal introducir: 

        npm install
        npm run dev

    Crear el enlace simbólico para la carpeta de almacenamiento:

        php artisan storage:link

3. Ejecución
    Iniciar el Servidor Local

        php artisan serve


2. Estructura del Proyecto

        app/: Contiene la lógica de la aplicación.
        bootstrap/: Archivo app.php para inicializar la aplicación. No está relacionado con front-end ni con Bootstrap CSS.
        config/: Archivos de configuración del proyecto.
        database/: Migraciones, seeders y archivos relacionados con la base de datos.
        public/: Carpeta accesible públicamente.
        resources/: Vistas, archivos de idioma y recursos front-end.
        resources/app.jsx: Punto de entrada principal
        resources/Pages/: Componentes React por página
        routes/: Define las rutas web, API, etc.
        storage/: Archivos generados por la aplicación (logs, caché).
        tests/: Pruebas unitarias y funcionales.
        vendor/: Dependencias gestionadas por Composer.

3. luego en produccion fijarse de que upload_max_filesize y post_max_size sea de almenos 10240

