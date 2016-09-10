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
* __Vistas__: Aunque podemos regresar contenido _html_ en las rutas, esto no es lo más eficiente, ya que no hay una estructura diferenciable que nos permita reciclar y modificar código fácilmente. Por esto necesitas del uso de _vistas_ y _plantillas_ de vista. Una vista es un archivo _php_ que es enviado al usuario como un _html_, pero antes de enviar el archivo _php_ puede cambiar atributos y generar código mediante el esquema de plantillas llamado _blade_, ejemplo suponga que necesita enviar los datos de un usuario como su nombre, correo y foto de perfil, entonces lo común sería enviar un archivo como el siguiente:

> __php__ - Ejemplo de un _html_ para el perfil de un usuario

~~~php
<!DOCTYPE html>
<html>
  <head>
    <title>Perfil de Ash</title>
  </head>
  <body>
    <img src="http://tumblr.com/imagen_de_ash">
    <h1>Ash</h1>
    <h2>ash.pikachu@pokemon.com</h2>
  </body>
</html>
~~~

* El código anterior sería útil para mostrar el perfil de _ash_, pero que pasa si queremos ahora enviar el perfil de _brock_, entonces enviaríamos un archivo similar sólo modificando ciertos campos, aquí es donde entra _blade_ (el sistema de plantillas) el cual propone una sintaxis fácil para sustituir elementos dentro de nuestra página. Un ejemplo de una platilla _blade_ que resolvería el problema anterior sería:

> __php/blade__ - Plantilla para generar un _html_ con los datos de perfil de un usuario

~~~php
<!DOCTYPE html>
<html>
  <head>
    <title>Perfil de {{ $nombre }}</title>
  </head>
  <body>
    <img src="{{ $imagen }}">
    <h1>{{ $nombre }}</h1>
    <h2>{{ $correo }}</h2>
  </body>
</html>
~~~

* La página anterior luce similar, pero antes de enviarla sustituye los valores de los campos y variables por lo que le sean pasados, de esta forma generalizamos una misma vista que puede generar infinidad de variaciones pero conservando el mismo diseño y estructura. Para definir una vista debemos crear un archivo con extensión `.blade.php` en la carpeta `/resources/views`, ejemplo `/resources/views/perfil.blade.php`. Para utilizar dicha vista dentro de nuestra ruta debemos regresar la vista procesada por la función `view` la cual recibe como primer parámetro una cadena con el nombre de la vista sin la extensión `.blade.php` y como segundo parámetro un diccionario con los valores utilizados en la vista, donde la clave será el nombre de la variable utilizada en la vista y el valor será el valor que se pondrá en la vista, ejemplo

> __php__ - [__/resources/routes/web.php__] Ruta que utiliza la vista `perfil.blade.php`

~~~php
Route::get('/perfil', function () {
  return view("perfil", [ "nombre" => 'Ash', 'imagen' => "http://.../ash.png", "correo" => "ash.pikachu@pokemon.com" ]);
});
~~~

* Observe que debe existir el archivo `/resources/views/perfil.blade.php` y que los valores enviados en el diccionario serán los que se sustituyan en la plantilla. Con forme avance el curso se verán más opciones que tiene _blade_.
* __Modelos Elocuentes y Base de Datos__: un modelo es una abstración de un conjunto de datos que representa entidades en nuestro sistema, por ejemplo, si tuvieramos a cargo un centro de salud pokemón necesitariamos almacenar en nuestro sistema los datos de un pokemón, los datos del entrenador, los datos de una consulta, los datos estadísticos o de salud y las relaciones entre estos. Para esto abstraemos cada una de las entidades en modelos que generalicen la descripción de las entidades. Por ejemplo:

> __model__: Modelo que representa los datos de un pokemon

~~~txt
Pokemon:
  Nombre
  Tipo1
  Tipo2
  Salvaje?
  Estatura
  Peso
  PoderAtaque
  PoderDefensa
  SaludMaxima
  SaludActual
  Sexo
~~~

* Podríamos alargar la lista de atributos tanto como quisieramos, pero seguiremos la filosofía de buscar el mínimo de atributos que representen un modelo, esto nos permitirá crear rápidamente prototipos funcionales que podamos incrementar poco a poco según se requiera, por ejemplo, el atributo _BatallasGanadas_ no nos interesa de momento, por lo que no es necesario incluirlo desde el principio y mejor hacer una migración cuando se requiera, lo cual se verá más adelante.
* __Modelos Elocuentes__: Para que un modelo sea elocuente con la base de datos se siguen un conjunto de reglas que pueden modificarse para que el desarrollo sea rápido. Por cada modelo propuesto debe existir en la base de datos una tabla con el mismo nombre, en minúsculas y en plural (sufijo `s`), ejemplo si el modelo es `Pokemon` deberá existir una tabla llamada `pokemons`. Dicha tabla debe contener un campo llamado `id` autoincremental y marcado como llave primaria y dos campos de tipo `timestamp` llamado `created_at` y `updated_at`, sin embargo dichas convenciones se pueden deshabilitar si no queremos esto.
* __Configurar la base de datos__: la base de datos debe configurarse desde el archivo `/config/database.php` el cual contiene un objeto donde podemos modificar el tipo de base de datos (`mysql` por defecto) y los parámetros de conexión como el nombre de la base de datos, el usuario y la contraseña.
* __Ejecutar un query en la base de datos__: podemos ejecutar un query directamente a la base de datos mediante los métodos `select`, `insert`, `update`, `delete` y `statment` de la clase `DB`, ejemplo `$pruebas = DB::select("select * from test where descripcion like '%hola%';");`.
