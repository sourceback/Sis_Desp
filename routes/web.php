<?php

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
Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home.index');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [App\Http\Controllers\LoginController::class,'show'])->name('login.show');
Route::post('/login', [App\Http\Controllers\LoginController::class,'login'])->name('login.perform');
Route::get('/logout', [App\Http\Controllers\LogoutController::class,'perform'])->name('logout.perform');


Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class,'index'])->name('usuarios.index');
Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class,'create'])->name('usuarios.create');
Route::post('/usuarios/store', [App\Http\Controllers\UsuarioController::class,'store'])->name('usuarios.store');
Route::get('usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class,'edit'])->name('usuarios.edit');
Route::post('usuarios/{id}/update', [App\Http\Controllers\UsuarioController::class,'update'])->name('usuarios.update');
Route::delete('usuarios/{id}/destroy', [App\Http\Controllers\UsuarioController::class,'destroy'])->name('usuarios.destroy');


//abogados
Route::get('/abogados', [App\Http\Controllers\AbogadoController::class,'index'])->name('abogados.index');
Route::get('/abogados/create', [App\Http\Controllers\AbogadoController::class,'create'])->name('abogados.create');
Route::post('/abogados/store', [App\Http\Controllers\AbogadoController::class,'store'])->name('abogados.store');
Route::get('abogados/{id}/edit', [App\Http\Controllers\AbogadoController::class,'edit'])->name('abogados.edit');
Route::post('/abogados/ajaxlist', [App\Http\Controllers\AbogadoController::class,'ajaxlist'])->name('abogados.ajaxlist');
Route::post('abogados/{id}/update', [App\Http\Controllers\AbogadoController::class,'update'])->name('abogados.update');
Route::delete('abogados/{id}/destroy', [App\Http\Controllers\AbogadoController::class,'destroy'])->name('abogados.destroy');

//cuentas
Route::get('/cuentas', [App\Http\Controllers\CuentaController::class,'index'])->name('cuentas.index');
Route::get('/cuentas/create', [App\Http\Controllers\CuentaController::class,'create'])->name('cuentas.create');
Route::post('/cuentas/store', [App\Http\Controllers\CuentaController::class,'store'])->name('cuentas.store');
Route::get('cuentas/{id}/edit', [App\Http\Controllers\CuentaController::class,'edit'])->name('cuentas.edit');
Route::post('/cuentas/ajaxlist', [App\Http\Controllers\CuentaController::class,'ajaxlist'])->name('cuentas.ajaxlist');
Route::post('cuentas/{id}/update', [App\Http\Controllers\CuentaController::class,'update'])->name('cuentas.update');
Route::delete('cuentas/{id}/destroy', [App\Http\Controllers\CuentaController::class,'destroy'])->name('cuentas.destroy');

//calendario
Route::get('/calendarios', [App\Http\Controllers\CalendarioController::class,'index'])->name('calendarios.index');
Route::get('/calendarios/create', [App\Http\Controllers\CalendarioController::class,'create'])->name('calendarios.create');
Route::post('/calendarios/store', [App\Http\Controllers\CalendarioController::class,'store'])->name('calendarios.store');
Route::get('/calendarios/show', [App\Http\Controllers\CalendarioController::class,'show'])->name('calendarios.show');
Route::post('calendarios/edit/{id}', [App\Http\Controllers\CalendarioController::class,'edit'])->name('calendarios.edit');
Route::post('/calendarios/ajaxlist', [App\Http\Controllers\CalendarioController::class,'ajaxlist'])->name('calendarios.ajaxlist');
Route::post('calendarios/update/{id}', [App\Http\Controllers\CalendarioController::class,'update'])->name('calendarios.update');
Route::delete('calendarios/{id}/destroy', [App\Http\Controllers\CalendarioController::class,'destroy'])->name('calendarios.destroy');

//etapas
Route::get('/etapas', [App\Http\Controllers\EtapaController::class,'index'])->name('etapas.index');
Route::get('/etapas/create', [App\Http\Controllers\EtapaController::class,'create'])->name('etapas.create');
Route::post('/etapas/store', [App\Http\Controllers\EtapaController::class,'store'])->name('etapas.store');
Route::get('etapas/{id}/edit', [App\Http\Controllers\EtapaController::class,'edit'])->name('etapas.edit');
Route::post('/etapas/ajaxlist', [App\Http\Controllers\EtapaController::class,'ajaxlist'])->name('etapas.ajaxlist');
Route::post('etapas/{id}/update', [App\Http\Controllers\EtapaController::class,'update'])->name('etapas.update');
Route::delete('etapas/{id}/destroy', [App\Http\Controllers\EtapaController::class,'destroy'])->name('etapas.destroy');

//tipoexpedientes
Route::get('/tipoexpedientes', [App\Http\Controllers\TipoexpedienteController::class,'index'])->name('tipoexpedientes.index');
Route::get('/tipoexpedientes/create', [App\Http\Controllers\TipoexpedienteController::class,'create'])->name('tipoexpedientes.create');
Route::post('/tipoexpedientes/store', [App\Http\Controllers\TipoexpedienteController::class,'store'])->name('tipoexpedientes.store');
Route::get('tipoexpedientes/{id}/edit', [App\Http\Controllers\TipoexpedienteController::class,'edit'])->name('tipoexpedientes.edit');
Route::post('/tipoexpedientes/ajaxlist', [App\Http\Controllers\TipoexpedienteController::class,'ajaxlist'])->name('tipoexpedientes.ajaxlist');
Route::post('tipoexpedientes/{id}/update', [App\Http\Controllers\TipoexpedienteController::class,'update'])->name('tipoexpedientes.update');
Route::delete('tipoexpedientes/{id}/destroy', [App\Http\Controllers\TipoexpedienteController::class,'destroy'])->name('tipoexpedientes.destroy');

//clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class,'index'])->name('clientes.index');
Route::get('/clientes/create', [App\Http\Controllers\ClienteController::class,'create'])->name('clientes.create');
Route::post('/clientes/store', [App\Http\Controllers\ClienteController::class,'store'])->name('clientes.store');
Route::get('clientes/{id}/edit', [App\Http\Controllers\ClienteController::class,'edit'])->name('clientes.edit');
Route::post('/clientes/ajaxlist', [App\Http\Controllers\ClienteController::class,'ajaxlist'])->name('clientes.ajaxlist');
Route::post('/clientes/ajaxlist2', [App\Http\Controllers\ClienteController::class,'ajaxlist2'])->name('clientes.ajaxlist2');
Route::post('clientes/{id}/update', [App\Http\Controllers\ClienteController::class,'update'])->name('clientes.update');
Route::delete('clientes/{id}/destroy', [App\Http\Controllers\ClienteController::class,'destroy'])->name('clientes.destroy');

//contrapartes
Route::get('/contrapartes', [App\Http\Controllers\ContraparteController::class,'index'])->name('contrapartes.index');
Route::get('/contrapartes/create', [App\Http\Controllers\ContraparteController::class,'create'])->name('contrapartes.create');
Route::post('/contrapartes/store', [App\Http\Controllers\ContraparteController::class,'store'])->name('contrapartes.store');
Route::get('contrapartes/{id}/edit', [App\Http\Controllers\ContraparteController::class,'edit'])->name('contrapartes.edit');
Route::post('/contrapartes/ajaxlist', [App\Http\Controllers\ContraparteController::class,'ajaxlist'])->name('contrapartes.ajaxlist');
Route::post('/contrapartes/ajaxlist2', [App\Http\Controllers\ContraparteController::class,'ajaxlist2'])->name('contrapartes.ajaxlist2');
Route::post('contrapartes/{id}/update', [App\Http\Controllers\ContraparteController::class,'update'])->name('contrapartes.update');
Route::delete('contrapartes/{id}/destroy', [App\Http\Controllers\ContraparteController::class,'destroy'])->name('contrapartes.destroy');

//exhortos
Route::get('/exhortos', [App\Http\Controllers\ExhortoController::class,'index'])->name('exhortos.index');
Route::get('/exhortos/create', [App\Http\Controllers\ExhortoController::class,'create'])->name('exhortos.create');
Route::post('/exhortos/store', [App\Http\Controllers\ExhortoController::class,'store'])->name('exhortos.store');
Route::get('exhortos/{id}/edit', [App\Http\Controllers\ExhortoController::class,'edit'])->name('exhortos.edit');
Route::post('/exhortos/ajaxlist', [App\Http\Controllers\ExhortoController::class,'ajaxlist'])->name('exhortos.ajaxlist');
Route::post('/exhortos/ajaxlist2', [App\Http\Controllers\ExhortoController::class,'ajaxlist2'])->name('exhortos.ajaxlist2');
Route::post('exhortos/{id}/update', [App\Http\Controllers\ExhortoController::class,'update'])->name('exhortos.update');
Route::delete('exhortos/{id}/destroy', [App\Http\Controllers\ExhortoController::class,'destroy'])->name('exhortos.destroy');

//expedientes
Route::get('/expedientes', [App\Http\Controllers\expedienteController::class,'index'])->name('expedientes.index');
Route::get('/expedientes/create', [App\Http\Controllers\expedienteController::class,'create'])->name('expedientes.create');
Route::post('/expedientes/store', [App\Http\Controllers\expedienteController::class,'store'])->name('expedientes.store');
Route::get('expedientes/{id}/edit', [App\Http\Controllers\expedienteController::class,'edit'])->name('expedientes.edit');
Route::post('/expedientes/ajaxlist', [App\Http\Controllers\expedienteController::class,'ajaxlist'])->name('expedientes.ajaxlist');
Route::post('expedientes/{id}/update', [App\Http\Controllers\expedienteController::class,'update'])->name('expedientes.update');
Route::delete('expedientes/{id}/destroy', [App\Http\Controllers\expedienteController::class,'destroy'])->name('expedientes.destroy');

Route::get('/expedientes/{id}/archivoexpedientes', [App\Http\Controllers\ExpedienteController::class,'archivoexpediente'])->name('expedientes.archivoexpedientes');
Route::post('/expedientes/{id}/download', [App\Http\Controllers\ExpedienteController::class,'download'])->name('expedientes.download');
Route::post('/expedientes/{id}archivodo', [App\Http\Controllers\ExpedienteController::class,'archivoexpedientedo'])->name('expedientes.archivoexpedientedo');
Route::delete('expedientes/{id}/eliminarimagen', [App\Http\Controllers\ExpedienteController::class,'eliminarimagen'])->name('expedientes.eliminarimagen');

//instancias
Route::get('/instancias', [App\Http\Controllers\InstanciaController::class,'index'])->name('instancias.index');
Route::get('/instancias/create', [App\Http\Controllers\InstanciaController::class,'create'])->name('instancias.create');
Route::post('/instancias/store', [App\Http\Controllers\InstanciaController::class,'store'])->name('instancias.store');
Route::get('instancias/{id}/edit', [App\Http\Controllers\InstanciaController::class,'edit'])->name('instancias.edit');
Route::post('/instancias/ajaxlist', [App\Http\Controllers\InstanciaController::class,'ajaxlist'])->name('instancias.ajaxlist');
Route::post('instancias/{id}/update', [App\Http\Controllers\InstanciaController::class,'update'])->name('instancias.update');
Route::delete('instancias/{id}/destroy', [App\Http\Controllers\InstanciaController::class,'destroy'])->name('instancias.destroy');

//legislaciones
Route::get('/legislaciones', [App\Http\Controllers\LegislacioneController::class,'index'])->name('legislaciones.index');
Route::get('/legislaciones/create', [App\Http\Controllers\LegislacioneController::class,'create'])->name('legislaciones.create');
Route::post('/legislaciones/store', [App\Http\Controllers\LegislacioneController::class,'store'])->name('legislaciones.store');
Route::get('legislaciones/{id}/edit', [App\Http\Controllers\LegislacioneController::class,'edit'])->name('legislaciones.edit');
Route::post('/legislaciones/ajaxlist', [App\Http\Controllers\LegislacioneController::class,'ajaxlist'])->name('legislaciones.ajaxlist');
Route::post('legislaciones/{id}/update', [App\Http\Controllers\LegislacioneController::class,'update'])->name('legislaciones.update');
Route::delete('legislaciones/{id}/destroy', [App\Http\Controllers\LegislacioneController::class,'destroy'])->name('legislaciones.destroy');

Route::get('/legislaciones/{id}/archivolegislaciones', [App\Http\Controllers\LegislacioneController::class,'archivolegislacione'])->name('legislaciones.archivolegislaciones');
Route::post('/legislaciones/{id}/download', [App\Http\Controllers\LegislacioneController::class,'download'])->name('legislaciones.download');
Route::post('/legislaciones/{id}/archivolegislacionedo', [App\Http\Controllers\LegislacioneController::class,'archivolegislacionedo'])->name('legislaciones.archivolegislacionedo');
Route::delete('legislaciones/{id}/eliminarimagen', [App\Http\Controllers\LegislacioneController::class,'eliminarimagen'])->name('legislaciones.eliminarimagen');

//materias
Route::get('/materias', [App\Http\Controllers\MateriaController::class,'index'])->name('materias.index');
Route::get('/materias/create', [App\Http\Controllers\MateriaController::class,'create'])->name('materias.create');
Route::post('/materias/store', [App\Http\Controllers\MateriaController::class,'store'])->name('materias.store');
Route::get('materias/{id}/edit', [App\Http\Controllers\MateriaController::class,'edit'])->name('materias.edit');
Route::post('/materias/ajaxlist', [App\Http\Controllers\MateriaController::class,'ajaxlist'])->name('materias.ajaxlist');
Route::post('materias/{id}/update', [App\Http\Controllers\MateriaController::class,'update'])->name('materias.update');
Route::delete('materias/{id}/destroy', [App\Http\Controllers\MateriaController::class,'destroy'])->name('materias.destroy');

//crudi
Route::get('/crudis', [App\Http\Controllers\CrudiController::class,'index'])->name('crudis.index');
Route::get('/crudis/create', [App\Http\Controllers\CrudiController::class,'create'])->name('crudis.create');
Route::post('/crudis/store', [App\Http\Controllers\CrudiController::class,'store'])->name('crudis.store');
Route::get('/crudis/{id}/edit', [App\Http\Controllers\CrudiController::class,'edit'])->name('crudis.edit');
Route::get('/crudis/{id}/ajaxlist', [App\Http\Controllers\CrudiController::class,'ajaxlist'])->name('crudis.ajaxlist');
Route::post('crudis/{id}/update', [App\Http\Controllers\CrudiController::class,'update'])->name('crudis.update');
Route::delete('crudis/{id}/destroy', [App\Http\Controllers\CrudiController::class,'destroy'])->name('crudis.destroy');
//RUTAS DE ARCHIVOS
Route::get('/crudis/{id}/archivo', [App\Http\Controllers\CrudiController::class,'archivo'])->name('crudis.archivo');
Route::post('/crudis/{id}/download', [App\Http\Controllers\CrudiController::class,'download'])->name('crudis.download');
Route::post('/crudis/{id}archivodo', [App\Http\Controllers\CrudiController::class,'archivodo'])->name('crudis.archivodo');
Route::delete('crudis/{id}/eliminarimagen', [App\Http\Controllers\CrudiController::class,'eliminarimagen'])->name('crudis.eliminarimagen');

//crude
Route::get('/crudes', [App\Http\Controllers\CrudeController::class,'index'])->name('crudes.index');
Route::get('/crudes/create', [App\Http\Controllers\CrudeController::class,'create'])->name('crudes.create');
Route::post('/crudes/store', [App\Http\Controllers\CrudeController::class,'store'])->name('crudes.store');
Route::get('crudes/{id}/edit', [App\Http\Controllers\CrudeController::class,'edit'])->name('crudes.edit');
Route::post('/crudes/ajaxlist', [App\Http\Controllers\CrudeController::class,'ajaxlist'])->name('crudes.ajaxlist');
Route::post('crudes/{id}/update', [App\Http\Controllers\CrudeController::class,'update'])->name('crudes.update');
Route::delete('crudes/{id}/destroy', [App\Http\Controllers\CrudeController::class,'destroy'])->name('crudes.destroy');

//gasto
Route::get('/gastos', [App\Http\Controllers\GastoController::class,'index'])->name('gastos.index');
Route::get('/gastos/create', [App\Http\Controllers\GastoController::class,'create'])->name('gastos.create');
Route::post('/gastos/store', [App\Http\Controllers\GastoController::class,'store'])->name('gastos.store');
Route::get('gastos/{id}/edit', [App\Http\Controllers\GastoController::class,'edit'])->name('gastos.edit');
Route::post('/gastos/ajaxlist', [App\Http\Controllers\GastoController::class,'ajaxlist'])->name('gastos.ajaxlist');
Route::post('gastos/{id}/update', [App\Http\Controllers\GastoController::class,'update'])->name('gastos.update');
Route::delete('gastos/{id}/destroy', [App\Http\Controllers\GastoController::class,'destroy'])->name('gastos.destroy');