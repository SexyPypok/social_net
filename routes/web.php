<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

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

Route::get('/test', [Controller::class, 'get_comm']);

Route::get('/profile/all', [UserController::class, 'users_list']);

Route::get('/profile/{id}', [UserController::class, 'show_profile'])->where('id', '[0-9]+');

Route::get('home', [UserController::class, 'home_page']);

Route::post('/profile/{id}/add_comment', [UserController::class, 'add_comment'])->where('id', '[0-9]+');

Route::post('/profile/{id}/del_comment', [UserController::class, 'del_comment'])->where('id', '[0-9]+');
?>