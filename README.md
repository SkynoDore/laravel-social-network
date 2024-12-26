Documentación Bluebill
1. Introducción
    Stack: Laravel + Inertia.js + React + Vite
    Nombre del Proyecto: BlueBill
    Descripción: Aplicación en Laravel para facturación electronica y gestión de procesos.
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

    o pedir al equipo que se les pase una copia de la base de datos.

    Instalar Dependencias Frontend, en la terminal introducir: 

    npm install
    npm run dev

3. Ejecución
    Iniciar el Servidor Local

    php artisan serve

3.1. En App/Providers/AppServiceProvider.php comentar las ultimas 4 lineas, quedando:
        // URL::forceScheme('https');
        // if (env('APP_ENV') !== 'local') {
        //     \URL::forceScheme('https');
        // }

2. Estructura del Proyecto

        app/: Contiene la lógica del negocio.
        bootstrap/: Archivo app.php para inicializar la aplicación.
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

        ¿Cómo Funciona Laravel + Inertia.js + React?
            Laravel (Backend)

                Laravel es el encargado de manejar las rutas, controladores, modelos y lógica del backend.
                En lugar de devolver vistas Blade, devuelve una respuesta especial de Inertia.js con los datos necesarios para la vista.

            Inertia.js (Middleware)

                Inertia.js actúa como un puente entre Laravel y React.
                Cuando una ruta es solicitada, Inertia.js envía una respuesta JSON que incluye:
                    El nombre del componente React que se debe renderizar.
                    Los datos necesarios para esa página.

            React (Frontend)

                React renderiza los componentes dinámicamente con los datos enviados desde Laravel a través de Inertia.js.
                La navegación entre páginas es rápida porque no se recarga toda la aplicación, solo los componentes React necesarios.

            Vite (Empaquetador)

                Vite es un empaquetador rápido para el frontend. Gestiona y construye tus archivos .jsx, .css, etc., para que sean accesibles desde el navegador.
                Durante el desarrollo, Vite permite hot reloading para que veas los cambios inmediatamente.
