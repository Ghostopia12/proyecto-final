<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\PuntacionController;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(["middleware" => "auth:sanctum"], function () {
//    Route::resource("evento", EventoController::class);
    Route::resource("equipo", EquipoController::class);
    Route::resource("grupo", GrupoController::class);
    //Route::resource("partido", PartidoController::class);
    Route::post("/partido",[PartidoController::class, "store"])->name("partido.store");
    Route::put("/partido/{partido}",[PartidoController::class, "update"])->name("partido.update");
    Route::delete("/partido/{partido}",[PartidoController::class, "destroy"])->name("partido.destroy");

    Route::post("/evento",[EventoController::class, "store"])->name("evento.store");
    Route::put("/evento/{evento}",[EventoController::class, "update"])->name("evento.update");
    Route::delete("/evento/{evento}",[EventoController::class, "destroy"])->name("evento.destroy");

    Route::post("/puntuacion",[PuntacionController::class, "store"])->name("puntuacion.store");
    Route::put("/puntuacion/{puntuacion}",[PuntacionController::class, "update"])->name("puntuacion.update");
    Route::delete("/puntuacion/{puntuacion}",[PuntacionController::class, "destroy"])->name("puntuacion.destroy");

//    Route::post("/postev", [EventoController::class,"store"]);
//    Route::get("/getev", [EventoController::class,"index"]);
    Route::post("/equipo/{id}/fotos", [EquipoController::class, "uploadPhoto"])->name("equipos.foto");
});

Route::get("/partido",[PartidoController::class, "index"])->name("partido.index");
Route::get("/partido/curso",[PartidoController::class, "curso"])->name("partido.curso");
Route::get("/partido/terminados",[PartidoController::class, "terminados"])->name("partido.terminados");
Route::get("/partido/{partido}",[PartidoController::class, "show"])->name("partido.show");

Route::get("/evento",[EventoController::class, "index"])->name("evento.index");
Route::get("/evento/{evento}",[EventoController::class, "show"])->name("evento.show");

Route::get("/puntuacion",[PuntacionController::class, "index"])->name("puntuacion.index");
Route::get("/puntuacion/{puntuacion}",[PuntacionController::class, "show"])->name("puntuacion.show");
Route::get("/puntuacion/especif/{puntuacion}",[EventoController::class, "especif"])->name("puntuacion.especif");


Route::get("/evento/especif/{partido}/{equipo}",[EventoController::class, "especif"])->name("evento.especif");

Route::get("/equipo/grupos",[EquipoController::class, "grupos"])->name("equipo.grupos");


Route::post("/auth/login", [AuthController::class, "login"])->name("auth.login");
Route::post("/auth/register", [AuthController::class, "register"])->name("auth.register");
