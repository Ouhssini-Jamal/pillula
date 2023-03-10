<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdonnanceController;
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
    return view('Welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/Settings', function () {
    return view('settings');
});
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    });
Route::get('/Accueil',[UserController::class, 'index']);
Route::get('/ordonnance', [UserController::class, 'print_ord']);
