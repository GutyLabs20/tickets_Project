<?php

use App\Http\Livewire\Entidad\EntidadAreaIndex;
use App\Http\Livewire\Entidad\EntidadCargoIndex;
use App\Http\Livewire\Entidad\EntidadColaboradorIndex;
use App\Http\Livewire\Entidad\EntidadIndex;
use App\Http\Livewire\Usuarios\TipoUsuarios;
use App\Http\Livewire\Usuarios\UsuariosIndex;
use App\Http\Livewire\Utilitarios\CategoriasIndex;
use App\Http\Livewire\Utilitarios\ClasificacionesIndex;
use App\Http\Livewire\Utilitarios\EstadoIndex;
use App\Http\Livewire\Utilitarios\ImpactoIndex;
use App\Http\Livewire\Utilitarios\PrioridadesIndex;
use App\Http\Livewire\Utilitarios\TipodocumentoIndex;
use Illuminate\Support\Facades\Route;

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
    Route::get('/usuario/gestores', UsuariosIndex::class)->name('usuario.gestores_lista');

    //Utilitarios
    Route::get('/utilitario/categorias', CategoriasIndex::class)->name('utilitario.categorias');
    Route::get('/utilitario/clasificaciones', ClasificacionesIndex::class)->name('utilitario.clasificaciones');
    Route::get('/utilitario/prioridades', PrioridadesIndex::class)->name('utilitario.prioridades');
    Route::get('/utilitario/impactos', ImpactoIndex::class)->name('utilitario.impactos');
    Route::get('/utilitario/estados', EstadoIndex::class)->name('utilitario.estados');
    Route::get('/utilitario/tipo-documento', TipodocumentoIndex::class)->name('utilitario.tipo-documento');

    //Entidades
    Route::get('/cliente/empresas', EntidadIndex::class)->name('cliente.empresas');
    Route::get('/cliente/areas', EntidadAreaIndex::class)->name('cliente.areas');
    Route::get('/cliente/cargos', EntidadCargoIndex::class)->name('cliente.cargos');
    Route::get('/cliente/colaboradores', EntidadColaboradorIndex::class)->name('cliente.colaboradores');


    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});
