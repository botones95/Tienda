<?php

use App\Http\Controllers\DevolucionesController;
use App\Http\Controllers\FinalizarTurnoController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\IniciarDiaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//iniciar dia
Route::get('/',[IniciarDiaController::class,'index']);
route::post('/iniciodia', [IniciarDiaController::class, 'ComprobarDia']);

//zonainicial
Route::get('/inicio',[IniciarDiaController::class,'showMenuInicial']);

//productos
Route::get('/Productos',[ProductosController::class,'index']);
Route::post('/Productos/registrar',[ProductosController::class,'registrarProducto'])->name('RegistrarProducto');
Route::delete('/Productos/eliminar-producto/{id}', [ProductosController::class, 'delete'])->name('eliminarProducto');
Route::post('/aumentar-cantidad', [ProductosController::class, 'aumentarStore'])->name('aumentarCantidad');
Route::put('/editar-producto', [ProductosController::class, 'edit'])->name('editarProducto');

//ventas
Route::get('/Ventas',[VentasController::class,'index']);
Route::post('/Ventas/anadirProducto', [VentasController::class, 'anadiracesta']);
Route::post('/Ventas/cancelarVenta/', [VentasController::class, 'cancelarVenta']);
Route::post('/Ventas/eliminarProducto/{id}', [VentasController::class, 'eliminardelista']);
Route::post('/Ventas/actualizarCantidad/{codigo}', [VentasController::class, 'actualizarCantidadVenta']);
Route::post('/Ventas/finalizarventa', [ventasController::class, 'finalizarVenta'])->name('finalizarventa');

//informes
Route::get('/InformesDiarios',[InformesController::class,'showinformesDiarios']);
Route::get('/InformesHistorialPreciosProductos',[InformesController::class,'showinformesPreciosProductos']);
Route::get('/InformesHistorialVentaProductos',[InformesController::class,'showinformesVentaProductos']);
Route::get('/InformesMeses',[InformesController::class,'showinformesMeses']);


//Devoluciones
Route::get('/Devoluciones',[DevolucionesController::class,'index']);
Route::post('/Devoluciones/anadirProducto', [DevolucionesController::class, 'anadiracesta']);
Route::post('/Devoluciones/cancelarVenta/', [DevolucionesController::class, 'cancelarVenta']);
Route::post('/Devoluciones/eliminarProducto/{id}', [DevolucionesController::class, 'eliminardelista']);
Route::post('/Devoluciones/actualizarCantidad/{codigo}', [DevolucionesController::class, 'actualizarCantidadDevolucion']);
Route::post('/Devoluciones/finalizarDevolucion', [DevolucionesController::class, 'finalizarDevolucion'])->name('finalizarDevolucion');


//FinalizarTurno
Route::get('/Finalizarturno',[FinalizarTurnoController::class,'index']);

