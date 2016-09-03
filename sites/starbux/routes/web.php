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

Route::get("/prueba", function () {
    $pruebas = DB::select("select * from test where descripcion like '%hola%';");

    return json_encode($pruebas);
});

use App\Cafe;

Route::get("/prueba/cafe", function () {
    $cafe = new Cafe;

    $cafe->tipo = "Caliente";
    $cafe->nombre = "Latte";
    $cafe->tamaño = "grande";
    $cafe->precio = 68;

    $cafe->save();

    return "ok";
});

Route::get("/lista/cafe", function () {
    $cafes = [
        [ "tipo" => "Caliente", "nombre" => "latte",
            "tamaño" => "Ch", "costo" => 48 ],
        [ "tipo" => "Caliente", "nombre" => "latte",
            "tamaño" => "Ch", "costo" => 48 ],
        [ "tipo" => "Caliente", "nombre" => "latte",
            "tamaño" => "Ch", "costo" => 48 ],
        [ "tipo" => "Caliente", "nombre" => "latte",
            "tamaño" => "Ch", "costo" => 48 ],
        [ "tipo" => "Caliente", "nombre" => "latte",
            "tamaño" => "Ch", "costo" => 48 ],
        [ "tipo" => "Caliente", "nombre" => "latte",
            "tamaño" => "Ch", "costo" => 48 ]
    ];

    // $cafes = [];

    // foreach ($cafes as $cafe) {
    //     echo $cafe["tipo"];
    // }

    return view("lista.cafe", [ "cafes" => $cafes ]);
});
