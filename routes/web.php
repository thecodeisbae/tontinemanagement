<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class,'home']);
Route::get('/login', [MainController::class,'login']);
Route::post('/login', [MainController::class,'checkLogin']);
Route::get('/logout', [MainController::class,'logout']);

/* Debut  Mises */
Route::get('/mises', [MainController::class,'mises']);
Route::get('/mise/delete/{id}', [MainController::class,'deleteMise']);
Route::post('/mise', [MainController::class,'storeMise']);
Route::get('/mise/edit/{id}', [MainController::class,'editMise']);
Route::post('/mise/edit/{id}', [MainController::class,'updateMise']);
/* Fin Mises */

/* Debut  Clients */
Route::get('/clients', [MainController::class,'clients']);
Route::get('/client/delete/{id}', [MainController::class,'deleteClient']);
Route::post('/client', [MainController::class,'storeClient']);
Route::get('/client/edit/{id}', [MainController::class,'editClient']);
Route::post('/client/edit/{id}', [MainController::class,'updateClient']);
/* Fin Clients */

/* Debut  Users */
Route::get('/users', [MainController::class,'users']);
Route::get('/user/delete/{id}', [MainController::class,'deleteUser']);
Route::post('/user', [MainController::class,'storeUser']);
Route::get('/user/edit/{id}', [MainController::class,'editUser']);
Route::post('/user/edit/{id}', [MainController::class,'updateUser']);
/* Fin Users */

/* Debut  Souscriptions */
Route::get('/suscribes', [MainController::class,'suscribes']);
Route::get('/suscribe/delete/{id}', [MainController::class,'deleteSuscribe']);
Route::post('/suscribe', [MainController::class,'storeSuscribe']);
/* Fin Souscriptions */

/* Debut  Payements */
Route::get('/payements', [MainController::class,'payements']);
Route::get('/payement/delete/{id}', [MainController::class,'deletePayment']);
Route::post('/payement', [MainController::class,'storePayment']);
Route::post('/getClients', [MainController::class,'getClients']);
/* Fin Payements */
