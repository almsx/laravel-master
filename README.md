# Curso de Laravel

## Contenido

### Parte 1: Introducción a Laravel

La necesidad de Frameworks | Instalación de Vagrant | Un nuevo enfoque en el desarrollo de aplicaciones PHP | Características y recursos en Laravel | Estructura de una aplicación Laravel

### Parte 2: Configuración del entorno de Desarrollo

Trabajo con la línea de comandos | Reuniendo composiciones | Homestead | Creación de una nueva aplicación Laravel | Comandos Homestead | Pasos para comenzar un nuevo proyecto Laravel |

### Parte 3: Tu primer aplicación

Planeación de tu primer aplicación | Comenzar tu primer aplicación | Escribiendo las prieras rutas | Preparación de la base de datos | Mover desde un simple routing a poderosos controladores | Array helpers | Trabajo con archivos

### Parte 4: ORM Elocuente

Recuperando datos | Guardar datos | Borrar datos | Ámbitos de consulta | Relaciones | Modelo de eventos | Colecciones

### Parte 5: Testing

Beneficios de hacer Testing | Anatomía de un Test | Pruebas unitarias con PHPUnit | Pruebas de extremo a extremo

### Parte 6: Línea de comandos

Mantenerse al día con los últimos cambios | Inspeccionar e interactuar con tu aplicación | Despliegue de tus propios comandos | Programación de comandos

### Parte 7: Autenticación y Seguridad

Autenticación de usuarios | Asegurando tu aplicación

## Enlaces de interés

## Noticias

## Tareas



## Sesión 1

* __Rutas__: las rutas son direcciones url del sitio web que provee la aplicación. Existen tres tipos de rutas: `api`, `console` y `web` definidas cada una en la carpeta `/routes` la cual contiene tres archivos: `api.php`, `console.php` y `web.php` respectivamente. Las rutas `api` se basan en el sistema `middleware` para consumir servicios en forma de api como se verá más adelante. Las rutas `console` ejecutan un comando directo sobre nuestro sistema a través de una linea de comando como veremos en otras sesiones. Finalmente las rutas `web` son rutas tradicionales que tienen el objetivo de mostrar información al usuario como la página de bienvenida o páginas de nuestro sitio, pero también establecen rutas para presentar y procesar formularios mediante peticiones de tipo `get`, `post`, `put`, `delete`, `patch` y `options` que se hirán utilizando conforme avancemos en el curso.
* __Crear una ruta tipo GET__: para establecer una ruta `web` de tipo `get`, es decir, una ruta que pueda abrir cualquier navegador, debemos editar el archivo `/routes/web.php` y añadir la ruta mediante la clase `Route`; dicha clase posee un método estático llamado `get` el cual podremos invocar mediante `Route::get(...)`. El primer parámetro solicitado por la función es la `$uri` que establezcamos a partir de nuestro dominio, ejemplo `"/about"` establecerá la ruta `http://midomidio/about`. El segundo parámetro es el controlador de la solicitud, el cual consiste en una función `$handler` o `$callback` que será llamada cada que se haga una petición a la _url_ especificada de tipo _get_. Normalmente se define una función anónima (sin nombre o no nombrada) la cual debe regresar un texto que será el resultado de la petición, ejemplo `Route::get("/about", function () { return 'Hola mundo'; });`, entonces cada que llamemos a la _url_ `.../about` veremos en pantalla un texto que dice `Hola mundo`. Podemos incluir elementos _html_ e incluso devolver todo el contenido _html_ pero no es muy eficiente y para eso veremos las `vistas`.
* __Crear una ruta variable tipo GET__: otra propiedad que tienen las `rutas` es la capacidad de crear rutas variables, mediante un conjunto de parámetros y una sintaxis definida en la _uri_. Para crear una variable debemos especificar en la _uri_ cual debe ser la variable esperada en la _uri_, ejemplo `/saludar/{nombre}`, entonces las rutas válidas serán `.../saludar/ash`, `.../saludar/brock`, `.../saludar/misty`, etc. Sin embargo las rutas `.../saludar` y `.../saludar/` no serán válidas. Cada variable que coloquemos en la _uri_ será enviada a la función `$callback` como un parámetro, ejemplo `Route::get('/saludar/{nombre}', function ($nombre) { return "Hola " . $nombre; });`, `Route::get("/usuario/{nombre}/{tipo}", function ($n, $t) { ... });`. Observe que el nombre de variable de la _uri_ no tiene que ser exactamente el mismo que el del _callback_.
* __Variables opcionales__: existirán casos en los que la ruta contenga algunos parámetros opcionales, por ejemplo si queremos que la ruta `/usuario` o `/usuario/` nos lleve al perfil del usuario que ha accedido con su cuenta, pero `/usuario/ash` nos lleve a ver el perfil público del usuario `ash`, entonces haríamos `Route::get("/usuario/{nombre?}", function ($nombre = NULL) { ... });` observe que en la _uri_ hemos marcado la variable con `?` como sufijo y en la función _callback_ hemos asignado la variable de ese parámetro a un valor que en este caso es NULL. Con eso dentro de nuestra función _callback_ podemos preguntar si el valor de `$nombre` es `NULL` y realizar cierta lógica y si no también realizar cierta lógica.
