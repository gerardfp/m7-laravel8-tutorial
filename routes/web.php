<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/login', 'LoginController@login')->name('login');
//Route::post('/login', 'LoginController@login')->name('login');

Route::get('/products', [ProductController::class, 'list']);
Route::post('/products', [ProductController::class, 'list']);

Route::post('/products/addToChart', [ProductController::class, 'addToChart'])->name('addToChart');
Route::get('/products/new', [ProductController::class, 'new']);

//Para el formulario. definimos la accion de save cuando se envia el formulario
Route::post('/products/new', [ProductController::class, 'save']);

//Route::get('/axios', [ProductController::class, 'list']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
