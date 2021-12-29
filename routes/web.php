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
})->name('welcome');



Route::get('/products', [ProductController::class, 'list'])->name('productList');
Route::post('/products', [ProductController::class, 'list']);

Route::post('/products/addToChart', [ProductController::class, 'addToChart'])->name('addToChart');
Route::get('/products/emptyChart', [ProductController::class, 'emptyChart'])->name('emptyChart');
Route::get('/products/new', [ProductController::class, 'new']);
//Definimos la accion de save cuando se envia el formulario
Route::post('/products/new', [ProductController::class, 'save'])->name('saveProduct');
//Route::get('/axios', [ProductController::class, 'list']);

/**
 * LOGIN ROUTES
 */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/login', 'LoginController@login')->name('login');
//Route::post('/login', 'LoginController@login')->name('login');