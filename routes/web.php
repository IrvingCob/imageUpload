<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\excelController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('dato', 'livewire.dato.index')->middleware('auth');
	Route::view('cliente', 'livewire.cliente.index')->middleware('auth');

	Route::get('/clientesPDF',  [App\Http\Controllers\pdfController::class, 'cliente'])->middleware('auth');

	Route::get('/clientesEXCEL',  [App\Http\Controllers\excelController::class, 'exportClientesExcel'])->middleware('auth');

	// Upload Images
	Route::get('file', [fileController::class, 'create']); 
	Route::post('file', [fileController::class, 'store']);