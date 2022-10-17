<?php

use App\Http\Livewire\Usuarios\TipoUsuarios;
use App\Http\Livewire\Usuarios\UsuariosIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    //Usuarios
    Route::get('/usuario/tipo-usuarios', TipoUsuarios::class)->name('usuario.tipo_usuarios');
    Route::get('/usuario/operadores', UsuariosIndex::class)->name('usuario.operadores_lista');

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});
