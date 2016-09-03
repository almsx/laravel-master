<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/about", function () {
    return "Nosotros <strong>somos</strong> ...";
});

Route::get("user/{id}", function ($id) {
    return "id: " . $id;
});

Route::get("saludar/{nombre?}", function ($nombre = "Anónimo") {
    return "Hola " . $nombre;
});

Route::get("/usuario/{id?}", function ($id = NULL) {
    if ($id == NULL) {
        return "El usuario no existe";
    }

    $usuarios = [123 => "pepe", 321 => "ash", 465 => "saul"];

    // return "Nombre " . $usuarios[$id];
    return view("usuario", [ "username" => $usuarios[$id] ]);
});