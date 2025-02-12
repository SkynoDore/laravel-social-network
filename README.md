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

4. Overview de la logica

Al modificar tablas de la bbdd, primero evaluar cambios y luego hacer migraciones con
    php artisan:make migration "name"
Luego ejecutar migracion con: 
    php artisan migrate

realizar modelo:
    php artisan make:model Comment

debes definir los campos que pueden ser asignados masivamente ($fillable) y los que deben permanecer protegidos ($guarded). 
para establecer relacion con otros modelos:

Ejemplo para relacionar tabla "comments" a la tabla "note

    en el nuevo modelo:
         public function note()
        {
        return $this->belongsTo(Note::class, 'note_id');
        }

    → Un comentario pertenece a una nota.


    En el modelo viejo:

        public function comments()
        {
        return $this->hasMany(Comment::class, 'note_id');
        }

        → Una nota tiene muchos comentarios.

     Con esto, puedes obtener todos los comentarios de una nota con:
         $note = Note::find(1);
         $comments = $note->comments;

     O encontrar la nota a la que pertenece un comentario con:
         $comment = Comment::find(1);
          $note = $comment->note;

    Para crear controlador:
        php artisan make:controller "name"
